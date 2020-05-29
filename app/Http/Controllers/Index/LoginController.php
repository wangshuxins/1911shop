<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;
use App\Mail\sendCode;
use Illuminate\Support\Facades\Mail;
use App\Register;
use Illuminate\Validation\Rule;
use Validator;
use Illuminate\Support\Facades\Cookie;

class LoginController extends Controller
{
	 //渲染的登陆页面
     public function login(){
	     
	     return view('index.login');

	 }

	  //登陆
     public function dologin(){
	     
	     $post = Request()->except('_token');

		 //dump($post);

		 if(empty($post['username'])){
		 
		 return redirect('/login')->with('msg','用户名不能为空!');
		 
		 }

		 if(empty($post['pwd'])){
		 
		 return redirect('/login')->with('msg','密码不能为空!');
		 
		 }

		 $requister = Register::where('username',$post['username'])->first();

		 if(empty($requister)){
		 
		 return redirect('/login')->with('msg','用户名或者密码错误');
		 
		 }

		 if(decrypt($requister->pwd)!=$post['pwd']){
		 
		 return redirect('/login')->with('msg','用户名或者密码错误');
		 
		 }

		 if(isset($post['isremember'])){
	
	       Cookie::queue('requister',serialize($requister),60*24*10);
	
	     }

		 session(['requister'=>$requister]);

		 if($post['refer']){
		 
		 return redirect($post['refer']);
		 
		 }

		 return redirect('/');

	 }

	 //退出
	 public function logout(){
	
	 Request()->session()->flush();
     
	 return redirect('/login');
	
	 }

##############################################################################################################################################################

	 //渲染的注册页面
	 public function register(){
	     
	     return view('index.register');

	 }
     
	 //手机号发送验证码
	 public function sendSms(){
	
	 $mobile = Request()->username;

	 $reg = '/^1[3|4|5|6|7|8|9]\d{9}$/';

	 if(!preg_match($reg,$mobile)){
	
             echo json_encode(['code'=>'0','msg'=>'请输入正确的手机号']);die;
	  
	     }

	 $code = rand(100000,999999);

     $result = $this->send($mobile,$code);

	 if($result['Message']=='OK'){

	 session(["code"=>['name'=>$mobile,'code'=>$code]]);

	     Request()->session()->save();
 
	     echo json_encode(['code'=>'00','msg'=>'发送成功，请注意接收']);die;
	 
	  
	     }
	 }
     //AccessKeyID：
     //LTAI4GJojHTY1TzxDUa9L77c
     //AccessKeySecret：
     //3Qs0BryiTD1JLcXHw98gbJtnv39Oo8
	 public function send($mobile,$code){
	
	 AlibabaCloud::accessKeyClient('LTAI4GJojHTY1TzxDUa9L77c', '3Qs0BryiTD1JLcXHw98gbJtnv39Oo8')
                        ->regionId('cn-hangzhou')
                        ->asDefaultClient();

         try {              
			             
                 $result = AlibabaCloud::rpc()
                             ->product('Dysmsapi')
                              // ->scheme('https') // https | http
                              ->version('2017-05-25')
                              ->action('SendSms')
                              ->method('POST')
                              ->host('dysmsapi.aliyuncs.com')
                              ->options([
                                             'query' => [
                                             'RegionId' => "cn-hangzhou",
							                 'PhoneNumbers' => $mobile,
							                 'SignName' => "撼天地震乾坤",
							                 'TemplateCode' => "SMS_182675132",
							                 'TemplateParam' => "{code:$code}",
                                         ],
                                     ])
                          ->request();
                                 
             return $result->toArray();
	                             
         } catch (ClientException $e) {
	                               
             return $e->getErrorMessage() . PHP_EOL;
          
	                             
         } catch (ServerException $e) {
	         
                                  
              return $e->getErrorMessage() . PHP_EOL;
                                 
         }

	 }

