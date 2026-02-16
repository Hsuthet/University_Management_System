<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Department;
use App\Models\Notice;
use App\Models\Assignment;
use App\Models\AcademicYear;
use App\Models\Timetable;
use App\Models\Blog;

class DashboardController extends Controller
{
 
public function index()
{
    // Role counts
    $admins = User::where('role', '1')->count();
    $teachers = User::where('role', '2')->count();
    $students = User::where('role', '3')->count();
    $totalUsers = User::count();

    // Role distribution chart
    $roleLabels = ['Admin', 'Teacher', 'Student'];
    $roleData = [$admins, $teachers, $students];

    // User growth (past 6 months)
    $months = collect(range(0, 5))->map(function ($i) {
        return Carbon::now()->subMonths($i)->format('M Y');
    })->reverse()->values()->toArray();

    $growthData = collect(range(0, 5))->map(function ($i) {
        $month = Carbon::now()->subMonths($i);
        return User::whereMonth('created_at', $month->month)
                    ->whereYear('created_at', $month->year)
                    ->count();
    })->reverse()->values()->toArray();

   // Additional dashboard stats
        $departments = Department::count();
        $assignments = Assignment::count();
        $notices = Notice::count();
        $blogs = Blog::count();

        // Recent notices
        $latestNotices = Notice::latest()->take(5)->get();

        // Today’s timetable
        $today = Carbon::now()->format('l');
        $timetable = Timetable::where('day', $today)->get();

        return view('dashboard.dashboard', compact(
            'admins',
            'teachers',
            'students',
            'totalUsers',
            'roleLabels',
            'roleData',
            'months',
            'growthData',
            'departments',
            'assignments',
            'notices',
            'blogs',
            'latestNotices',
            'timetable'
        ));
    }
}