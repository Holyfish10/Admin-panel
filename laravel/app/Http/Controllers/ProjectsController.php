<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Projects;
use Illuminate\Validation\ValidationException;

class ProjectsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return Projects::mine()->with('timers')->get()->toArray();
    }

    public function store(Request $request)
    {
        // returns validated data as array
        $data = $request->validate(['name' => 'required|between:2,20']);

        // merge with the current user ID
        $data = array_merge($data, ['user_id' => auth()->user()->id]);

        $project = Projects::create($data);

        return $project ? array_merge($project->toArray(), ['timers' => []]) : false;
    }
}
