<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    //
    public function login(Request $request){
    	$this->validate($request,[
    		'email' => 'required',
    		'password' => 'required',
    	]);

    	$user = User::where('email','=',$request->email)->firstOrFail();
    	$status = "error";
    	$message = "";
    	$data = null;
    	$code = 401;
    	if($user){
    		if(Hash::check($request->password, $user->password)){
    			$user->generateToken();
    			$status = 'success';
    			$message = 'Login Sukses';
    			$data = $user->toArray();
    			$code = 200;
    		}
    		else {
    			$message = "login gagal, password salah";
    		}
    	}
    	else{
    		$message = "Login gagal, username salah";
    	}
    	return response()->json([
    		'status' => $status,
    		'message' => $message,
    		'data' => $data
    	], $code);
    }

    public function register(Request $request){
    	$validator = Validator::make($request->all(),[
    		'name' => 'required|string|max:255',
    		'email' => 'required|string|email|max:255|unique:users',
    		'password' => 'required|string|min:6'
    	]);

    	 $status = "error";     
    	 $message = "";     
    	 $data = null;     
    	 $code = 400; 
    	 if ($validator->fails()) {         
    	 	$errors = $validator->errors();         
    	 	$message = $errors;     
    	 } 
    	 else {   
            if ($request->hasFile('avatar')) {
                      # code...
                    $avatar = $request->file('avatar');
                    $filename = 'fesyen'.time();
                    $avatar->move(public_path('images/avatar'),$filename);

                    //return $filename;
                }
            else {
                $filename = null;
            }      
    	 	$user = User::create([             
    	 		'name' => $request->name,             
    	 		'email' => $request->email,             
    	 		'password' => Hash::make($request->password),             
    	 		'roles' => json_encode(['CUSTOMER']), 
                'avatar' => $filename       
    	 	]); 

    	 	if ($user) {             
    	 		$user->generateToken();             
    	 		$status = "success";            
    	 		$message = "register successfully";             
    	 		$data = $user->toArray();             
    	 		$code = 200;         
    	 	} 
    	 	else {             
    	 		$message = 'register failed';         
    	 	}     
    	}     
    	return response()->json([         
    		'status' => $status,         
    		'message' => $message,         
    		'data' => $data     
    	], $code);
    }

    public function logout(Request $request){
    	$user = Auth::user();
    	if($user){
    		$user->api_token = null;
    		$user->save();
    	}
    	return response()->json([
    		'status'=>'success',
    		'message'=>'logout berhasil',
    		'data'=>null
    	],200);
    }

    public function update_profile(Request $request){
        $user = Auth::user();
        
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email|max:255',
            'password' => 'required|min:6|confirmed'
        ]);

        $status = "error";
        $message = "";
        $data = null;
        $code = 400;
        if ($validator->fails()) {
            # code...
            $errors = $validator->errors();
            $message = $errors;
        }
        else {
            $request->validate([
                'avatar' => 'image'
            ]);

            $avatar = $request->file('avatar');
            $extension = $avatar->getClientOriginalExtension();
            if ($user->avatar == null) {
                $filename = time().'.'.$extension;
            }
            else {
                $filename = $user->avatar;
            }
            $avatar->move(public_path('images\avatar'),$filename);
            $user->avatar = $filename;
            printf($filename);
            
            $user->name = request('name');
            $user->email = request('email');
            $user->password = bcrypt(request('password'));
            $user->address = request('address');
            $user->phone = request('phone');
            $user->province_id = request('province_id');
            $user->city_id = request('city_id');

            $user->save();

            if ($user) {
                # code...
                $status = "success";
                $message = "update successfully";
                $data = $user->toArray();
                $code = 200;
            }
            else {
                $message = 'Update failed';
            }
        }

        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data
        ], $code);
    }
    
    public function edit_image(Request $request){
        $user = Auth::user();

        $status = "error";
        $message = "";
        $data = null;
        $code = 400;

        $request->validate([
            'avatar' => 'image'
        ]);

        if ($request->hasFile('avatar')) {
            # code...
            //Storage::delete($files);
            $avatar = $request->file('avatar');
            $extension = $avatar->getClientOriginalExtension();
            if ($user->avatar == null) {
                # code...
                $filename = time().'.'.$extension;
            }
            else {
                $filename = $user->avatar;
            }
            $avatar->move(public_path('images\avatar'),$filename);
            $user->avatar = $filename;
        }

        $user->save();

        if ($user) {
            $status = "success";
            $message = "update successfully";
            $data = $user->toArray();
            $code = 200;
        } else {
            $message = 'edit avatar gagal';
        }

        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data
        ], $code);
    }

    public function cek_password(Request $request){
        $user = Auth::user();

        $status = "error";
        $message = "";
        $data = null;
        $code = 401;

        if (Hash::check($request->password, $user->password)) {
            # code...
            $status = 'success';
            $message = 'password benar';
            $data = $user->toArray();
            $code = 200;
        }
        else {
            $message = "password salah";
        }

        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data
        ], $code);
    }
}
