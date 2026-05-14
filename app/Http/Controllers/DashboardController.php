<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Leave;
use App\Models\Payroll;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Total Employees
        $totalEmployees = User::where('status', 'active')->count();
        $newEmployeesThisMonth = User::where('status', 'active')
            ->whereMonth('hire_date', Carbon::now()->month)
            ->whereYear('hire_date', Carbon::now()->year)
            ->count();

        // New Hires (Onboarding)
        $newHires = User::where('status', 'onboarding')->count();

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
            'newEmployeesThisMonth' => $newEmployeesThisMonth,
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
