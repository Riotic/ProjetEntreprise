<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Synthstuc;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Http\Middleware\IsAdmin;
use App\Http\Controllers\Auth\Redirect;
use Exception;
use Illuminate\Support\Facades\DB;

class RegisteredUserController extends Controller
{

    public function create()
    {
        return view('auth.register');
    }


    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'role' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        try {
            $user = User::create([
                'name' => $request->name,
                'surname' => $request->surname,
                'role' => $request->role,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            $data = "--".$request->name." ".$request->surname."--".$request->email."--".$request->role."---none";
            DB::insert('insert into notifications ( type,notifiable_type,notifiable_id,data,read_at,created_at) values (?,?,?,?,?,?)', ['register',$request->role,$user->id,$data,date('Y-m-d H:i:s'),date('Y-m-d H:i:s')]);

            event(new Registered($user));
        } catch (Exception $t){
            abort(403, 'Unauthorized action.');
        }




        // Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }


}
