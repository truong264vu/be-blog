<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\User;
class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     //
    //     $comment = Comment::whereNull('parent_id')->with('childComment')->latest()->get();
    //     return response()->json($comment);
    // }

    public function getComment(Request $request){ // lay ra tung comment cua tung bai viet
        // $comment = Comment::query()->with(['users' => function($users) {
            //     $users;
            // }])->get();
            // $comment = Comment::where('post_id', 1)->whereNull('parent_id')->with('childComment')->latest()->get();
            // $childComment = Comment::where('parent_id')->with(['user' => function($users) {
            //     $users->get();
            // }])->get();

            $comment = Comment::where('post_id', $request->post_id)
            ->whereNull('parent_id')
            ->with(['childComment' =>  function($users) {
                $users->with(['user' => function($user) {
                    $user->get();
                }])->get();;
            }])
            
            ->with(['user' => function($users) {
                $users;
            }])->latest()->get();
            // $load = Comment::all()->load('content');

        return response()->json($comment);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $comment = new Comment;
        $comment->fill( $request->all() );
        $comment->save();
        return response()->json($comment);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $comment = Comment::find($id);
        $comment->delete();
        return response()->json($comment);
    }
    public function destroyChildComment(Request $request){
        $comment = Comment::getCommentChild($request->parent_id);
        $comment->delete();
        return response()->json($comment);
    }
}
