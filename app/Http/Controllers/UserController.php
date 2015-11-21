<?php

namespace App\Http\Controllers;

use Illuminate\Http\Exception\HttpResponseException;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use Auth;

class UserController extends Controller {

    /**
     * Repository instance.
     *
     */
    protected $userRepository;

    /**
     * Validation rules.
     *
     */
    protected $rules = [
        'content' => 'required|max:2000',
    ];

    /**
     * Create a new UserController controller instance.
     *
     * @param  App\Repositories\UserRepository $userRepository
     * @return void
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;

        $this->middleware('auth', ['only' => ['store', 'update', 'destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return $this->userRepository->getUsersPaginate(4);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Illuminate\Http\Request  $request
     * @return Response
     */
    /* public function store(Request $request)
    {
        $this->validate($request, $this->rules);

        $this->userRepository->store($request->all(), Auth::id());

        return $this->userRepository->getUsersWithUserPaginate(4);
    } */

    /**
     * Update the specified resource in storage.
     *
     * @param  Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, $this->rules);

        if ($this->userRepository->update($request->all(), $id)) 
        {
            return ['result' => 'success'];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     *//* 
    public function destroy($id)
    {
        if ($this->userRepository->destroy($id)) 
        {
            return ['result' => 'success'];
        }
    }
 */
}
