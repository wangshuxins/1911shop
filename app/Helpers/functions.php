<?php
 function upload($filename){
	
	    if(request()->file($filename)->isValid()){
	    $file = request()->$filename;
	    $path = request()->$filename->store('uploads');
	    return $path;
	    }
	     return '文件上传出错';
	    }

    function CreateTree($cate,$pid=0,$level=0){
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

	function Moreupload($filename){
		
		$files = request()->$filename;

		//dd($files);

		if(!count($files)){
		
		return;
		
		}
		
		foreach($files as $k=>$v){
		
		   $path[] = $v->store('uploads');
		
		}
		
		   return $path;
		
		}

		
			function success($error_msg){
	
	            echo json_encode(['error_no'=>0,'error_msg'=>$error_msg]);exit;
	
	         }
	          function error($error_msg){
	
	              echo json_encode(['error_no'=>1,'error_msg'=>$error_msg]);exit;
	
	         }


?>