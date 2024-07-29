<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Contact;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Session;
use App\Http\Requests\UserRequest;

class AdminController extends Controller
{
    public function dashboard(){
        $users = User::count();
        $contacts = Contact::count();
        $usersTrashed = User::onlyTrashed()->count();
        $contactsTrashed = Contact::onlyTrashed()->count();
        return view('admin.dashboard',compact('users','contacts','usersTrashed','contactsTrashed'));
    }

    public function users(){
        $usersData = User::all();
        return view('admin.users',compact('usersData'));
    }

    public function userAdd(UserRequest $req){
        $req->validate([
            'password'=>'required|confirmed'
        ]);
        
        $user = DB::table('users')->where('email',$req->email)->first();
        if($user){
            return redirect()->route('userAdd')->with('error','Email already exists, try again...');
        }
        else{
            $addUser = DB::table('users')->insert([
                'name'=>$req->name,
                'address'=>$req->address,
                'email'=>$req->email,
                'password'=>Hash::make($req->password)
            ]);
    
            if($addUser){
                return redirect()->route('user-info')->with('success','New User has been added successfully!');
            }
            else{
                return redirect()->route('userAdd')->with('error','New User not added, try again...');
            }
        }
    }

    public function userTrash($id){
        $userDelete = User::find($id);
        if(!is_null($userDelete)){
            $userDelete->delete();
         return redirect()->route('user-info')->with('success','User has been moved to Trash!');
        }
        else{
         return redirect()->route('user-info')->with('error','User not moved to Trash...');
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
            $user->save();
            if($user->save()){
                return redirect()->route('user-info')->with('success','User has been updated successfully!');
            }
            else{
                return redirect()->route('userEdit',$user->users_id)->with('error','User not updated...');
            }
        }
        else{
            return redirect()->route('userEdit',$user->users_id)->with('error','Something went wrong, try again...');
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
            return redirect()->route('userTrashView')->with('success','User has been deleted permanently successfully!');
        }
        else{
            return redirect()->route('userTrashView')->with('error','User not deleted permanently...');
        }
    }
    
    public function userRestore($id){
        $user = User::withTrashed()->find($id);
        if(!is_null($user)){
            $user->restore();
            return redirect()->route('user-info')->with('success','User has been restored successfully!');
        }
        else{
            return redirect()->route('userTrashView')->with('success','User has been restored successfully!');
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
            return redirect()->route('contactAdd')->with('error','Your message has already been added successfully!');
        }
        else{
            $addContact = DB::table('contact')->insert([
                'name'=>$req->name,
                'address'=>$req->address,
                'email'=>$req->email,
                'message'=>$req->message
            ]);

            if($addContact){
                return redirect()->route('contact-info')->with('success','Your message has been added successfully!');
            }
            else{
                return redirect()->route('contactAdd')->with('error','Something went wrong, try again...');
            }
        }
    }

    public function contactTrash($id){
        $contactDelete = Contact::find($id);
        if(!is_null($contactDelete)){
            $contactDelete->delete();
            return redirect()->route('contact-info')->with('success','Message has been moved to Trash!');
        }
        else{
            return redirect()->route('contact-info')->with('error','Message not moved to Trash...');
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
                'message'=>$req->message
            ]);
            if($contactEdit){
                return redirect()->route('contact-info')->with('success','Message has been updated successfully!');
            }
            else{
                return redirect()->route('contactEditPage',$contact->contact_id)->with('error','Message not updated...');
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
            return redirect()->route('contactTrashView')->with('success','Contact has been deleted permanently successfully!');
        }
        else{
            return redirect()->route('contactTrashView')->with('error','Contact not deleted permanently...');
        }
    }
    
    public function contactRestore($id){
        $contact = Contact::withTrashed()->find($id);
        if(!is_null($contact)){
            $contact->restore();
            return redirect()->route('contact-info')->with('success','Contact has been restored successfully!');
        }
        else{
            return redirect()->route('contactTrashView')->with('success','Contact has been restored successfully!');
        }
    }
}
