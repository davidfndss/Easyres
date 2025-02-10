<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class ResumeViewController extends Controller
{
    public function index()
    {
        return view('resumes');
    }
    public function create()
    {
        return view('resumes-create');
    }

    public function edit($id)
    {

        return view('resumes-edit', compact('id'));
    }
    public function destroy($id)
    {
        return view('resumes-delete', compact('id'));
    }
}
