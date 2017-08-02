<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BTPAsset;
use App\loginModel as Login;
use Session;

class LoginController extends Controller
{
    //
    protected $APIAsset;
    protected $login;

    public function __construct(BTPAsset $BTPAsset){
      $this->login = new Login();
      $this->APIAsset=$BTPAsset;
    }

    public function loginPage(){
      $token = Session::get('access_token');
      if($token){
        return redirect()->action('AssetController@tableAsset');
      }else{
        return view('login-page.login');
      }
    }

    public function login(Request $request){
        //$email = 'asset@btp.or.id', $password = 'btpasset'
        $email = $request->email;
        $password = $request->password;
        //cek jwt di sqlite by email
        $isLogin = $this->isLogin($email);
        if($isLogin){
          $user = Login::where('email',$email)->first();
        }else{
          //generate jwt
          $hitAPI = $this->APIAsset->getAccessToken($email,$password);
          if($hitAPI->status==200){
            $user = $this->storeLogin($email,$hitAPI->result);
          }else{
            //Unauthorized
            return view('login-page.login');
          }
        }
        $token = $user->access_token;
        //simpan token+username di session
        Session::put("access_token", $token);
        $username = $this->extractToken();
        Session::put("username", $username);
        return redirect()->action('DashboardController@home');
    }

    public function isLogin($email){
      $user = Login::where('email',$email)->first();
      if($user == null){
        return false;
      }else{
        return true;
      }
    }

    public function storeLogin($email,$token){
      $user = new Login();
      $user->email = $email;
      $user->access_token = $token->access_token;
      $user->refresh_token = $token->refresh_token;
      $user->status='';
      $user->save();
      return $user;
    }

    public function logout(){
      Session::forget('access_token');
      return view('login-page.login');
    }

    public function extractToken(){
      $result = $this->APIAsset->get('user');
      return $result->result->name;
    }

    public function tokenSession(){
      dd(Session::get('access_token'));
    }
}
