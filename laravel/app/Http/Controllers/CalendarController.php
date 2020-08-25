<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Event;

class CalendarController extends Controller
{
    public function create(Request $request)
    {
        $insertArr = [ 'title' => $request->title,
            'start' => $request->start,
            'end' => $request->end,
            'user_id' => auth()->user()->id,
        ];
        $event = Event::insert($insertArr);

        return response()->json($event);
    }

    public function update(Request $request)
    {
        $where = array('id' => $request->id);
        $updateArr = ['title' => $request->title,'start' => $request->start, 'end' => $request->end];
        $event  = Event::where($where)->update($updateArr);

        return response()->json($event);
    }

    public function destroy(Request $request)
    {
        $event = Event::where('id',$request->id)->delete();

        return response()->json($event);
    }
}
