<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Novel;
use App\Models\ReadingProgress;
use Illuminate\Http\Request;

class LibraryController extends Controller
{
    // GET /api/me/library?status=all|reading|finished&q=
    public function index(Request $request)
    {
        $status = $request->query('status', 'all');
        $q = $request->query('q');

        $query = $request->user()->progress()->with([
            'novel' => fn ($n) => $n->withCount('chapters')->with('genres:id,name'),
        ]);

        if ($status === 'reading') {
            $query->where('is_finished', false)->where('current_chapter', '>', 0);
        }
        if ($status === 'finished') {
            $query->where('is_finished', true);
        }
        if ($q) {
            $query->whereHas('novel', fn ($n) => $n->where('title', 'like', "%{$q}%"));
        }

        $items = $query->latest('updated_at')->get()->map(function ($p) {
            $total = $p->novel->chapters_count;
            return [
                'novel'           => $p->novel,
                'current_chapter' => $p->current_chapter,
                'total_chapters'  => $total,
                'progress'        => $total > 0 ? round($p->current_chapter / $total, 2) : 0,
                'is_finished'     => $p->is_finished,
            ];
        });

        return response()->json(['data' => $items]);
    }

    // PUT /api/me/progress/{novel}   body: { "current_chapter": 2 }
    public function updateProgress(Request $request, Novel $novel)
    {
        $data = $request->validate(['current_chapter' => 'required|integer|min:0']);

        $total = $novel->chapters()->count();
        $current = min($data['current_chapter'], $total);
        $finished = $total > 0 && $current >= $total;

        $progress = ReadingProgress::updateOrCreate(
            ['user_id' => $request->user()->id, 'novel_id' => $novel->id],
            ['current_chapter' => $current, 'is_finished' => $finished]
        );

        Activity::create([
            'user_id'  => $request->user()->id,
            'novel_id' => $novel->id,
            'type'     => $finished ? 'selesai' : 'lanjut_baca',
        ]);

        return response()->json(['data' => $progress]);
    }
}