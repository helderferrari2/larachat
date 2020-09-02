<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Chat.
 *
 * @package namespace App\Entities;
 */
class Chat extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['sender_user_id', 'receiver_user_id', 'message'];
    protected $appends = ['owner'];

    /**
     * Get owner from message
     */
    public function getOwnerAttribute()
    {
        return $this->sender_user_id === auth()->user()->id;
    }

    /**
     * Get the user that owns the message.
     */
    public function receiver()
    {
        return $this->belongsTo('App\Entities\User', 'sender_user_id', 'id');
    }
}
