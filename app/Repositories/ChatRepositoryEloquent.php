<?php

namespace App\Repositories;

use App\Entities\Chat;
use App\Repositories\ChatRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class ChatRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ChatRepositoryEloquent extends BaseRepository implements ChatRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Chat::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * Dynamic filter
     *
     * @params array $filter
     *
     * @return collection
     */
    public function search(array $filter)
    {
        return Chat::with('receiver')
            ->whereIn('sender_user_id', $filter)
            ->whereIn('receiver_user_id', $filter)
            ->get();
    }

}
