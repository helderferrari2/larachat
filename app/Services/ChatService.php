<?php

namespace App\Services;

use App\Exceptions\CustomException;
use App\Repositories\ChatRepository;
use App\Traits\UserTrait;
use Exception;

class ChatService extends BaseService
{
    use UserTrait;

    protected $repository;
    public function __construct(ChatRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param array $data
     *
     * @return array
     */
    public function store(array $data)
    {
        try {
            $data['sender_user_id'] = $this->getUserAuth()->id;
            $chat = $this->repository->create($data);
            $chat->owner = true;
            return $chat;
        } catch (Exception $e) {
            throw new CustomException('Unable complete the operation.', 400);
        }
    }

    public function search(array $data)
    {
        $user = $this->getUserAuth();
        $filter = array($user->id, $data['receiver_user_id']);
        $chat = $this->repository->search($filter);
        if ($chat->isEmpty()) {
            throw new CustomException('Chat not found', 404);
        }
        return $chat;
    }
}
