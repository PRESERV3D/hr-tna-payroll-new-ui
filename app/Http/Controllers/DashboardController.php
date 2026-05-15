<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Leave;
use App\Models\Payroll;
use App\Models\User;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Total Employees (from employees table)
        $totalEmployees = Employee::where('status', 1)->count();

        // New Hires: employees hired within the last 30 days
        $newHires = Employee::whereBetween('hire_date', [Carbon::now()->subDays(30)->startOfDay(), Carbon::now()->endOfDay()])
            ->count();

        // On Leave Today
        $today = Carbon::now()->toDateString();
        $onLeaveToday = Leave::where('status', 'approved')
            ->where('start_date', '<=', $today)
            ->where('end_date', '>=', $today)
            ->count();

        $leavesPendingApproval = Leave::where('status', 'pending')->count();

        // Current Payroll Status
        $currentMonth = Carbon::now();
        $totalPayroll = Payroll::whereMonth('payroll_date', $currentMonth->month)
            ->whereYear('payroll_date', $currentMonth->year)
            ->sum('net_salary');

        $payrollProcessing = Payroll::whereMonth('payroll_date', $currentMonth->month)
            ->whereYear('payroll_date', $currentMonth->year)
            ->where('status', 'processing')
            ->count();

        // Today's Attendance
        $todayAttendance = Attendance::with('user')
            ->where('attendance_date', $today)
            ->get();

        // Pending Leave Requests
        $pendingLeaves = Leave::with('user')
            ->where('status', 'pending')
            ->get();

        return view('dashboard', [
            'totalEmployees' => $totalEmployees,
            'newHires' => $newHires,
            'onLeaveToday' => $onLeaveToday,
            'leavesPendingApproval' => $leavesPendingApproval,
            'totalPayroll' => $totalPayroll,
            'payrollProcessing' => $payrollProcessing,
            'todayAttendance' => $todayAttendance,
            'pendingLeaves' => $pendingLeaves,
        ]);
    }
}
