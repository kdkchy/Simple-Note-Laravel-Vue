<?php

namespace App\Http\Controllers\Notes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Note, Subject};
use App\Http\Resources\NoteResource;

class NoteController extends Controller
{

    public function index(){
        $notes = Note::with('subject')->latest()->get();
        return NoteResource::collection($notes);
    }

    public function show(Note $note){
        // dd($id);
        // $note = Note::where('id', $id)->where('slug', $slug)->get();

        // return response()->json($note);
        return NoteResource::make($note);
    }

    public function store(){

        request()->validate([
            'subject' => 'required',
            'title' => 'required',
            'description' => 'required',
        ]);
        
        $subject = Subject::findOrFail(request('subject'));
        
        $note = $subject->notes()->create([
            'subject_id' => $subject->id,
            'title' => request('title'),
            'slug' => \Str::slug(request('title')),
            'description' => request('description')
        ]);
        
        Note::where('id', $note->id)->first()->update(['slug' => $note->id.'-'.\Str::slug(request('title'))]);

        $updateSlug = Note::where('id', $note->id)->first();
        return response()->json([
            'message' => 'Your note was created',
            'note' => $updateSlug,
        ]);
    }
}
