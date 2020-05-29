<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Shop_goods AS Goods;
use Validator;
use App\Brand;
use App\Shop_category;
use Illuminate\Validation\Rule;
use DB;
class Shop_goods extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
		//商品名称搜索
		$cate = Shop_category::all();
		$cate = CreateTree($cate);

		$name = Request()->name;
		$where = [];
		if(!empty($name)){
		
		$where[] = ['goods_name','like',"%$name%"];

		}
		$cate_id = Request()->cate_id;
		if(!empty($cate_id)){
		
		$where[] = ['shop_goods.cate_id','=',$cate_id];

		}
		$brand = Brand::select('brand_id','brand_name')->get();
		$brand_id = Request()->brand_id;
		if(!empty($brand_id)){
		
		$where[] = ['shop_goods.brand_id','=',$brand_id];

		}
		$min_price = Request()->min_price;
		if(!empty($min_price)){
		
		$where[] = ['goods_price','>=',$min_price];

		}
		$max_price = Request()->max_price;
		if(!empty($max_price)){
		
		$where[] = ['goods_price','<=',$max_price];

		}
        $pageSize = config('app.pageSize');
        //DB::connection()->enableQueryLog();
		//dd($pageSzie);
		//$brand=DB::table('brand')->orderBy('brand_id','desc')->paginate($pageSize);
		//第一种
		$goods = Goods::select('shop_goods.*','goods_name','brand_name','cate_name')
		->leftjoin('shop_category','shop_goods.cate_id','=','shop_category.cate_id')
		->leftjoin('brand','shop_goods.brand_id','=','brand.brand_id')
		->where($where)
		->orderBy('goods_id','desc')
		->paginate($pageSize);
		
        //dump($logs);

         if(request()->ajax()){
		 
		 return view('admin.goods.goodsajax',compact('goods','name','cate','cate_id','brand','brand_id','min_price','max_price'));
		 
		 
		 }
		
		
		return view('admin.goods.index',compact('goods','name','cate','cate_id','brand','brand_id','min_price','max_price'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
		$cate = Shop_category::all();
		$cate = CreateTree($cate);
		$brand = Brand::select('brand_id','brand_name')->get();
		//dd($cate);
        return view('admin.goods.create',['cate'=>$cate,'brand'=>$brand]);
    }
    public function CreateTree($cate,$pid=0,$level=0){
	//dump($pid);
    //dump($cate);
	if(!$cate) return;

	static $newArray = [];

	foreach($cate as $k=>$v){
	//dd($cate);
	if($v->pid == $pid){
	
	$v->level = $level;

	//dump($v);

	$newArray[] = $v;
    
    CreateTree($cate,$v->cate_id,$level+1);
	//dd($v->cate_id);
	}
	}
	return $newArray;
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


		
		//dd($post);

        $validator = Validator::make($post,[
			'goods_name' => 'regex:/^[\x{4e00-\x{9fa5}\w]{2,60}$/u|unique:shop_goods',
			'goods_sn' =>  'required',
			'cate_id' => 'required',
			'brand_id' =>'required',
			'goods_number' =>'required|numeric|max:99999999|min:0',
			'goods_price' => 'required|numeric',
		
		],[
			
			'goods_name.unique'=>'商品名称已存在',
			'goods_name.regex'=>'商品名称可以包含中文，字母，下划线，长度范围2-50位',
			'goods_sn.required' => '商品代号必填',
			'cate_id.required' => '商品分类必填',
			'brand_id.required' =>'商品品牌必填',
			'goods_number.required' =>'商品库存必填',
			'goods_price.required' => '商品价格必填',
			'goods_price.numeric' => '商品价格必须是数字',
			'goods_number.numeric' =>'商品库存必须是数字',
            'goods_number.min' =>'商品库存不能为0',
			'goods_number.max' =>'商品库存不能大于千万',

		]);
		if($validator->fails()){
		return redirect('/goods/create')
			->withErrors($validator)
			->withInput();

		
		}
		//文件上传
		if($request->hasFile('goods_img')){
		//echo '有文件上传';
		$post['goods_img'] = upload('goods_img');
		
		}
		//多文件上传
		if(isset($post['goods_imgs'])){
		
		 $post['goods_imgs'] = Moreupload('goods_imgs');
		 $post['goods_imgs'] = implode('|',$post['goods_imgs']);
		
		}

		
		$goods = new Goods();

		$res = $goods::insert($post);

		if($res){
		
		return redirect('/goods');
		
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
        $goods = Goods::find($id);

		$cate = Shop_category::all();
		$cate = CreateTree($cate);
		$brand = Brand::select('brand_id','brand_name')->get();

		return view('admin.goods.edit',['goods'=>$goods,'cate'=>$cate,'brand'=>$brand]);
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
			'goods_name' => ['regex:/[\x{4e00-\x{9fa5}\w]{2,60}/u',
		     Rule::unique('shop_goods')->ignore(request()->id,'goods_id')
		     ],
			'goods_sn' =>  'required',
			'cate_id' => 'required',
			'brand_id' =>'required',
			'goods_number' =>'required|numeric|max:99999999|min:0',
			'goods_price' => 'required|numeric',
		
		],[
			
			'goods_name.unique'=>'商品名称已存在',
			'goods_name.regex'=>'商品名称可以包含中文，字母，下划线，长度范围2-50位',
			'goods_sn.required' => '商品代号必填',
			'cate_id.required' => '商品分类必填',
			'brand_id.required' =>'商品品牌必填',
			'goods_number.required' =>'商品库存必填',
			'goods_price.required' => '商品价格必填',
			'goods_price.numeric' => '商品价格必须是数字',
			'goods_number.numeric' =>'商品库存必须是数字',
            'goods_number.min' =>'商品库存不能为0',
			'goods_number.max' =>'商品库存不能大于千万',

		]);
		if($validator->fails()){
		return redirect("/goods/edit/$id")
			->withErrors($validator)
			->withInput();
		
		
		}
		//文件上传
		if($request->hasFile('goods_img')){
		//echo '有文件上传';
		$post['goods_img'] = upload('goods_img');
		
		}

		//多文件上传
		if(isset($post['goods_imgs'])){
		
		 $post['goods_imgs'] = Moreupload('goods_imgs');
		 $post['goods_imgs'] = implode('|',$post['goods_imgs']);
		
		}

		
		$res = Goods::where('goods_id',$id)->update($post);
		if($res!==false){
		
         return redirect('/goods');
		
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
        $res = Goods::destroy($id);
        //dd($res);
		if($res){
		
		 echo json_encode(['code'=>'0','msg'=>'删除成功']);exit;

		}
    }

	public function checkNamec(){
	
	$goods_name = Request()->goods_name;
	
	$count = Goods::where('goods_name',$goods_name)->count();
	echo $count;
	
	}

	public function updateNamec(){
	
	$goods_name = Request()->goods_name;

	$goods_id = Request()->goods_id;

	$where = [
		
	
	['goods_name','=',$goods_name],
	['goods_id','<>',$goods_id],
	
	];
	
	$count = Goods::where($where)->count();
	echo $count;
	
	}
}
