<?php

namespace LaravelForum\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use LaravelForum\Discussion;
use LaravelForum\Http\Requests\CreateDiscussionRequest;
use LaravelForum\Reply;
use LaravelForum\User;

class DiscussionsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified'])->only(['create','store']);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    //$discussions = Discussion::orderBy('id','desc')->get();
       // return view('discussions.index')->with('discussions',Discussion::paginate(3))->with('discussions',$discussions);

        return view('discussions.index',[
        'discussions' => Discussion::filterByChannels()->paginate(3)
    ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('discussions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateDiscussionRequest $request)
    {

             auth()->user()->discussions()->create([
            'title' => $request->title,
            'slug' =>str_slug($request->title),
            'content' => $request->content,
            //'user_id' => auth()->user()->id,
            'channel_id' =>$request->channel_id



        ]);

        return redirect('discussions')->with('success', 'Discussion Posted');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Discussion $discussion)
    {
        return view('discussions.show',[
            'discussion' => $discussion
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function  reply(Discussion $discussion, Reply $reply)
    {
      $discussion->markAsBestReply($reply);
      //$discussion->newQuery()->update([
         // 'reply_id'=> $reply->id
    //]);


        session()->flash('success','Mark as Best Reply');
        return redirect()->back();


    }

}
