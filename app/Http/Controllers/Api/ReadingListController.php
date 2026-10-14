<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Novel;
use App\Models\ReadingList;
use App\Models\ReadingProgress;
use Illuminate\Http\Request;

class ReadingListController extends Controller
{
    // GET /api/me/reading-lists
    public function index(Request $request)
    {
        return response()->json([
            'data' => $request->user()->readingLists()->withCount('novels')->get(),
        ]);
    }

    // POST /api/me/reading-lists   body: { "name": "Favorit", "is_private": true }
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'       => 'required|string|max:100',
            'is_private' => 'boolean',
        ]);

        $list = $request->user()->readingLists()->create([
            'name'       => $data['name'],
            'is_private' => $data['is_private'] ?? true,
        ]);

        return response()->json(['data' => $list], 201);
    }

    // POST /api/me/reading-lists/{list}/novels   body: { "novel_id": 1 }
    public function addNovel(Request $request, ReadingList $list)
    {
        abort_unless($list->user_id === $request->user()->id, 403);

        $data = $request->validate(['novel_id' => 'required|integer|exists:novels,id']);

        $list->novels()->syncWithoutDetaching([$data['novel_id']]);

        // otomatis masuk Library dengan progress 0
        ReadingProgress::firstOrCreate(
            ['user_id' => $request->user()->id, 'novel_id' => $data['novel_id']],
            ['current_chapter' => 0]
        );

        Activity::create([
            'user_id'  => $request->user()->id,
            'novel_id' => $data['novel_id'],
            'type'     => 'tambah_koleksi',
        ]);

        return response()->json(['message' => 'Novel ditambahkan ke daftar bacaan']);
    }

    // DELETE /api/me/reading-lists/{list}/novels/{novel}
    public function removeNovel(Request $request, ReadingList $list, Novel $novel)
    {
        abort_unless($list->user_id === $request->user()->id, 403);

        $list->novels()->detach($novel->id);

        return response()->json(['message' => 'Novel dihapus dari daftar bacaan']);
    }
}