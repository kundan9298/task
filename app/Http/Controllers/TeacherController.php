<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Teacher;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class TeacherController extends Controller
{
    public function index(){
        return view('login');
    }


    public function loginData(Request $request){

        // echo $request->email;
        // echo $request->password;
        // die();
        

        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:3',
        ]);

        // $email = $request->email;
        // $password = $request->password;


        $user = Teacher::where('email','=',$request->email)->first();

        // if($user){
        //     echo 'hello';
        // }else{
        //     echo 'not';
        // }
        // echo $user;
        // die();
        if($user){
            if(Hash::check($request->password, $user->password)){
                $request->session()->put('loginId', $user->id);
                return redirect('studentDetails')->with('success', 'Login SuccessFull..');
            } else {
                return back()->with('fail','Password not match!');
            }
        } else {
            return back()->with('fail','This email is not register.');
        }        
    

        // if(Auth::attempt(['email' => $email, 'password' => $password])) {
        //     return redirect('studentDetails');
        // }

        // return back()->withErrors([
        //     'email' => 'The provided credentials do not match our records.',
        // ])->withInput($request->only('email'));



       
    }


    public function logout(){
        Session::flush(); 
        Auth::logout();   
        return redirect('/')->with('success', 'You have been logged out.');
    }
}
//