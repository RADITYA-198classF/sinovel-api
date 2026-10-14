<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Novel;
use Illuminate\Http\Request;

class NovelController extends Controller
{
    // GET /api/novels?q=&genre=&sort=popular|new|rating&limit=
    public function index(Request $request)
    {
        $query = Novel::with('genres:id,name');

        if ($q = $request->query('q')) {
            $query->where(function ($w) use ($q) {
                $w->where('title', 'like', "%{$q}%")
                  ->orWhere('author', 'like', "%{$q}%");
            });
        }

        if ($genre = $request->query('genre')) {
            $query->whereHas('genres', fn ($g) => $g->where('name', $genre));
        }

        switch ($request->query('sort')) {
            case 'popular': $query->orderByDesc('views'); break;
            case 'rating':  $query->orderByDesc('rating'); break;
            case 'new':     $query->orderByDesc('id'); break;
            default:        $query->orderBy('id');
        }

        $limit = (int) $request->query('limit', 20);

        return response()->json(['data' => $query->limit($limit)->get()]);
    }

    // GET /api/novels/{id}
    public function show(Novel $novel)
    {
        $novel->load('genres:id,name')->loadCount('chapters');
        return response()->json(['data' => $novel]);
    }

    // GET /api/novels/{id}/chapters  (daftar bab, tanpa isi)
    public function chapters(Novel $novel)
    {
        return response()->json([
            'data' => $novel->chapters()->select('id', 'novel_id', 'number', 'title')->get(),
        ]);
    }

    // GET /api/novels/{id}/chapters/{number}  (isi 1 bab)
    public function chapter(Novel $novel, int $number)
    {
        $chapter = $novel->chapters()->where('number', $number)->firstOrFail();
        return response()->json(['data' => $chapter]);
    }
}