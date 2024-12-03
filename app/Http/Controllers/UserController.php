<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Contact;
use Session;
use App\Mail\UserResetPassword;
use App\Mail\UserEmailVerification;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;

class UserController extends Controller
{
    public function contactStore(Request $req){
        $req->validate([
            'email'=>'required|email'
        ],
        [
            'email.email'=>'Invalid email address'
        ]);

        $data = DB::table('contact')->where([['name','=',$req->name],['address','=',$req->address],['email','=',$req->email],['message','=',$req->message]])->first();
        
        if($data){
            return redirect()->route('contact')->with('error','Message sent successfully!');
        }
        else{
            $contact = DB::table('contact')->insert([
                'name'=>$req->name,
                'address'=>$req->address,
                'email'=>$req->email,
                'message'=>$req->message
            ]);

            if($contact){
                return redirect()->route('contact')->with('success','Message sent successfully!');
            }
            else{
                return redirect()->route('contact')->with('error','Something went wrong...');
            }
        }
    }

    public function verifyEmail($urlEncodeToken){
        $urlDecodeToken = urldecode($urlEncodeToken);

        try{
            $token = Crypt::decryptString($urlDecodeToken);
        }
        catch(\Exception $e){
            return redirect()->route('register')->withError('Something went wrong...');
        }
        
        $user = User::whereNotNull('token')->where('token',$token)->where('token_expire_at','>=',Carbon::now())->first();

        if($user){
            $user->status = "active";
            $user->token_expire_at = null;
            $user->email_verified_at = now();
            if($user->save()){
                return redirect()->route('login')->withSuccess('Email verified successfully!');
            }else{
                return redirect()->route('login')->withError('Something went wrong...');
            }
        }
        else{
            return redirect()->route('register');
        }
    }

    private function generateUniqueToken(){
        do{
            $generatedToken = Str::random(10);
        }while(User::where('token',$generatedToken)->exists());

        return $generatedToken;
    }

    public function registerStore(UserRequest $req){
        $req->validate([
            'password'=>'required|confirmed'
        ]);

        if(User::where('email',$req->email)->where('status','active')->exists()){
            return redirect()->route('register')->with('error','Email exists...');
        }

        $token = $this->generateUniqueToken();
        $encryptedToken = Crypt::encryptString($token);

        $user = DB::table('users')->insert([
            'name'=>$req->name,
            'address'=>$req->address,
            'email'=>$req->email,
            'password'=>Hash::make($req->password),
            'status'=>"inactive",
            'token' => $token,
            'token_expire_at'=> Carbon::now()->addMinutes(2),
            'created_at'=>Carbon::now()
        ]);

        if($user){
            $url = url("verify-email/".urlencode($encryptedToken));
            try{
                Mail::to($req->email)->send(new UserEmailVerification($url,$req->name));
                return redirect()->route('login')->withSuccess('Verify Email...');
            }
            catch(\Exception $e){
                return redirect()->route('register')->withError('Something went wrong...');
            }
        }
        else{
            return redirect()->route('register')->with('error','Something went wrong...');
        }
    }
    

    public function loginStore(Request $req){
        $user = User::where('email',$req->email)->where('status','active')->first();
        
        if($user){
            if(Hash::check($req->password,$user->password)){
                $req->session()->put('user_id',$user->users_id);
                return redirect()->route('service');
            }
            else{
                return redirect()->route('login')->with('error','Incorrect password...');
            }
        }
        else{
            return redirect()->route('login')->with('error','Invalid Credentials...');
        }
    }

    public function forgetPassword(Request $req){
        $req->validate([
            'email'=>'required|email'
        ]);

        $user = User::where('email',$req->email)->where('status','active')->first();

        if($user){
            $updateUser = DB::table('users')->where('email',$req->email)->where('status','active')->update([
                'token_expire_at'=>Carbon::now()->addMinutes(5),
            ]);

            if($updateUser){
                $name = $user->name;
                $token = $user->token;
                $encryptedToken = Crypt::encryptString($token);
                $url = url("reset-password/".urlencode($encryptedToken));
                try{
                    Mail::to($user->email)->send(new UserResetPassword($url,$name));
                    return redirect()->route('login')->with('success','Verify Email...');
                }
                catch(\Exception $e){
                    return redirect()->route('forget_password')->with('error','Something went wrong...');
                }
            }
            else{
                return redirect()->route('forget_password')->with('error','Something went wrong...');
            }
        }
        else{
            return redirect()->route('forget_password')->withError('Invalid Email...');
        }
    }

    public function viewResetPassPage($urlEncodeToken){
        $urlDecodeToken = urldecode($urlEncodeToken);

        try{
            $token = Crypt::decryptString($urlDecodeToken);
        }
        catch(\Exception $e){
            return view('user.forget_pass');
        }

        if(User::where('token',$token)->where('token_expire_at','>=',Carbon::now())->where('status','active')->exists()){
            return view('user.reset_pass',compact('urlEncodeToken'));
        } 
        else{
            return view('user.forget_pass');
        }
    }

    public function resetPassword(Request $req){
        $req->validate([
            'password'=>'required|confirmed',
        ],['password.confirmed'=>'Incorrect confirm password']);

        $urlDecodeToken = urldecode($req->urlEncodeToken);

        try{
            $token = Crypt::decryptString($urlDecodeToken);
        }
        catch(\Exception $e){
            return redirect()->route('login')->withError('Something went wrong...');
        }

        if(User::where('token',$token)->where('token_expire_at','>=',Carbon::now())->where('status','active')->exists()){
            if($req->password === $req->password_confirmation){
                $updateUser = User::where('token',$token)->where('token_expire_at','>=',Carbon::now())->where('status','active')->update([
                    'password'=>Hash::make($req->password),
                    'token_expire_at'=>null,
                    'email_verified_at'=>Carbon::now(),
                    'updated_at'=>Carbon::now()
                ]);

                if($updateUser){
                    return redirect()->route('login')->withSuccess('Password changed successfully!');
                }else{
                    return redirect()->route('login')->withError('Something went wrong...');
                }
            }
            else{
                return redirect()->route('reset_password',$req->urlEncodeToken)->withError('Incorrect confirm password');
            }
        }
        else{
            return view('user.forget_pass');
        }
    }

    public function logout(){
        Session::pull('user_id');
        return redirect()->route('login');
    }
}