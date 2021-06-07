<?php

namespace App\Http\Controllers\Notes;

use App\Models\Subject;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index(){
        return Subject::get();
    }
}
