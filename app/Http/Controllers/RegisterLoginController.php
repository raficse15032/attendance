<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Models\Department;
use Sentinel;
use Activation;
use Mail;
use Reminder;
use Auth;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException; 
use Illuminate\Support\Facades\Redirect;
use DB;

class RegisterLoginController extends Controller
{
    public function register()
    {
        if (Sentinel::guest())
        {
           $department = Department::all();
            return view('user.register',compact('department'));
            
        }
        else{
            return redirect('/attendence/first');
        }
    	
    }
    public function postRegister(Request $request)
    {
        
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'dep_id'  => 'required',
        ]);

        $user = Sentinel::register($request->all()+['type' => 3]);
        $activation = Activation::create($user);
        $this->sendConfirmationEmail($user,$activation->code);
        return Redirect::back()
            ->with('flash_message', 'Please verify your email')
            ->with('flash_notification','success');
    }

    private function sendConfirmationEmail($user,$code){
        Mail::send('Email.activation',[
            'user' => $user,
            'code' => $code,
        ],function($message) use ($user){
            $message->to($user->email);
            $message->subject("Hello  $user->name, Activate your account");
        });
    }

    public function login()
    {
        if (Sentinel::guest())
        {
            return view('user.login');
            
        }
        else{
            return redirect('/attendence/first');
        }
    }

    // public function postLogin(Request $request)
    // {
    // 	// $user = Sentinel::registerAndActivate($request->all());
    //     // return Sentinel::check();
    //     // dd($request->all());
    //     try{
    //         if(Sentinel::authenticate($request->all())){
    //             $slug = Sentinel::getUser()->roles()->first()->slug;
    //             if($slug == 'manager'){
    //                 return "manager";
    //             }
    //             else{
    //                 return "Not manager";
    //             }
    //         }
    //         else{
    //             return "wrong";
    //         }
    //     }
    //     catch(ThrottlingException $e){
    //         $delay = $e->getDelay();
    //     }
    //     catch(NotActivatedException $e){
    //         return redirect()->back()->with(['error' => 'your account is not activated']);
    //     }
    // }

    public function postLogin(Request $request)
    {
        
        try{
            if(Sentinel::authenticate($request->all())){
                $user = Sentinel::findUserByCredentials($request->all());
                Sentinel::login($user);
            	return redirect('/attendence/first');
            }
            else{
                return Redirect::back()
                ->with('flash_message', "Credential not matched !!")
                ->with('flash_notification','danger');
            }
        }
        catch(ThrottlingException $e){
            $delay = $e->getDelay();
            return Redirect::back()
            ->with('flash_message', "Your account is suspend for '$delay' second ")
            ->with('flash_notification','danger');
        }
        catch(NotActivatedException $e){
            return Redirect::back()
            ->with('flash_message', 'Your account is not activated')
            ->with('flash_notification','danger');
        }
       
    }

    public function activateAccount($email,$activationCode)
    {

        $user = User::whereEmail($email)->first();
        $sentineluser = Sentinel::findById($user->id);
        if(Activation::complete($sentineluser,$activationCode)){
            return redirect('http://localhost:8000/login');
        }else
        {
            return "opps";
        }
    }

    private function sendEmail($user,$code){
        Mail::send('Email.activation',[
            'user' => $user,
            'code' => $code,
        ],function($message) use ($user){
            $message->to($user->email);
            $message->subject("Hello  $user->name, Activate your account");
        });

        //restart server and less secure app "on"
    }

    public function forgotPassword()
    {
        if (Sentinel::guest())
        {
           return view('user.forgot_password');
            
        }
        else{
            return redirect('/attendence/first');
        }
        
    }

    public function postForgotPassword(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|string|email|max:255'
        ]);

        $user = User::whereEmail($request->email)->first();

        if($user){
            $sentineluser = Sentinel::findById($user->id);
            $reminder = Reminder::exists($sentineluser) ? : Reminder::create($sentineluser);
            $this->sendResetEmail($user,$reminder->code);
            return Redirect::back()
                ->with('flash_message', 'Please check your email')
                ->with('flash_notification','success');
        }
        else{
            return Redirect::back()
            ->with('flash_message', 'Your email not matched !!')
            ->with('flash_notification','danger');
        }
    }

    public function resetPassword($email,$code)
    {
        $user = User::whereEmail($email)->first();
        $sentineluser = Sentinel::findById($user->id);

        if($reminder = Reminder::exists($sentineluser)){
            if($code == $reminder->code){
                return view('user.reset_password');
            }
            else
            {
                return "no";
            }
        }
    }

    private function sendResetEmail($user,$code){
        Mail::send('Email.forgot_password',[
            'user' => $user,
            'code' => $code,
        ],function($message) use ($user){
            $message->to($user->email);
            $message->subject("Hello  $user->name, Reset your account");
        });

        //restart server and less secure app "on"
    }

    public function postResetPassword(Request $request,$email,$code)
    {
        $this->validate($request, [
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::whereEmail($email)->first();
        $sentineluser = Sentinel::findById($user->id);

        if($reminder = Reminder::exists($sentineluser)){
            if($code == $reminder->code){
                Reminder::complete($sentineluser,$code,$request->password);
                return redirect('/login')
                ->with('flash_message', 'Password reset successfully')
                ->with('flash_notification','success');
            }
            else
            {
                return "no";
            }
        }
    }

    public function logout(){
        Sentinel::logout();
        return redirect('/login');
    }

    // public function newRole(){
    //     $role = Sentinel::getRoleRepository()->createModel();
    //     $role->name = 'Subscribers2';
    //     $role->slug = 'Subscribers2';
    //     $role->save();
    //     return "ok";

    //     // $user = Sentinel::findById(1);

    //     // $role = Sentinel::findRoleByName('Subscribers');

    //     // $role->users()->detach($user);
    // }

    // public function permission(){
    //     // return $role = Sentinel::findRoleByName('Subscribers')->permissions;
    //     return $role = $roles = DB::table('roles')->get();

    //     // $role->permissions = [
    //     //     'user.update' => true,
    //     //     'user.view' => true,
    //     // ];
    //     // $user->addPermission('user.create');
    //     // $user->addPermission('user.update', false);

    //     $a = false;
    //     $role->updatePermission('user.create',false, true);
    //     $role->updatePermission('user.update', $a, true)->save();

    //     // $role->save();
        
    //     return "ok";
    // }
}
