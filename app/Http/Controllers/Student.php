<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Student extends Controller
{
	public function list(){
    echo '学生列表';
	}
	public function create(){
    
    return view('create');

	}
	public function store(){
    
    $post = Request()->input();

	dump($post);

	}
}
