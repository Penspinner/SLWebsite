<?php

namespace App\Http\Controllers;

use DB;
use App\Note;
use Illuminate\Http\Request;

class CardsController extends Controller
{
    public function index()
    {
//         $cards = DB::table('cards')->get();
      
        $notes = Note::all();
        return view('notes.index', compact('notes'));
    }
    
    // Pass in the Note's id to get the Note object.
    public function show(Note $note)
    {
        return view('notes.show', compact('note'));
    }
}
