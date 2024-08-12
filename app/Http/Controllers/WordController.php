<?php

namespace App\Http\Controllers;

use App\Models\Word;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WordController extends Controller
{
    
    public function index()
    {
        $words = Word::all();
        return \view('word.index', \compact('words'));
    }

    public function create()
    {
        return \view('word.create');
    }
    public function store(Request $request)
    {
        $word = new Word();
        $word->name = $request->name;
        $word->body = $request->editor_data;
        $word->ltext = $request->ltext;
        $word->rtext = $request->rtext;
        if ($request->file('sig_sender')) {
            $word->sig_sender = $request->file('sig_sender')->store('uploads/word', 'public');
        }
        if ($request->file('sig_receiver')) {
            $word->sig_receiver = $request->file('sig_receiver')->store('uploads/word', 'public');
        }
        $word->save();
        return \redirect()->route('word.index')->with('success', 'New word document added');
    }
    public function show($id)
    {
        $word = Word::findOrFail($id);
        return \view('word.show', \compact('word'));
    }
    public function edit($id)
    {
        $word = Word::findOrFail($id);
        return \view('word.update', \compact('word'));
    }

    public function update(Request $request, $id)
    {
        $word = Word::findOrFail($id);
        $word->name = $request->name;
        $word->body = $request->editor_data;
        $word->ltext = $request->ltext;
        $word->rtext = $request->rtext;
        if ($request->file('sig_sender')) {
            if(Storage::disk('public')->exists($word->sig_sender)){
                Storage::disk('public')->delete($word->sig_sender);
            }
            $word->sig_sender = $request->file('sig_sender')->store('uploads/word', 'public');
        }
        if ($request->file('sig_receiver')) {
            if(Storage::disk('public')->exists($word->sig_receiver)){
                Storage::disk('public')->delete($word->sig_receiver);
            }
            $word->sig_receiver = $request->file('sig_receiver')->store('uploads/word', 'public');
        }
        $word->save();
        return \redirect()->route('word.index')->with('success', 'Word document updated');
    }
}
