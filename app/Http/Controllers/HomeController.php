<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(): View
    {
        // return view('home');
        $data['title'] = 'Dashboard';
        return view('profile', $data);
    }

    public function profile() : view {
        $data['title'] = 'Profile';
        return view('profile', $data);
    }

    function updateProfile(Request $request) : RedirectResponse {
        $this->validate($request, [
            'image' => 'nullable|image|mimes:jpeg,png,gif|max:2048',
            'name' => 'required',
            'phone' => 'required|regex:/^\+?[0-9\s.-]+$/|unique:users,phone,'.Auth::user()->id
        ]);
        $input = $request->all();
        // Check if image is coming with request
        if($request->hasFile('image')) {
            // Delete the old file
            if(Auth::user()->image) {
                Storage::delete(Auth::user()->image);
            }
            $path = $request->file('image')->store('uploads/users');
            $input['image'] = $path;
        }

        auth()->user()->update($input);
        return redirect()->route('profile')
                        ->with('success','Profile updated successfully');
    }
}
