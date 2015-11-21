<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Auth;
use App\User;
use App\City;
use App\Repositories\CityRepository;

class AuthController extends Controller {
	
	 /**
     * City Repository instance.
     *
     */
    protected $cityRepository;

    /**
     * Create a new authentication controller instance.
     * 
     * @return void
     */
    public function __construct(CityRepository $cityRepository)
    {	
		$this->cityRepository = $cityRepository;
        $this->middleware('guest', ['except' => ['getLogout', 'getLog', 'getProfile', 'postProfile','apiProfile','getApiProfile']]);
    }

    /**
     * Get auth
     *
     * @return json
     */
    public function getLog()
    {
        return ['auth' => Auth::check()];
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email', 
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->has('remember')))
        {
            return ['result' => 'success'];
        }

        return ['result' => 'fail'];
    }

	/**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email', 
            'password' => 'required',
        ]);
		
        $credentials = $request->only('email', 'password');
		
        if (Auth::attempt($credentials, $request->has('remember')))
        {
            return response()->json(['result' => 'success','user'=>Auth::user()]);
        }

        return response()->json(['result' => 'fail']);
    }

	
    /**
     * Log the user out of the application.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogout()
    {
        Auth::logout();

        return ['result' => 'success'];
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getRegister()
    {
        return view('auth.register');
    }

	/**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Repositories\UserRepository
     * @return \Illuminate\Http\Response
     */
    public function apiRegister(Request $request, UserRepository $userRepository)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);

        $user = $userRepository->store($request);

        Auth::login($user);

        return $user;
    }
	
    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Repositories\UserRepository
     * @return \Illuminate\Http\Response
     */
    public function postRegister(Request $request, UserRepository $userRepository)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);

        $user = $userRepository->store($request);

        Auth::login($user);

        return redirect('/');
    }
	
	/**
     * Show the application change profile form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getProfile(CityRepository $cityRepository)
    {
		if (!Auth::check() || !($user = Auth::user()))
        {
				// Auth::user() returns an instance of the authenticated user...
				return redirect("/");
        }
		
        return view('auth.profile',["user"=>$user, "cities"=>$cityRepository->all()]);
    }
	
	/**
     * Show the application change profile form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getApiProfile(CityRepository $cityRepository)
    {
		if (!Auth::check() || !($user = Auth::user()))
        {
				// Auth::user() returns an instance of the authenticated user...
				return ['result'=> "Not Logged In"];
        }
		
        return $user;
    }

    /**
     * Handle a change profile request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Repositories\UserRepository
     * @return \Illuminate\Http\Response
     */
    public function apiProfile(Request $request, UserRepository $userRepository)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            /* 'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6', */
        ]);
		//print_r($request); die;
        $user = $userRepository->update($request);


        return ['request'=> "success"];
    }
	
	/**
     * Handle a change profile request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Repositories\UserRepository
     * @return \Illuminate\Http\Response
     */
    public function postProfile(Request $request, UserRepository $userRepository)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            /* 'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6', */
        ]);
		//print_r($request); die;
        $user = $userRepository->update($request);


        return redirect('/auth/profile');
    }

}
