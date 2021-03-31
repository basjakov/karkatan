<?php

namespace App\Http\Controllers;

use App\Http\Requests\MakeProfileRequest;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\order;

class AccountController extends Controller
{
    public function create(){
       if(Auth::check()){
           return redirect('/dashboard');
       }
        return view('website.register');
    }
    public function store(MakeProfileRequest $request){
        if(!Auth::check()) {
            $validated = $request->validated();
            $username = $validated['username'];
            $description = array('EN' => $request->descriptionen, 'RU' => $request->descriptionru, 'SP' => $request->descriptionsp, 'IT' => $request->descriptionit, 'FR' => $request->descriptionfr, 'ARM' => $request->descriptionarm);
            if ($request->hasfile('profile_image')) {
                $file = $request->file('profile_image');
                $profile_photo_url = Storage::disk('local')->putFile("/public/profiles/$username", $file);
            } else {
                $profile_photo_url = 'https://cdn1.iconfinder.com/data/icons/website-internet/48/website_-_male_user-512.png';
            }
            User::create([
                'name' => $validated['name'],
                'lastname' => $validated['lastname'],
                'username' => $validated['username'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'position' => $request->position,
                'country' => $validated['country'],
                'region' => $validated['region'],
                'city' => $request->city,
                'address' => $validated['address'],
                'zipcode' => $validated['zipcode'],
                'profile_photo' => $profile_photo_url,
                'status' => 'user',
                'description' => json_encode($description),
            ]);
                Auth::attempt(['email' => $validated['email'], 'password' => Hash::make($validated['password'])]);
                return redirect('/dashboard');

            }
            else{
                return redirect('/dashboard');
            }
    }
    public function Dashboard(){
            $userid = Auth::user()->id;
            $products = Product::paginate(30);
            $user = User::find($userid);
            $order = order::where('expert_id',Auth::user()->id)->get();
            return view('website.profile.dashboard',['user'=>$user,'products'=>$products,'order'=>$order->first()]);
    }
    public function show($id){
        $user = User::find($id);
        return view('website.profile.page',compact('user'));
    }
}