     //邮件发送验证码
	 public function sendEmail(){
	
	 $email = Request()->username;

	 //dd($email);

	 $reg = '/^\d{3,10}@qq(\.)com$/';

	 if(!preg_match($reg,$email)){
	
              echo json_encode(['code'=>'0','msg'=>'请输入正确的邮箱']);die;
	   
	     }

     $code = rand(100000,999999);
	
	 //使用邮箱发送验证码
	     Mail::to($email)->send(new sendCode($code));
 
	     session(["code"=>['name'=>$email,'code'=>$code]]);
 
	     Request()->session()->save();
 
	     echo json_encode(['code'=>'00','msg'=>'发送成功，请注意接收']);die;

	 }
     //注册
	 public function doregister(){
	
	     $post = Request()->except('_token');
  
	     $code = Request()->session()->get('code');
 
	     //dd($post);
     
         $post['reg_time'] = time();

         //dd($post);
	 	
		 if(substr_count($post['username'],'@')>0){
         
		     if($post['username']!=$code['name']||$post['code']!=$code['code']){
			     
			     return redirect('/register')->with('msg','获取验证码与用户邮箱不一致');
			     
		 }

		 $validator = Validator::make($post,[
			'user_name' => 'regex:/^\d{3,10}@qq(\.)com$/|unique:Register',
			'code' => 'regex:/^\d{6}$/|required',
			'pwd' => 'regex:/^[0-9a-zA-Z]{6,18}$/',
			'repwd' => 'required|same:pwd',
			
		 ],[
			 
			'user_name.unique'=>'用户名已存在',
			'user_name.regex'=>'邮箱格式不正确',
			'code.required'=>'验证码不能为空',
			'code.regex'=>'邮箱格式不正确',
			'pwd.regex'=>'密码格式不正确',
			'repwd.required'=>'确认密码不能为空',
			'repwd.same'=>'确认密码和密码保持一致',
			
		 ]);

		 if($validator->fails()){
			     
		     return redirect('/Register/reg')
			     
			 ->withErrors($validator)
				 
			 ->withInput();
		 }   

     }else{

            if($post['username']!=$code['name']||$post['code']!=$code['code']){
			
			 return redirect('/register')->with('msg','获取验证码与用户手机号不一致');
			
			}
            $validator = Validator::make($post,[
			'user_name' => 'regex:/^1[3|4|5|6|7|8|9]\d{9}$/|unique:Register',
			'code' => 'regex:/^\d{6}$/|required',
			'pwd' => 'regex:/^[0-9a-zA-Z]{6,12}$/',
			'repwd' => 'required|same:pwd',
			
		
		],[
			
			'user_name.unique'=>'用户名已存在',
			'user_name.regex'=>'手机号格式不正确',
			'code.required'=>'验证码不能为空',
			'code.regex'=>'邮箱格式不正确',
			'pwd.regex'=>'密码格式不正确',
			'repwd.required'=>'确认密码不能为空',
			'repwd.same'=>'确认密码和密码保持一致',
			
		]);
		 if($validator->fails()){
		 return redirect('/Register/reg')
			     
			 ->withErrors($validator)
				  
			 ->withInput();
		 }
		
     }
        
		 $register = new Register();

		 foreach($post as $k=>$v){
         
	         if($k=='repwd'){
                 
		         unset($post['repwd']);
 
		     }
	     }

         //dd(Request()->session()->exists('email'));
         foreach($post as $k=>$v){
         
	         if($k=='code'){
                 
		         unset($post['code']);
  
		     }
	     }

         $post['pwd'] = encrypt($post['pwd']);

		 $res = $register::insert($post);

		 if($res){
		
		     return redirect('/login');
		 
		 }
	 
	 }
	 //邮箱或者手机号js唯一性
     public function checkName(){
	 
	     $username = Request()->username;
	 
	     $count = Register::where('username',$username)->count();

	     echo $count;
	
	 }
}
