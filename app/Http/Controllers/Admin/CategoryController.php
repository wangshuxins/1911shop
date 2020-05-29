<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Validator;
use Illuminate\Validation\Rule;
use App\Shop_category;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
		//DB
		//$cate = DB::table('shop_category')->get();
		//dump($cate);
		//MODEL
		$cate = Shop_category::all();
		$cate = CreateTree($cate);
		//dd($cate);
		return view('admin.category.index',['res'=>$cate]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
		//DB
		//$cate = DB::table('shop_category')->get();
		//dump($cate);
		//MODEL
		$cate = Shop_category::all();
		$cate = CreateTree($cate);
		//dd($cate);
		return view('admin.category.create',['cate'=>$cate]);
        
    }
    
	
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

		$validateData = $request->validate([
			'cate_name' => 'regex:/^[\x{4e00-\x{9fa5}\w]{2,18}$/u|unique:shop_category',
			'pid' => 'required',
		
		],[
			'cate_name.regex'=>'分类名称可以包含中文，字母，下划线，长度范围2-18位',
			'cate_name.unique'=>'分类名称已存在',
			'pid.required' =>'分类id必填',
		  
		]);
        $post = $request->except('_token');

		//dump($post);

		//$res = DB::table('shop_category')->insert($post);

		$shop_category = new Shop_category();

		//$shop_category->cate_name = $post['cate_name'];
        
        //$shop_category->pid = $post['pid'];

		//$shop_category->cate_show = $post['cate_show'];

        //$shop_category->cate_nav_show = $post['cate_nav_show'];

		//$shop_category->cate_desc = $post['cate_desc'];

		//$res = $shop_category->save();

		//$res = $shop_category->create($post);

		$res = $shop_category::insert($post);

		if($res){
		
		return redirect('/category'); 
		
		}

        
		
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
		$cate = Shop_category::all();
		$res = Shop_category::find($id);
		$cate = CreateTree($cate);
        //echo $id;
		//$res = DB::table('shop_category')->where('cate_id',$id)->first();
		
		//dd($res);
		return view('admin.category.edit',['res'=>$res,'cate'=>$cate]);
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
		    
			$validator = Validator::make($post,[
			'cate_name' => ['regex:/[\x{4e00-\x{9fa5}\w]{2,60}/u',
		     Rule::unique('shop_category')->ignore(request()->id,'cate_id')
		     ],
			
			'pid' => 'required',
		
		],[
			'cate_name.regex'=>'分类名称可以包含中文，字母，下划线，长度范围2-18位',
			'cate_name.unique'=>'分类名称已存在',
			'pid.required' =>'分类id不能为空',
			
		]);
		if($validator->fails()){
		return redirect("/category/edit/$id")
			->withErrors($validator)
			->withInput();
		
		}
       
		//dump($post);
		//$res = Db::table('shop_category')->where('cate_id',$id)->update($post);
        //MODEL
		//$shop_category = new Shop_category();
        
        //$shop_category = Shop_category::find($id);

		//$shop_category->cate_name = $post['cate_name'];
        
        

		//$shop_category->cate_show = $post['cate_show'];

        //$shop_category->cate_nav_show = $post['cate_nav_show'];

		//$shop_category->cate_desc = $post['cate_desc'];

		//$res = $shop_category->save();
		$res = Shop_category::where('cate_id',$id)->update($post);

		if($res!==false){
		
		return redirect('/category'); 
		
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
        $res = Shop_category::destroy($id);
        //dd($res);
		if($res){
		
		 echo json_encode(['code'=>'0','msg'=>'删除成功']);exit;

		}
    }



	public function checkNameb(){
	
	$cate_name = Request()->cate_name;
	
	$count = Shop_category::where('cate_name',$cate_name)->count();
	echo $count;
	
	}

	public function updateNameb(){
	
	$cate_name = Request()->cate_name;

	$cate_id = Request()->cate_id;

	$where = [
	
	['cate_name','=',$cate_name],
	['cate_id','<>',$cate_id]
	
	];
	
	$count = Shop_category::where($where)->count();
	echo $count;
	
	}
}
