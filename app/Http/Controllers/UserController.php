<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

/**
 * Class UsersController.
 *
 * @package namespace App\Http\Controllers;
 */
class UserController
{
    use ResponseTrait;

    protected $service;
    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $user = $this->service->getAllUsersExceptUserAuth();
        return $this->successResponse($user, 200);
    }

    /**
     * Display a user auth
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUserAuth()
    {
        $user = $this->service->getUserAuth();
        return $this->successResponse($user, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UserUpdateRequest $request
     * @param  int               $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    // public function update(UserFormRequest $request, $id)
    // {
    //     $user = $this->service->update($request->all(), $id);
    //     return $this->successResponse($user, 200);
    // }

    /**
     * Generic method to get dynamic data filtered
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $users = $this->service->search($request);
        return $this->successResponse($users, 200);
    }
}
