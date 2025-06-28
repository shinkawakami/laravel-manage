<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Http\Requests\ScheduleRequest;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::where('user_id', Auth::id())->orderBy('start_time')->get();
        return view('schedules.index', compact('schedules'));
    }

    public function create()
    {
        return view('schedules.create');
    }

    public function store(ScheduleRequest $request)
    {
        Schedule::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);

        return redirect()->route('schedules.index');
    }

    public function edit(Schedule $schedule)
    {
        $this->authorize('update', $schedule);
        return view('schedules.edit', compact('schedule'));
    }

    public function update(ScheduleRequest $request, Schedule $schedule)
    {
        $schedule->update($request->only('title', 'description', 'start_time', 'end_time'));

        // APIリクエストならJSONを返す
        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'schedule' => $schedule,
            ]);
        }
        // 通常Webフォームからのリクエストならリダイレクト
        return redirect()->route('schedules.index');
    }

    public function destroy(Schedule $schedule)
    {
        $this->authorize('delete', $schedule);
        $schedule->delete();

        return redirect()->route('schedules.index');
    }

    public function show(Schedule $schedule)
    {
        $schedule->load('tasks');
        return view('schedules.show', compact('schedule'));
    }
}