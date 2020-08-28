<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Post;

class NewsComponent extends Component
{

    public $title;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title)
    {
        return $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(10);
        $post = Post::all();

        return view('components.news-component', compact('post', 'posts'));
    }
}
