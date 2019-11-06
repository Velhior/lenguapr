<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\User;
use Session;
use Image;
use Storage;
use Illuminate\Http\Request;
class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function edit(User $user)
    {   
        $user = Auth::user();
        return view('frontend.pages.profile', compact('user'));
    }

    public function update(Request $request, User $user)
    { 
        $user=Auth::user();
        if($user->email == request('email')) {
        
            $this->validate(request(), [
                    'name' => 'required',
                  //  'email' => 'required|email|unique:users',
                    //'password' => 'required|min:6|confirmed'
                    'avatar' => 'dimensions:min_width=100,min_height=200'
                ]);
        
                $user->name = request('name');
                $user->avatar = request('avatar');
               // $user->email = request('email');
                //$user->password = bcrypt(request('password'));
                if($request->hasFile('avatar')){
                    $image = $request->file('avatar');
                    $filename = 'users/'.time() . '.' . $image->getClientOriginalExtension();
                    $location = public_path('storage/users/' . $filename);
                    Image::make($image)->save($location);
                    $oldFilename = $user->image;
                    $user->avatar = $filename;
                    Storage::delete($oldFilename);
                  }
                $user->save();
        
                return back();
                
            }
            else{
                
            $this->validate(request(), [
                    'name' => 'required',
                    'email' => 'required|email|unique:users',
                    'password' => 'required|min:6|confirmed',
                    'avatar' =>'image'
                ]);
        
                $user->name = request('name');
                $user->email = request('email');
                $user->avatar = request('avatar'); 
                //$user->password = bcrypt(request('password'));
                if($request->hasFile('avatar')){
                    $image = $request->file('avatar');
                    $filename = time() . '.' . $image->getClientOriginalExtension();
                    $location = public_path('storage/' . $filename);
                    Image::make($image)->save($location);
                    $oldFilename = $user->image;
                    $user->avatar = $filename;
                    Storage::delete($oldFilename);
                  }
                $user->save();
        
                return back();  
                
            }
    }
}