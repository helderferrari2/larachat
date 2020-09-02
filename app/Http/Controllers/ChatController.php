<?php

namespace App\Http\Controllers;

use App\Services\ChatService;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class ChatController
{
    use ResponseTrait;
    private $service;

    public function __construct(ChatService $service)
    {
        $this->service = $service;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $chat = $this->service->store($request->all());
        return $this->successResponse($chat, 200);
    }

    /**
     * Generic method to get dynamic data filtered
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $chat = $this->service->search($request->all());
        return $this->successResponse($chat, 200);
    }
}
