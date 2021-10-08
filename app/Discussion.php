<?php

namespace LaravelForum;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use LaravelForum\Notifications\ReplyMarkedAsBestReply;
use LaravelForum\Reply;

class Discussion extends Model
{
    protected $fillable = ['title','user_id','slug','content','channel_id'];


    public function author()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function bestReply()
    {
        return $this->belongsTo(Reply::class,'reply_id');
    }

    public function scopeFilterByChannels($builder)
    {
        if(request()->query('channel'))
        {
            $channel=Channel::where('slug',request()->query('channel'))->first();

            if($channel)
            {
                return $builder->where('channel_id',$channel->id);
            }
            return $builder;
        }

        return $builder;

    }


    public function markAsBestReply(Reply $reply)
    {
           $this->newQuery()->update([
                'reply_id'=> $reply->id
            ]);
            if($reply->owner->id ==$this->author->id)
            {
                return;

            }

            $reply->owner->notify(new ReplyMarkedAsBestReply($reply->discussion));



    }

}
