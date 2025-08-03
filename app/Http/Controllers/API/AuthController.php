<?php

namespace App\Http\Controllers\API;

use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Response;
use Session;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    /**
     * Register
     */
    public function register(Request $request)
    {
        abort_if(Gate::denies('user-register') , 403 , 'Forbidden 403');
        try {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();

            $success = true;
            $message = 'User register successfully';
        } catch (QueryException $ex) {
            $success = false;
            $message = $ex->getMessage();
        }

        // response
        $response = [
            'success' => $success,
            'message' => $message,
        ];
        return response()->json($response);
    }

    /**
     * Login
     */
    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        $u = User::where("email" , $request->email)->first();
        if($u ==null){
            $success = false;
            $message = 'اسم المستخدم / كلمة المرور خاطئة';
        }else {
            if ($u->is_active) {
                if (Auth::attempt($credentials)) {
                    $success = true;
                    $message = 'User login successfully';
                } else {
                    $success = false;
                    $message = 'اسم المستخدم / كلمة المرور خاطئة';
                }
            } else {
                $success = false;
                $message = 'الحساب غير مفعل حاليا';
            }
        }

        // response
        $response = [
            'success' => $success,
            'message' => $message,
            'user' => Auth::user(),
        ];
        return response()->json($response);
    }

    /**
     * Logout
     */
    public function logout()
    {
        try {
            Session::flush();
            $success = true;
            $message = 'Successfully logged out';
        } catch (QueryException $ex) {
            $success = false;
            $message = $ex->getMessage();
        }

        // response
        $response = [
            'success' => $success,
            'message' => $message,
        ];
        return response()->json($response);
    }

    public function getAuthUser(){
        return response()->json(["user"=>auth('sanctum')->user()]);
    }

    public function changePassword(Request $request){
        // Validation
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|confirmed',
        ]);


        //Match The Old Password
        if(!Hash::check($request->old_password, auth()->user()->password)){
            return \response()->json([ "error"=> "كلمة المرور المدخلة غير صحيحة"] ,403);
        }


        //Update the new Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->password)
        ]);

        return \response()->json(["message"=>"تم تغيير كلمة المرور بنجاح"]);
    }
}
