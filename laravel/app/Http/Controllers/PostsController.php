<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Post;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{

    public function __construct()
    {
        return $this->middleware('role:admin');
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
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        if($request->user()->can('news-create')) {
            return view('posts.create');
        }
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
        if($request->user()->can('news-create')) {
            $this->validate($request, [
                'title' => '',
                'message' => '',
                'image' => '',
                'user_id' => '',
            ]);

            $post = new Post;
            $post->title = $request->input('title');
            $post->message = $request->input('message');

            if ($request->file('file')) {
                $imagePath = $request->file('file');
                $imageName = $imagePath->getClientOriginalName();

                $request->file('file')->move(public_path('/images/news/'), $imageName);

                $post->image = $imageName;
            } else {
                $post->image = 'news-default.png';
            }

            $post->user_id = auth()->user()->id;

            $post->save();

            return redirect('/posts')->with('success', 'Bericht is aangemaakt');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
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
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Request $request, $id)
    {
        if($request->user()->can('news-edit')) {
            $post = Post::find($id);

            return view('posts.edit', compact('post'));
        }
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
        if($request->user()->can('news-edit')) {
            $this->validate($request, [
                'title' => '',
                'message' => '',
                'image' => '',
                'user_id' => '',
            ]);

            $post = Post::find($id);
            $post->title = $request->input('title');
            $post->message = $request->input('message');

            if ($request->file('file')) {
                $imagePath = $request->file('file');
                $imageName = $imagePath->getClientOriginalName();

                $request->file('file')->move(public_path('/images/news/'), $imageName);

                $post->image = $imageName;
            } else {
                $post->image = 'news-default.png';
            }

            $post->user_id = auth()->user()->id;

            $post->save();

            return redirect('/posts/' . $post->id)->with('success', 'Nieuws bericht is bijgewerkt');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Request $request, $id)
    {
        if($request->user()->can('news-destroy')) {
            $post = Post::find($id);
            $post->delete();

            return redirect('/')->with('success', 'Bericht is verwijderd');
        }
    }
}
