<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\PostFormRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        if (\Auth::guest()){
            $posts = \App\Post::where('published_at', '<=', \Carbon\Carbon::now())
                ->where('active', '=', 1)
                ->orderBy('published_at', 'desc')
                ->paginate(config('site.post_per_page'));

            // Show the page
            return View('post.indexActive', compact('posts'));
        }else{
            $posts = \App\Post::orderBy('published_at', 'desc')
                ->paginate(config('site.post_per_page'));

            // Show the page
            return View('post.indexAll', compact('posts'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View('post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(PostFormRequest $request)
    {
        $post = new \App\Post();
        $post->title = $request->get('title');
        $post->body = $request->get('body');
        $post->excerpt = substr($request->get('body'), 0, 150);
        $post->slug = str_slug($post->title);
        $post->author_id = $request->user()->id;
        $post->published_at = \Carbon\Carbon::now();
        if($request->has('save'))
        {
            $post->active = 0;
            $message = 'Post saved successfully';
        }
        else
        {
            $post->active = 1;
            $message = 'Post published successfully';
        }

        try {
            $post->save();
        } catch (\Error $e) {
            return View('post.create')->withMessage('Cannot Save.');
        }
        return Redirect('/post/'.$post->id.'/edit/')->withMessage($message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($slug)
    {
        $post = \App\Post::whereSlug($slug)->firstOrFail();
        // Show the page
        return View('post.show')->withPost($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $post = \App\Post::whereId($id)->first();
        if($post)
            return view('post.edit')->withPost($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, PostFormRequest $request)
    {
        $post = \App\Post::find($id);

        if($post)
        {
            $title = $request->input('title');
            $slug = str_slug($title);
            $duplicate = \App\Post::whereSlug($slug)->first();
            if($duplicate)
            {
                if($duplicate->id != $id)
                {
                    return Redirect('/post/'.$post->id.'/edit/')->withMessage('Title already exists.')->withInput();
                }
                else
                {
                    $post->slug = $slug;
                }
            }
            $post->title = $title;
            $post->body = $request->input('body');
            
            if($request->has('draftsaving'))
            {
                $post->active = 0;
                $message = 'Post saved successfully';
                $landing = '/post/'.$post->id.'/edit/';
            }
            else {
                $post->active = 1;
                $message = 'Post updated successfully';
                $landing = '/post/'.$post->slug;
            }
            
            $post->save();
            return Redirect($landing)->withMessage($message);
        }
        else
        {
            return \Redirect::route('home')->withMessage('The post does not exist.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $post = \App\Post::whereId($id)->firstOrFail();
        $post->delete();

        return \Redirect::route('home')->withMessage('Post#'.$id.' Deleted.');
    }
}