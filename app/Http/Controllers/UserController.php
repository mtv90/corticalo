<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use App\Right;

class UserController extends Controller
{
    public function __construct(){

        $this->middleware('auth');

        $this->middleware(function ($request, $next) {
            
            $role = Role::find(auth()->user()->role_id);
            if (count($role->rights)>0) {
                return $next($request);
            }
            return redirect('/dashboard')->with('error', 'Sie haben noch keine Zugriffsrechte erhalten! Wenden sie sich an ihren Admin!');               
          
        });

    }

    public function show($id){

        $user = User::find($id);
        
        $role_id = $user->role_id;
        $role = Role::find($role_id);
        
        $role = Role::find(auth()->user()->role_id);

        foreach ($role->rights as $right) {
            if ($right->usershow == 1 || auth()->user()->id == $user->id ) {
                return view('user.show')->with('user', $user)->with('role', $role)->with('rights', $role->rights);
            }
        }
        return redirect('/dashboard')->with('error', 'Sie haben kein Zugriffsrecht!');        

    }
}
