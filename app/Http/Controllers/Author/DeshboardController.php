<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DeshboardController extends Controller
{
    public function index(){

      return view('author.deshboard');
    }
}