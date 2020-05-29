<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use think\Facade\Cookie;
use App\Admin AS Shop_admin;
class Admin extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

		
        $pageSize = config('app.pageSize');

		$arr = Shop_admin::getBrandIndex($pageSize);
     
		//dd($arr);

		if(Request()->ajax()){
		
		return view('admin.admin.adminajax',['arr'=>$arr]);
		
		}

		return view('admin.admin.index',['arr'=>$arr]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

       $post = $request->except('_token');

        //dd($res);
		$post['admin_time'] = time();

		//dd($post);

		 $validator = Validator::make($post,[
			'admin_name' => 'regex:/^[\x{4e00-\x{9fa5}\w]{2,18}$/u|unique:admin',
			'admin_tel' => 'regex:/^1[0-9]{10}$/',
			'admin_email' => 'regex:/^[0-9a-zA-Z]+@\w+(\.)com$/',
			'admin_pwd' => 'regex:/^[0-9a-zA-Z]{6,12}$/',
			'admin_pwds' => 'required|same:admin_pwd',
			
		
		],[
			
			'admin_name.unique'=>'管理员名称已存在',
			'admin_name.regex'=>'管理员名称可以包含中文，字母，下划线，长度范围2-18位',
			'admin_tel.regex'=>'管理员电话必须为手机号',
			'admin_email.regex'=>'管理员邮箱格式不正确',
			'admin_pwd.regex'=>'管理员密码6-12位',
			'admin_pwds.required'=>'确认密码不能为空',
			'admin_pwds.same'=>'确认密码和密码保持一致',
			
		]);
		if($validator->fails()){
		return redirect('/admin/create')
			->withErrors($validator)
			->withInput();

		
		}
		if($request->hasFile('admin_img')){
		//echo '有文件上传';
		$post['admin_img'] = upload('admin_img');
		
		}

		$admin = new Shop_admin();

		
        $post['admin_pwd'] = encrypt($post['admin_pwd']);

		foreach($post as $k=>$v){
         
	    if($k=='admin_pwds'){

		unset($post['admin_pwds']);

		}
		}
		//dd($post);
        
		$res = $admin::insert($post);

		if($res){
		
		return redirect('/admin');
		
		}
    }

	 public function upload($filename){
	
	    if(request()->file($filename)->isValid()){
	    $file = request()->$filename;
	    $path = request()->$filename->store('uploads');
	    return $path;
	    }
	     return '文件上传出错';
	    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $admin = Shop_admin::find($id);
		
		

		return view('admin.admin.edit',['admin'=>$admin]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
               $post = $request->except('_token');
			   //dd($post);
			  

		$post['admin_time'] = time();

		//dd($post);

		 $validator = Validator::make($post,[
			'admin_name' => ['regex:/[\x{4e00-\x{9fa5}\w]{2,60}/u',
		     Rule::unique('admin')->ignore(request()->id,'admin_id')
		     ],
			
			'admin_tel' => 'regex:/^1[0-9]{10}$/',
			'admin_email' => 'regex:/^[0-9a-zA-Z]+@\w+(\.)com$/',
			'admin_pwd' => 'regex:/^[0-9a-zA-Z]{6,12}$/',
			'admin_pwds' => 'required|same:admin_pwd',
			
		
		],[
			
			'admin_name.unique'=>'管理员名称已存在',
			'admin_name.regex'=>'管理员名称可以包含中文，字母，下划线，长度范围2-18位',
			'admin_tel.regex'=>'管理员电话必须为手机号',
			'admin_email.regex'=>'管理员邮箱格式不正确',
			'admin_pwd.regex'=>'管理员密码6-12位',
			'admin_pwds.required'=>'确认密码不能为空',
			'admin_pwds.same'=>'确认密码和密码保持一致',
			
		]);
		if($validator->fails()){
		return redirect("/admin/edit/$id")
			->withErrors($validator)
			->withInput();

		
		}
		if($request->hasFile('admin_img')){
		//echo '有文件上传';
		$post['admin_img'] = upload('admin_img');
		
		}

		

		
        $post['admin_pwd'] = encrypt($post['admin_pwd']);

		
        foreach($post as $k=>$v){
		
		if($k=='admin_pwds'){
		
		unset($post['admin_pwds']);
		
		}
		}
		$res = Shop_admin::where('admin_id',$id)->update($post);

		if($res){
		
		return redirect('/admin');
		
		}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = Shop_admin::destroy($id);
        //dd($res);
		if($res){
		
		 echo json_encode(['code'=>'0','msg'=>'删除成功']);exit;

		}
    }

	public function checkNamed(){
	
	$admin_name = Request()->admin_name;
	
	$count = Shop_admin::where('admin_name',$admin_name)->count();
	echo $count;
	
	}

	public function updateNamed(){
	
	$admin_name = Request()->admin_name;

    $admin_id = Request()->admin_id;

    $where = [];

	$where[] = ['admin_name','=',$admin_name];

	$where[] = ['admin_id','<>',$admin_id];


	
	$count = Shop_admin::where($where)->count();
	echo $count;
	
	}
}
