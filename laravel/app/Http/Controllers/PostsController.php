<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Post;
use Illuminate\Validation\ValidationException;

class PostsController extends Controller
{

    public function __construct()
    {
		return $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(10);
        $post = Post::all();

        return view('posts.index', compact('post', 'posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
           'title' => '',
           'message' => '',
           'image' => '',
           'user_id' => '',
        ]);

        $post = new Post;
        $post->title = $request->input('title');
        $post->message = $request->input('message');
        if(!empty($request->input('image'))) {
            $post->image = $request->input('image');
        } else {
            $post->image = 'https://nationalvisionnews.com/uploads/news-default.png	';
        }
        $post->user_id = auth()->user()->id;

        $post->save();

        return redirect('posts')->with('success', 'Bericht is aangemaakt');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $post = Post::find($id);

        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws ValidationException
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => '',
            'message' => '',
            'image' => '',
            'user_id' => '',
        ]);

        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->message = $request->input('message');
        $post->image = $request->input('image');
        $post->user_id = auth()->user()->id;

        $post->save();

        return redirect('posts/'.$post->id)->with('success', 'Bericht is bewerkt');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();

        return redirect('/')->with('success', 'Bericht is verwijderd');
    }

    public function test()
    {
        $test = 'test';

        return view('components.test-component', compact('test'));
    }
}
