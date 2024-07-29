<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Contact;
use Session;

class UserController extends Controller
{

    public function home(){
        $data = array();
        if(Session::has('loggedId')){
            $data = User::where('users_id','=',Session::get('loggedId'))->first();
        }
        return view('user.home',compact('data'));
    }

    public function about(){
        if(Session::has('loggedId')){
            return view('user.about');
        }
        else{
            return redirect()->route('login');
        }
    }

     public function service(){
        if(Session::has('loggedId')){
            return view('user.service');
        }
        else{
            return redirect()->route('login');
        }
    }

    public function contact(){
        if(Session::has('loggedId')){
            return view('user.contact');
        }
        else{
            return redirect()->route('login');
        }
    }

    public function contactStore(Request $req){
        $data = DB::table('contact')->where([['name','=',$req->name],['address','=',$req->address],['email','=',$req->email],['message','=',$req->message]])->first();
        
        if($data){
            return redirect()->route('contact')->with('error','Your message has already been sent successfully!');
        }
        else{
            $contact = DB::table('contact')->insert([
                'name'=>$req->name,
                'address'=>$req->address,
                'email'=>$req->email,
                'message'=>$req->message
            ]);

            if($contact){
                return redirect()->route('contact')->with('success','Your message has been sent successfully!');
            }
            else{
                return redirect()->route('contact')->with('error','Something went wrong, try again...');
            }
        }
    }

    public function registerStore(UserRequest $req){
        $req->validate([
            'password'=>'required|confirmed'
        ]);

        $data = DB::table('users')->where('email','=',$req->email)->first();

        if($data){
            return redirect()->route('register')->with('error','Email alreday exists...');
        }
        else{
            $user = DB::table('users')->insert([
                'name'=>$req->name,
                'address'=>$req->address,
                'email'=>$req->email,
                'password'=>Hash::make($req->password),
                'updated_at'=>now(),
                'created_at'=>now()
            ]);

            if($user){
                return redirect()->route('login')->with('success','You have been registered successfully!');
            }
            else{
                return redirect('')->route('register')->with('error','Something went wrong, try again...');
            }
        }
    }

    public function loginStore(Request $req){
       $user = User::where('email','=',$req->email)->first();

       if($user){
            if(Hash::check($req->password,$user->password)){
                $req->session()->put('loggedId',$user->users_id);
                return redirect()->route('about')->with('success','You have been logged in successfully!');
            }
            else{
                return redirect()->route('login')->with('error','Incorrect password...');
            }
       }
       else{
            return redirect()->route('login')->with('error','Invalid Credentials...');
       }
    }

    public function logout(){
        if(Session::has('loggedId')){
            Session::pull('loggedId');
            return redirect()->route('login');
        }
        else{
            return redirect()->route('login');
        }
    }
}
