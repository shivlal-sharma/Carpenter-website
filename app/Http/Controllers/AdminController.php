<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Contact;
use App\Models\Admin;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Session;
use App\Http\Requests\UserRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
use App\Mail\UserResetPassword;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    public function adminLogin(Request $req){
        $admin = Admin::where('email',$req->email)->where('status','active')->first();
 
        if($admin){
             if(Hash::check($req->password,$admin->password)){
                 $req->session()->put('admin_id',$admin->admin_id);
                 return redirect()->route('dashboard');
             }
             else{
                 return redirect()->route('admin_sign_in')->with('error','Incorrect password...');
             }
        }
        else{
             return redirect()->route('admin_sign_in')->with('error','Invalid Credentials...');
        }
    }

    public function forgetPassword(Request $req){
        $req->validate([
            'email'=>'required|email'
        ]);

        $admin = Admin::where('email',$req->email)->where('status','active')->first();

        if($admin){
            $updateAdmin = DB::table('admins')->where('email',$req->email)->where('status','active')->update([
                'token_expire_at'=>Carbon::now()->addMinutes(5),
            ]);

            if($updateAdmin){
                $name = $admin->name;
                $token = $admin->token;
                $encryptedToken = Crypt::encryptString($token);
                $url = url("admin/reset-password/".urlencode($encryptedToken));
                try{
                    Mail::to($admin->email)->send(new UserResetPassword($url,$name));
                    return redirect()->route('admin_sign_in')->with('success','Verify Email...');
                }
                catch(\Exception $e){
                    return redirect()->route('forgetPassword')->with('error','Something went wrong...');
                }
            }
            else{
                return redirect()->route('forgetPassword')->with('error','Something went wrong...');
            }
        }
        else{
            return redirect()->route('forgetPassword')->withError('Invalid Email...');
        }
    }

    public function viewResetPassPage($urlEncodeToken){
        $urlDecodeToken = urldecode($urlEncodeToken);

        try{
            $token = Crypt::decryptString($urlDecodeToken);
        }
        catch(\Exception $e){
            return view('admin.forgetPassword');
        }

        if(Admin::where('token',$token)->where('token_expire_at','>=',Carbon::now())->where('status','active')->exists()){
            return view('admin.resetPassword',compact('urlEncodeToken'));
        } 
        else{
            return view('admin.forgetPassword');
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
            return redirect()->route('admin_sign_in')->withError('Something went wrong...');
        }

        if(Admin::where('token',$token)->where('token_expire_at','>=',Carbon::now())->where('status','active')->exists()){
            if($req->password === $req->password_confirmation){
                $updateAdmin = Admin::where('token',$token)->where('token_expire_at','>=',Carbon::now())->where('status','active')->update([
                    'password'=>Hash::make($req->password),
                    'token_expire_at'=>null,
                    'email_verified_at'=>Carbon::now(),
                    'updated_at'=>Carbon::now()
                ]);

                if($updateAdmin){
                    return redirect()->route('admin_sign_in')->withSuccess('Password changed successfully!');
                }else{
                    return redirect()->route('admin_sign_in')->withError('Something went wrong...');
                }
            }
            else{
                return redirect()->route('resetPassword',$req->urlEncodeToken)->withError('Incorrect confirm password');
            }
        }
        else{
            return view('admin.forgetPassword');
        }
    }

    public function adminLogout(){
        Session::pull('admin_id');
        return redirect()->route('admin_sign_in');
    }

    public function dashboard(){
        $total_users = User::count();
        $total_active_users = User::where('status','active')->count();
        $total_inactive_users = User::where('status','inactive')->count();
        $total_trashed_users = User::onlyTrashed()->count();
        $total_contacts = Contact::count();
        $total_trashed_contacts = Contact::onlyTrashed()->count();
        $total_admins = Admin::count();
        $total_active_admins = Admin::where('status','active')->count();
        $total_inactive_admins = Admin::where('status','inactive')->count();
        $total_trashed_admins = Admin::onlyTrashed()->count();
        return view('admin.dashboard',compact('total_users','total_active_users','total_inactive_users','total_trashed_users','total_contacts','total_trashed_contacts','total_admins','total_active_admins','total_inactive_admins','total_trashed_admins'));
    }

    public function users(){
        $usersData = User::all();
        return view('admin.users',compact('usersData'));
    }

    private function generateUniqueToken(){
        do{
            $generatedToken = Str::random(10);
        }while(Admin::where('token',$generatedToken)->exists());

        return $generatedToken;
    }

    public function userAdd(UserRequest $req){
        $req->validate([
            'password'=>'required|confirmed'
        ]);
        
        if(DB::table('users')->where('email',$req->email)->where('status','active')->exists()){
            return redirect()->route('userAdd')->with('error','Email already exists...');
        }
        else{
            $token = $this->generateUniqueToken();
            $addUser = DB::table('users')->insert([
                'name'=>$req->name,
                'address'=>$req->address,
                'email'=>$req->email,
                'password'=>Hash::make($req->password),
                'status'=>"active",
                'token' => $token,
                'created_at'=>Carbon::now()
            ]);
    
            if($addUser){
                return redirect()->route('user-info')->with('success','User added successfully!');
            }
            else{
                return redirect()->route('userAdd')->with('error','Something went wrong...');
            }
        }
    }

    public function userTrash($id){
        $userDelete = User::find($id);
        if(!is_null($userDelete)){
            $userDelete->delete();
         return redirect()->route('user-info')->with('success','User moved to Trash!');
        }
        else{
         return redirect()->route('user-info')->with('error','Something went wrong...');
        }
    }

    public function userEditPage($id){
        $user = User::where('users_id',$id)->first();
        return view('admin.editUser',compact('user'));
    }

    public function userEdit($id, UserRequest $req){
        $req->validate([
            'password'=>'required|confirmed'
        ]);

        $user = User::find($id);
        if(!is_null($user)){
            $user->name = $req['name'];
            $user->address = $req['address'];
            $user->email = $req['email'];
            $user->password = Hash::make($req->password);
            $user->status = $req['status'];
            $user->token = $req['token'];
            $user->updated_at = Carbon::now();
            $user->save();
            if($user->save()){
                return redirect()->route('user-info')->with('success','User updated successfully!');
            }
            else{
                return redirect()->route('userEdit',$user->users_id)->with('error','Something went wrong...');
            }
        }
        else{
            return redirect()->route('userEdit',$user->users_id)->with('error','Something went wrong...');
        }
    }

    public function userTrashView(){
        $usersData = User::onlyTrashed()->get();
        return view('admin.trashedUser',compact('usersData'));
    }

    public function userForceDelete($id){
        $user = User::withTrashed()->find($id);
        if(!is_null($user)){
            $user->forceDelete();
            return redirect()->route('userTrashView')->with('success','User deleted successfully!');
        }
        else{
            return redirect()->route('userTrashView')->with('error','Something went wrong...');
        }
    }
    
    public function userRestore($id){
        $user = User::withTrashed()->find($id);
        if(!is_null($user)){
            $user->restore();
            return redirect()->route('user-info')->with('success','User restored successfully!');
        }
        else{
            return redirect()->route('userTrashView')->with('error','Something went wrong...');
        }
    }

// ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    public function contacts(){
        $contactsData = Contact::all();
        return view('admin.contacts',compact('contactsData'));
    }

    public function contactAdd(Request $req){
        $contact = Contact::where([['name','=',$req->name],['address','=',$req->address],['email','=',$req->email],['message','=',$req->message]])->first();
        if($contact){
            return redirect()->route('contactAdd')->with('error','Message already exists...');
        }
        else{
            $addContact = DB::table('contact')->insert([
                'name'=>$req->name,
                'address'=>$req->address,
                'email'=>$req->email,
                'message'=>$req->message,
                'created_at'=>Carbon::now()
            ]);

            if($addContact){
                return redirect()->route('contact-info')->with('success','Message added successfully!');
            }
            else{
                return redirect()->route('contactAdd')->with('error','Something went wrong...');
            }
        }
    }

    public function contactTrash($id){
        $contactDelete = Contact::find($id);
        if(!is_null($contactDelete)){
            $contactDelete->delete();
            return redirect()->route('contact-info')->with('success','Message moved to Trash!');
        }
        else{
            return redirect()->route('contact-info')->with('error','something went wrong...');
        }
    }

    public function contactEditPage($id){
        $contact = Contact::where('contact_id',$id)->first();
        return view('admin.editcontact',compact('contact'));
    }

    public function contactEdit(Request $req,$id){
        $contact = Contact::where('contact_id',$id)->first();
        $contactExist = Contact::where([['name',$req->name],['address',$req->address],['email',$req->email],['message',$req->message]])->first();
        if($contactExist){
            return redirect()->route('contactEditPage',$contact->contact_id)->with('error','Message already exists...');
        }
        else{
            $contactEdit = Contact::where('contact_id',$id)->update([
                'name'=>$req->name,
                'address'=>$req->address,
                'email'=>$req->email,
                'message'=>$req->message,
                'updated_at'=>Carbon::now()
            ]);
            if($contactEdit){
                return redirect()->route('contact-info')->with('success','Message updated successfully!');
            }
            else{
                return redirect()->route('contactEditPage',$contact->contact_id)->with('error','Something went wrong...');
            }
        }
    }

    public function contactTrashView(){
        $contactsData = Contact::onlyTrashed()->get();
        return view('admin.trashedContact',compact('contactsData'));
    }

    public function contactForceDelete($id){
        $contact = Contact::withTrashed()->find($id);
        if(!is_null($contact)){
            $contact->forceDelete();
            return redirect()->route('contactTrashView')->with('success','Message deleted successfully!');
        }
        else{
            return redirect()->route('contactTrashView')->with('error','Something went wrong...');
        }
    }
    
    public function contactRestore($id){
        $contact = Contact::withTrashed()->find($id);
        if(!is_null($contact)){
            $contact->restore();
            return redirect()->route('contact-info')->with('success','Message restored successfully!');
        }
        else{
            return redirect()->route('contactTrashView')->with('error','Something went wrong...');
        }
    }

// ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    public function admins(){
        $adminsData = Admin::all();
        return view('admin.admins',compact('adminsData'));
    }

    public function adminAdd(Request $req){
        $req->validate([
            'password'=>'required|confirmed'
        ],
        ['password.confirmed'=>'Incorrect confirm password']);

        $admin_exists = Admin::where('email',$req->email)->where('status','active')->first();

        if($admin_exists){
            return redirect()->route('adminAdd')->withError('Email already exists...');
        }
        else{
            $token = $this->generateUniqueToken();
            $admin = DB::table('admins')->insert([
                'name'=>$req->name,
                'email'=>$req->email,
                'password'=>Hash::make($req->password),
                'status'=>"active",
                'token' => $token,
                'email_verified_at'=>Carbon::now(),
                'created_at'=>Carbon::now()
            ]);
    
            if($admin){
                return redirect()->route('admin-info')->withSuccess('Admin added successfully!');
            }
            else{
                return redirect()->route('adminAdd')->withError('Something went wrong...');
            }
        }
    }

    public function adminTrash($id){
        $admin = Admin::find($id);
        if($admin){
            $admin->delete();
            return redirect()->route('admin-info')->withSuccess('Admin moved to Trash!');
        }
        else{
            return redirect()->route('admin-info')->withError('Something went wrong...');
        }
    }

    public function adminEditPage($id){
        $admin = Admin::find($id);
        if(!is_null($admin)){
            return view('admin.editAdmin',['admin'=>$admin]);
        }
        else{
            return redirect()->route('admin-info')->withError('Something went wrong...');
        }
    }

    public function adminEdit(Request $req,$id){
        $req->validate([
            'password'=>'required|confirmed'
        ],['password.confirmed'=>'Incorrect confirm password']);

        $admin = Admin::find($id);
        if(!is_null($admin)){
            $admin->name = $req->name;
            $admin->email = $req->email;
            $admin->password = Hash::make($req->password);
            $admin->status = $req->status;
            $admin->token = $req->token;
            $admin->updated_at = Carbon::now();
            if($admin->save()){
                return redirect()->route('admin-info')->withSuccess('Admin updated successfully!');
            }
            else{
                return redirect()->route('adminEdit',$admin->admin_id)->withError('Something went wrong...');
            }
        }
        else{
            return redirect()->route('adminEdit',$admin->admin_id)->withError('Something went wrong...');
        }
    }

    public function adminTrashView(){
        $adminsData = Admin::onlyTrashed()->get();
        return view('admin.trashedAdmin',compact('adminsData'));
    }

    public function adminForceDelete($id){
        $admin = Admin::withTrashed()->find($id);
        if(!is_null($admin)){
            $admin->forceDelete();
            return redirect()->route('adminTrashView')->withSuccess('Admin deleted successfully!');
        }
        else{
            return redirect()->route('adminTrashView')->withError('Something went wrong...');
        }
    }

    public function adminRestore($id){
        $admin = Admin::withTrashed()->find($id);
        if(!is_null($admin)){
            $admin->restore();
            return redirect()->route('admin-info')->withSuccess('Admin restored successfully!');
        }
        else{
            return redirect()->route('adminTrashView')->withError('Something went wrong...');
        }
    }

}
