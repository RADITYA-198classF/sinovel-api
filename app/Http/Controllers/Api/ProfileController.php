<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    // GET /api/me/profile  (data user + statistik)
    public function show(Request $request)
    {
        $user = $request->user()->load('genres:id,name');

        $saved = DB::table('novel_reading_list')
            ->join('reading_lists', 'reading_lists.id', '=', 'novel_reading_list.reading_list_id')
            ->where('reading_lists.user_id', $user->id)
            ->distinct()
            ->count('novel_reading_list.novel_id');

        return response()->json([
            'data'  => $user,
            'stats' => [
                'saved'     => $saved,
                'finished'  => $user->progress()->where('is_finished', true)->count(),
                'followers' => 0,
                'following' => 0,
            ],
        ]);
    }

    // PUT /api/me   body: { "name": "...", "username": "...", "bio": "...", "website": "..." }
    public function update(Request $request)
    {
        $data = $request->validate([
            'name'     => 'sometimes|string|max:255',
            'username' => 'sometimes|nullable|string|max:50|unique:users,username,' . $request->user()->id,
            'bio'      => 'sometimes|nullable|string|max:500',
            'website'  => 'sometimes|nullable|string|max:255',
        ]);

        $request->user()->update($data);

        return response()->json([
            'data' => $request->user()->fresh()->load('genres:id,name'),
        ]);
    }

    // GET /api/me/activities
    public function activities(Request $request)
    {
        $items = $request->user()->activities()
            ->with('novel:id,title,cover')
            ->latest()
            ->limit(20)
            ->get();

        return response()->json(['data' => $items]);
    }
}