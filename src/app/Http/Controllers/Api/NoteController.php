<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Note;
use App\Http\Requests\NoteRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    public function index()
    {
        return Note::where('user_id', Auth::id())
            ->orderByDesc('updated_at')
            ->get();
    }

    public function store(NoteRequest $request)
    {
        return Note::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'content' => $request->content,
        ]);
    }

    public function update(NoteRequest $request, Note $note)
    {
        if ($note->user_id !== Auth::id()) {
            abort(403);
        }

        $note->update([
            'title' => $request->title,
            'content' => $request->content
        ]);

        return response()->json(['status' => 'updated']);
    }

    public function destroy(Note $note)
    {
        if ($note->user_id !== Auth::id()) {
            abort(403);
        }

        $note->delete();
        return response()->json(['status' => 'deleted']);
    }
}