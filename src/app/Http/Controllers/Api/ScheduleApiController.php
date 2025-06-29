<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Http\Requests\ScheduleRequest;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ScheduleApiController extends Controller
{
    public function byMonth(Request $request)
    {
        $userId = Auth::id();
        $year = $request->input('year');
        $month = $request->input('month');

        $start = Carbon::create($year, $month, 1)->startOfMonth();
        $end = $start->copy()->endOfMonth();

        return Schedule::where('user_id', $userId)
            ->whereBetween('start_date', [$start, $end])
            ->select(['id', 'title', 'description', 'start_date', 'end_date'])
            ->get();
    }
}