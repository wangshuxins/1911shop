<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;
use Validator;
use App\Admin AS Shop_admin;
class Login extends Controller
{
    public function index(){
	

	return view('admin.login.login');

	}
	public function logindo(){

    
    
	$post = Request()->except("_token");

	//dd($post);

	
	
	//dump($post);
	$validator = Validator::make($post,[
			'admin_name' => 'required',
			'admin_pwd' => 'required',
			
			
		
		],[
			
			'admin_name.required'=>'用户名不能为空',
			'admin_pwd.required'=>'密码不能为空',
			
			
		]);
		if($validator->fails()){
		return redirect('/login')
			->withErrors($validator)
			->withInput();

		
		}
		$admin = Shop_admin::where('admin_name',$post['admin_name'])->first();

		if(empty($admin)){
		
		return redirect('/login')->with('msg','用户名或密码错误');
		
		}

		if(decrypt($admin->admin_pwd)!=$post['admin_pwd']){
		
		   return redirect('/login')->with('msg','用户名或密码错误');
		
		}
		if(isset($post['isremember'])){
	
	       Cookie::queue('admin',serialize($admin),60*24*7);
	
	    }
		session(['admin'=>$admin]);

		return redirect('/admin');
	}
	//退出
	public function logout(){
	
	 Request()->session()->flush();
     
	 return redirect('/login');
	
	}
	//public function setcookie(){
	//1
	//return response('欢迎来到 Laravel 学院')->cookie( 'china', '学院君', 1);
    //2
	//Cookie::queue(Cookie::make('name','china',1));
	//3
	//Cookie::queue('name','沙河地铁',1);
	//}
	//public function getcookie(){
	//1
	//echo Request()->cookie('name');
	//2
	//echo Cookie::get('name');

	//}
}
