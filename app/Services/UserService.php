<?php

namespace App\Services;

use App\Exceptions\CustomException;
use App\Repositories\UserRepository;
use App\Traits\UserTrait;
use Prettus\Repository\Criteria\RequestCriteria;

class UserService extends BaseService
{
    use UserTrait;

    protected $repository;
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get All users except user auth
     *
     * @return array
     */
    public function getAllUsersExceptUserAuth()
    {
        $user = $this->getUserAuth();
        return $this->repository->findWhereNotIn('id', [$user->id]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public function index()
    {
        return $this->getUserAuth();
    }

    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    // public function index()
    // {
    //     return $this->repository->all();
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param array $data
     *
     * @return array
     */
    // public function store(array $data)
    // {
    //     try {
    //         $data['password'] = bcrypt($data['password']);
    //         return $this->repository->create($data);
    //     } catch (Exception $e) {
    //         throw new CustomException('Unable complete the operation.', 400);
    //     }
    // }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return array
     */
    public function show(int $id)
    {
        return $this->findById($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  array $data
     * @param  int $id
     *
     * @return array
     */
    // public function update(array $data, int $id)
    // {
    //     $this->findById($id);
    //     $this->checkUserPermissions($id);
    //     try {
    //         if (isset($data['password'])) {
    //             $data['password'] = bcrypt($data['password']);
    //         }
    //         return $this->repository->update($data, $id);
    //     } catch (Exception $e) {
    //         throw new CustomException('Unable complete the operation.', 400);
    //     }
    // }

    /**
     * Get a specified resource by id.
     *
     * @param  int $id
     *
     * @return array
     */
    public function findById(int $id)
    {
        try {
            return $this->repository->find($id);
        } catch (Exception $e) {
            throw new CustomException('User not found', 404);
        }
    }

    /**
     * Dynamic filter
     *
     * @param  request $request
     *
     * @return array
     */
    public function search($request)
    {
        $this->repository->pushCriteria(new RequestCriteria($request));
        $users = $this->repository->all();
        if ($users->isEmpty()) {
            throw new CustomException('User not found', 404);
        }
        return $users;
    }
}
