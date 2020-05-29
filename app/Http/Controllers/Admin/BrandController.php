<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests\StoreBrandPost;
use Validator;
use Illuminate\Validation\Rule;
use App\Brand;
use App\Shop_category;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$page = Request()->page??1;
		

	    $brand_name = Request()->brand_name;

		//$brand = Cache::get('brand_'.$page.'_'.$brand_name);

		$brand = Redis::get('brand_'.$page.'_'.$brand_name);

        
		if(!$brand){
		$where = [];

		if(!empty($brand_name)){
		
		$where[] = ['brand_name','like',"%$brand_name%"];

		}
		//$brand = DB::table('brand')->get();
		$pageSize = config('app.pageSize');
		//dd($pageSzie);
		//$brand=DB::table('brand')->orderBy('brand_id','desc')->paginate($pageSize);
		//第一种
		$brand = Brand::getBrandIndex($pageSize,$where);
		
	    //Cache::put('brand_'.$page.'_'.$brand_name,$brand,60);


        $brand = serialize($brand);
        Redis::setex('brand_'.$page.'_'.$brand_name,60,$brand);



		}

		 $brand = unserialize($brand);
       

		if(request()->ajax()){
		
		 return view('admin.brand.brandajax',['brand'=>$brand,'brand_name'=>$brand_name]);
		
		}
		//dd($brand);
		return view('admin.brand.index',['brand'=>$brand,'brand_name'=>$brand_name]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	public function store(Request $request)
    //public function store(StoreBrandPost $request)
    {
		/*
		$validateData = $request->validate([
			'brand_name' => 'required|unique:brand',
			'brand_url' => 'required',
		
		],[
			'brand_name.required'=>'品牌名称必填',
			'brand_name.unique'=>'品牌名称已存在',
			'brand_url.required'=>'品牌网址必填',
		  
		]);
		*/
        $post = $request->except('_token');
		
        //dd($post); 
        $validator = Validator::make($post,[
			'brand_name' => 'regex:/^[\x{4e00-\x{9fa5}\w]{2,18}$/u|unique:brand',
			'brand_url' => 'required|regex:/^[0-9a-zA-Z]+@\w+(\.)com$/',
		
		],[
			'brand_name.regex'=>'品牌名称可以包含中文，字母，下划线，长度范围2-18位',
			'brand_name.unique'=>'品牌名称已存在',
			'brand_url.required'=>'品牌网址必填',
		    'brand_url.regex'=>'品牌网址格式不正确',
		]);
		if($validator->fails()){
		return redirect('/brand/create')
			->withErrors($validator)
			->withInput();
		
		}
		//dd($post);
		//文件上传
		if($request->hasFile('brand_logo')){
		

		//echo '有文件上传';
		$post['brand_logo'] = upload('brand_logo');
		
		}
		
		//$res = DB::table('brand')->insert($post);

		//第一种
	    $brand = new Brand();
		//dd($brand);
		$brand->brand_name = $post['brand_name'];
        $brand->brand_url = $post['brand_url'];
		if(isset($post['brand_logo'])){
		$brand->brand_logo = $post['brand_logo'];
		}
        $brand->brand_desc = $post['brand_desc'];
		//$res = $brand->save();
		//$res = $brand::insert($post);
		//第二种
        $res = $brand::create($post);
		if($res){
		  return redirect('/brand');
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
		//根据id获取资源
		//$brand = DB::table('brand')->where('brand_id',$id)->first();
		$brand = Brand::find($id);

		return view('admin.brand.edit',['brand'=>$brand]);

		
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
			'brand_name' => ['regex:/^[\x{4e00-\x{9fa5}\w]{2,18}$/u',
		     Rule::unique('brand')->ignore(request()->id,'brand_id')
		     ],
			
			'brand_url' => 'required|regex:/^[0-9a-zA-Z]+@\w+(\.)com$/',
		
		],[
			'brand_name.regex'=>'品牌名称可以包含中文，字母，下划线，长度范围2-18位',
			'brand_name.unique'=>'品牌名称已存在',
			'brand_url.required'=>'品牌网址必填',
		    'brand_url.regex'=>'品牌网址格式不正确',
		]);
		if($validator->fails()){
		return redirect('/brand/create')
			->withErrors($validator)
			->withInput();
		
		}
		//dump($post);
		//dump($id);
        if($request->hasFile('brand_logo')){
		//echo '有文件上传';
		$post['brand_logo'] = upload('brand_logo');
		}
		//DB
		//$res = DB::table('brand')->where('brand_id',$id)->update($post);
		//ORM
		//1
		//$brand = Brand::find($id);
        //$brand->brand_name = $post['brand_name'];
        //$brand->brand_url = $post['brand_url'];
		//if(isset($post['brand_logo'])){
		//$brand->brand_logo = $post['brand_logo'];
		//}
        //$brand->brand_desc = $post['brand_desc'];
		//$res = $brand->save();
		//2
		$res = Brand::where('brand_id',$id)->update($post);
		if($res!==false){
		
         return redirect('/brand');
		
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
        $res = Brand::destroy($id);
        //dd($res);
		if($res){
		
		 echo json_encode(['code'=>'0','msg'=>'删除成功']);exit;

		}
    }

	public function checkNamea(){
	
	$brand_name = Request()->brand_name;
	
	$count = Brand::where('brand_name',$brand_name)->count();
	echo $count;
	
	}
     
public function updateNamea(){
	
	$brand_name = Request()->brand_name;

	$brand_id = Request()->brand_id;

	$where = [
		
	
	['brand_name','=',$brand_name],
	['brand_id','<>',$brand_id],
	
	];
	
	$count = Brand::where($where)->count();
	echo $count;
	
	}

}
