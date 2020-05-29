<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelloController extends Controller
{
    public function test(){
	//$post = request()->input();
	//dump($post);
	return view('add');
	
	}

	public function doadd(){
		
	$post = Request()->except('_token');

	dd($post);
	//$post = request()->input();
	//dump($post);
	//$post = $request->all();
	//$post = request()->input();
	//$post = $request->post();
	//$post = $request->post('name');
    //dd($post);
	//$data = $request->except(['_token','password']);
	//dump($data);
	//$data = $request->only(['_token','password']);
	//dd($data);
	//$post = $request->name;
	//dump($post);
	//$post = $request->input('password');
	//dd($post);
	//$post = $request->post('time');
	//dd($post);
	}
	public function show($id,$name){
	
	

	echo $id.'-'.$name;
	
	}
}
