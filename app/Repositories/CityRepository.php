<?php

namespace App\Repositories;

use App\City;
use Auth;

class CityRepository {

    /**
     * Get Citys with user paginate.
     *
     * @param  integer $n
     * @return collection
     */
    public function getCitiesWithUserPaginate($n)
    {
        $citys = City::with('user')
                ->latest()
                ->simplePaginate($n);

        return $citys;
    }

	/**
     * Get Citys with user paginate.
     *
     * @param  integer $n
     * @return collection
     */
    public function all()
    {
        $citys = City::all();

        return $citys;
    }

    /**
     * Store a city.
     *
     * @param  array  $inputs
     * @param  integer $user_id
     * @return boolean
     */
    public function store($inputs, $user_id)
    {
        $city = new City;
        $city->content = $inputs['content'];
        $city->user_id = $user_id;
        $city->save();
    }

    /**
     * Update a city.
     *
     * @param  array  $inputs
     * @param  integer $id
     * @return boolean
     */
    public function update($inputs, $id)
    {
        $city = $this->getById($id);

        if ($this->checkUser($city))
        {
            $city->content = $inputs['content'];
            return $city->save();
        }
        return false;
    }

    /**
     * Destroy a city.
     *
     * @param  integer $id
     * @return boolean
     */
    public function destroy($id)
    {
        $city = $this->getById($id);

        if ($this->checkUser($city))
        {
            return $city->delete();
        }
        return false;
    }

    /**
     * Get a city by id.
     *
     * @param  integer $id
     * @return boolean
     */
    public function getById($id)
    {
        return City::findOrFail($id);
    }

    /**
     * Check valid user.
     *
     * @param  App\City $city
     * @return boolean
     */
    private function checkUser(City $city)
    {
        return $city->user_id == Auth::id() || Auth::user()->admin;
    }

}
