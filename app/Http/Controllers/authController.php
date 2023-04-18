<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class authController extends Controller
{
    public function index(){
        return view('login');
    }


    public function signup(){
        return view('signup');
    }

    public function logmein(Request $request){
        $request->validate([
            'email' => 'required|email|',
            'password' => 'required|min:4',
        ]);

            $user = User::where('email', '=', $request->email)->first();

            if($user){
                if(hash::check($request->password, $user->password)){
                    $request->session()->put('loginId', $user->id);
                    return redirect('home');
                }else{
                    return back()->with('fail', 'Incorrect Password');
                }

            }else{
                return back()->with('fail', 'Email is not registered');
            }
    }

    public function register(Request $request){
        $validated = $request->validate([
            'fname' => 'required|min:4',
            'lname' => 'required|min:4',
            'email' => 'required|unique:users|max:255',
            'password' => 'required|confirmed'
        ]);

        $insertToTheDB = DB::table('users')->insert([
            'fname' => $request->fname,
            'mname' => $request->mname,
            'lname' => $request->lname,
            'email' => $request->email,
            'password' => Hash::make($request->password)

        ]);

        if($insertToTheDB){
            return redirect()->route('login');
        }
    }

    public function home(Request $request){
        $data = array();
        if ($request->Session()->has('loginId'))
        {
             $data = User::where('id', '=', $request->Session()->get('loginId'))->first();

        }return view('home', compact('data'));
    }

    public function logout(Request $request){
        if($request->Session()->has('loginId')){
            $request->Session()->pull('loginId');
            return redirect('login');
        }
     }




}
