<?php

namespace LaravelForum;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Reply extends Model
{
    protected $fillable=['content','discussion_id'];

    public function owner()
    {
        return $this->belongsTo(User::class,'user_id');

    }
    public function discussion()
    {
       return $this->belongsTo(Discussion::class);
    }

}
