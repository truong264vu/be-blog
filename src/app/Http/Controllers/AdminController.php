<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Post;
use App\Category;
use App\User;


class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $post = Post::query()->with(['categories' => function($CategoryQuery){
            $CategoryQuery;
        }])->paginate(10);

        return response()->json($post);
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
    public function store(PostRequest $request)
    {
        //
        $post = new Post;
        $post->fill( $request->all() );
        $post->save();
        return response()->json($post);
    }
    public function CreateRelationshipPostCategory(Request $request){
        $postId = Post::query()->find($request->postID);
        $postId->categories()->attach($request->categoryId);
        $postId->save();
    }

    public function DeleteRelationshipPostCategory(Request $request){
        $postId = Post::query()->find($request->postID);
        $postId->categories()->detach($request->categoryId);
        $postId->save();
    }

    public function UpdatePost_Category(Request $request){ //update lai mqh post_category
        $postId = Post::query()->find($request->postID);
        $postId->categories()->detach($request->OldcategoryId);
        $postId->categories()->attach($request->categoryId); 

    }
    public function getAvatar(Request $request){ // lay ra avata user
        $avatar = User::where('id', $request->idUser)->get('avatar');
        return response()->json($avatar);
    }

    public function CreateRalationshipUserPostLike(Request $request){
            $user = User::query()->find($request->user_id);
            $user->likes()->attach($request->post_id);
            return response()->json($user);
    }


    public function DeleteRalationshipUserPostLike(Request $request){
        $user = User::query()->find($request->user_id);
        $user->likes()->detach($request->post_id);
        return response()->json($user);
    }



    public function likePost(Request $request) {
        $like = User::where('id',$request->user_id)
        ->with(['likes' => function($likeQuery){
            $likeQuery;
        }])->get();
        return response()->json($like);
    }       

    public function getTotalLike(Request $request) {
        $like = Post::where('id',$request->post_id)
        ->with(['likes' => function($likeQuery){
            $likeQuery;
        }])->get('id');
        return response()->json($like);
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
        $post = Post::find($id);
        return response()->json($post);
    }


    // chuc nang tim kiem bai viet
    public function findPost(Request $request)
    {
        // Search in the title and body columns from the posts table
        $post = Post::query()
            ->where('title', 'like',"%{$request->key_search}%")
            // ->orWhere('body', 'LIKE', "%{$search}%")
            ->get();
        return response()->json($post);
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
        $post = Post::find($id);
        return response()->json($post);

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
        $data = Post::find($id);
        $data->update($request->all());
        $data->save();

        return response()->json($data);
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
        $deletePost = Post::find($id);
        $deletePost->delete();
        return response()->json($deletePost);

    }
}
