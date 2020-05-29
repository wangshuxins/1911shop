<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Article AS ArticleModel;
use App\Articleclass;
use Validator;
use Illuminate\Validation\Rule;
class Article extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		
       $articleclass = Articleclass::all();

	   $name = Request()->name;

       $where = [];

		if(!empty($name)){
		
		$where[] = ['article_title','like',"%$name%"];

		}
		$cate_id = Request()->cate_id;
		if(!empty($cate_id)){
		
		$where[] = ['articleclass.cate_id','=',$cate_id];

		}

	   $pageSize = config('app.pageSize');
       $article = ArticleModel::select('article.*','article.cate_id','cate_name')
		->leftjoin('articleclass','article.cate_id','=','articleclass.cate_id')
		->where($where)
		->orderBy('order_article','desc')
		->paginate($pageSize);

        if(request()->ajax()){
		
		return view('admin.article.indexajax',['article'=>$article,'articleclass'=>$articleclass,'name'=>$name,'cate_id'=>$cate_id]);
		
		}
	   return view('admin.article.index',['article'=>$article,'articleclass'=>$articleclass,'name'=>$name,'cate_id'=>$cate_id]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		 $articleclass = Articleclass::all();

        return view('admin.article.create',['arr'=>$articleclass]);
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
			'article_title' => 'regex:/^[\x{4e00-\x{9fa5}\w]{2,60}$/u|unique:article',
			'cate_id' =>  'required',
			'cate_id' => 'required',
			'article_man' =>'required',
			'article_email' =>'required',
			'article_key' =>'required',
			
		
		],[
			
			'article_title.unique'=>'文章名称已存在',
			'article_title.regex'=>'文章名称可以包含中文，字母，下划线，长度范围2-50位',
			'cate_id.required' => '文章分类必填',
			'article_man.required' => '文章作者必填',
			'article_email.required' =>'作者email必填',
			'article_key.required' =>'关键字必填',
		]);
		if($validator->fails()){
		return redirect('/article/create')
			->withErrors($validator)
			->withInput();

		
		}
		//文件上传
		if($request->hasFile('article_img')){
		//echo '有文件上传';
		$post['article_img'] = upload('article_img');
		
		}
		

		$post['article_time'] = time();
		$article = new ArticleModel();

		$res = $article::insert($post);

		if($res){
		
		return redirect('/article');
		
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
        $arr = ArticleModel::find($id);

		$articleclass = Articleclass::all();
		

		return view('admin.article.edit',['arr'=>$arr,'articleclass'=>$articleclass]);
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

        $validator = Validator::make($post,[
			'article_title' =>['regex:/[\x{4e00-\x{9fa5}\w]{2,60}/u',
		     Rule::unique('article')->ignore(request()->id,'article_id')
		     ], 
			'cate_id' =>  'required',
			'cate_id' => 'required',
			'article_man' =>'required',
			'article_email' =>'required',
			'article_key' =>'required',
			
		
		],[
			
			'article_title.unique'=>'文章名称已存在',
			'article_title.regex'=>'文章名称可以包含中文，字母，下划线，长度范围2-50位',
			'cate_id.required' => '文章分类必填',
			'article_man.required' => '文章作者必填',
			'article_email.required' =>'作者email必填',
			'article_key.required' =>'关键字必填',
		]);
		if($validator->fails()){
		return redirect("/article/edit/$id")
			->withErrors($validator)
			->withInput();

		
		}
		//文件上传
		if($request->hasFile('article_img')){
		//echo '有文件上传';
		$post['article_img'] = upload('article_img');
		
		}
		

		
		

		
		$res = ArticleModel::where('article_id',$id)->update($post);
		if($res!==false){
		
         return redirect('/article');
		
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
        $res = ArticleModel::destroy($id);
        //dd($res);
		if($res){
		
		 echo json_encode(['code'=>'0','msg'=>'删除成功']);exit;

		}
    }

	public function checkName(){
	
	$article_title = Request()->article_title;
	$count = ArticleModel::where('article_title',$article_title)->count();
	echo $count;
	
	}

	public function updateName(){
	
	$article_title = Request()->article_title;

	$article_id = Request()->article_id;

	$where = [];

	$where[] = ['article_title','=',$article_title];

    $where[] = ['article_id','<>',$article_id];
	
	$count = ArticleModel::where($where)->count();
	echo $count;
	
	}
}
