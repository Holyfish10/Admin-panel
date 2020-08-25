<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Event;
use App\User;
use Illuminate\Support\Carbon;
use App\Post;
use App\Projects;
use App\Sites;
use App\Client;
use App\Todo;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function home()
    {

        $users = User::all();
        $post = Post::all();
        $posts = Post::orderBy('created_at', 'desc')->paginate(3);
        $events = Event::whereDate('start', Carbon::today())->get();
        $sites = Sites::all();
        $clients = Client::all();
        $todo = Todo::all();

        if(request()->ajax())
        {
            $start = (!empty($_GET["start"])) ? ($_GET["start"]) : ('');
            $end = (!empty($_GET["end"])) ? ($_GET["end"]) : ('');

            $data = Event::whereDate('start', '>=', $start)->whereDate('end',   '<=', $end)->where('user_id', '=',auth()->user()->id)->get(['id','title','start', 'end']);

            return response()->json($data);
        }

        return view('home', compact('users', 'events', 'post', 'posts', 'sites', 'clients', 'todo'));
    }

    public function projects()
    {
        $count = Projects::all();
        return view('projects.index', compact('count'));
    }

}
