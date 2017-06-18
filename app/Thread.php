<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    protected $guarded = [];

    public function addReply($reply)
    {
        $this->replies()->create($reply);
    }

    public function path()
    {
        return '/threads/' . $this->channel->slug  . '/' . $this->id;
    }

    public function replies()
    {
        return $this->hasMany(\App\Reply::class);
    }

    public function creator()
    {
        return $this->belongsTo(\App\User::class, 'user_id');
    }

    public function channel()
    {
        return $this->belongsTo(\App\Channel::class, 'channel_id');
    }
}
