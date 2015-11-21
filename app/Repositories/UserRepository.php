<?php

namespace App\Repositories;

use App\User;

class UserRepository {

    /**
     * Store a user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return App\User
     */
    public function store($request)
    {
        return User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
    }
	
	public function getUsersPaginate($n){
		$users = User::latest()
                ->simplePaginate($n);

        return $users;
	}
	
	/**
     * Update a user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return App\User
     */
    public function update($request)
    {
		
		$data = [
            'name' => $request->name,
            'city_id' => $request->city_id,
			'blood_group' => $request->blood_group,
			'last_donation_date' => $request->last_donation_date,
			'height' => $request->height,
			'weight' => $request->weight,
			'is_eligible' => (($request->height*10/$request->weight)>1),
			'last_ill_date' => $request->last_ill_date,
			'age' => $request->age,
			'mobile' => $request->mobile
        ];
		
		//print_r($data); die;
        return User::where('id', $request->id)->update($data);
    }

}
