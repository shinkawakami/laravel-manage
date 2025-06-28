<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Requests\TaskRequest;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    public function create($schedule_id)
    {
        return view('tasks.create', compact('schedule_id'));
    }

    public function store(TaskRequest $request)
    {
        try {
            DB::transaction(function () use ($request) {
                Task::create($request->validated());
            });
        } catch (\Exception $e) {
            return back()->withErrors(['error' => '保存に失敗しました。']);
        }
        return redirect()->route('schedules.show', $request['schedule_id']);
    }

    public function edit($schedule_id, Task $task)
    {
        if ($task->schedule_id == $schedule_id) {
            return view('tasks.edit', compact('task'));
        }
    }

    public function update(TaskRequest $request, $schedule_id, Task $task)
    {
        try {
            DB::transaction(function () use ($request, $task, $schedule_id) {
                if ($task->schedule_id == $schedule_id) {
                    $task->update($request->validated());
                }
            });
        } catch (\Exception $e) {
            return back()->withErrors(['error' => '更新に失敗しました。']);
        }
        return redirect()->route('schedules.show', $schedule_id);
    }

    public function destroy($schedule_id, Task $task)
    {
        try {
            DB::transaction(function () use ($task, $schedule_id) {
                if ($task->schedule_id == $schedule_id) {
                    $task->delete();
                }
            });
        } catch (\Exception $e) {
            return back()->withErrors(['error' => '削除に失敗しました。']);
        }
        return redirect()->route('schedules.show', $schedule_id);
    }
}