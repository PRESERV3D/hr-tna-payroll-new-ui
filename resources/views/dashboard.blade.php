<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-100">
    <div class="flex h-screen bg-slate-100">
        <!-- Sidebar -->
        <aside class="sidebar group fixed left-0 top-0 h-screen w-20 overflow-y-auto bg-slate-950 transition-all duration-300 hover:w-64">
            <!-- Navigation -->
            <nav class="space-y-2 px-3 py-6">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-4 rounded-lg px-3 py-3 text-slate-200 transition hover:bg-slate-800">
                    <span class="inline-flex items-center justify-center h-6 w-6 flex-shrink-0">
                        <i class="fas fa-home text-lg"></i>
                    </span>
                    <span class="hidden whitespace-nowrap font-medium group-hover:inline">Dashboard</span>
                </a>

                <a href="#" class="flex items-center gap-4 rounded-lg px-3 py-3 text-slate-200 transition hover:bg-slate-800">
                    <span class="inline-flex items-center justify-center h-6 w-6 flex-shrink-0">
                        <i class="fas fa-user text-lg"></i>
                    </span>
                    <span class="hidden whitespace-nowrap font-medium group-hover:inline">Employees</span>
                </a>

                <a href="#" class="flex items-center gap-4 rounded-lg px-3 py-3 text-slate-200 transition hover:bg-slate-800">
                    <span class="inline-flex items-center justify-center h-6 w-6 flex-shrink-0">
                        <i class="fas fa-money-bill text-lg"></i>
                    </span>
                    <span class="hidden whitespace-nowrap font-medium group-hover:inline">Payroll</span>
                </a>

                <a href="#" class="flex items-center gap-4 rounded-lg px-3 py-3 text-slate-200 transition hover:bg-slate-800">
                    <span class="inline-flex items-center justify-center h-6 w-6 flex-shrink-0">
                        <i class="fas fa-chart-bar text-lg"></i>
                    </span>
                    <span class="hidden whitespace-nowrap font-medium group-hover:inline">Reports</span>
                </a>

                <a href="#" class="flex items-center gap-4 rounded-lg px-3 py-3 text-slate-200 transition hover:bg-slate-800">
                    <span class="inline-flex items-center justify-center h-6 w-6 flex-shrink-0">
                        <i class="fas fa-cog text-lg"></i>
                    </span>
                    <span class="hidden whitespace-nowrap font-medium group-hover:inline">Settings</span>
                </a>
            </nav>

            <!-- Divider -->
            <div class="border-t border-slate-800"></div>

            <!-- User Menu -->
            <div class="absolute bottom-0 left-0 right-0 border-t border-slate-800 px-3 py-4">
                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <button type="submit" class="flex w-full items-center gap-4 rounded-lg px-3 py-3 text-slate-200 transition hover:bg-slate-800">
                        <span class="inline-flex items-center justify-center h-6 w-6 flex-shrink-0">
                            <i class="fas fa-sign-out-alt text-lg"></i>
                        </span>
                        <span class="hidden whitespace-nowrap font-medium group-hover:inline">Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="ml-20 flex-1 transition-all duration-300 group-hover:ml-64">
            <!-- Top Bar -->
            <div class="border-b border-slate-200 bg-white px-8 py-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <h1 class="text-3xl font-bold text-slate-900">Dashboard</h1>
                    <div class="flex items-center gap-4">
                        <div class="text-right">
                            <p class="text-sm font-medium text-slate-900">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-slate-500">{{ auth()->user()->email }}</p>
                        </div>
                        <div class="h-10 w-10 rounded-full bg-gradient-to-br from-blue-500 to-purple-600"></div>
                    </div>
                </div>
            </div>

            <!-- Page Content -->
            <div class="p-8">
                <!-- Welcome Message -->
                <div class="mb-8 rounded-lg border border-slate-200 bg-gradient-to-r from-blue-50 to-purple-50 p-6">
                    <h2 class="text-lg font-semibold text-slate-900">Welcome to HR TNA Payroll</h2>
                    <p class="mt-2 text-slate-600">You're now signed in. Use the sidebar to navigate through the payroll management system. Click on any menu item to explore more features.</p>
                </div>

                <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-4">
                    <!-- Total Employees Card -->
                    <div class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm hover:shadow-md transition">
                        <div class="flex items-start justify-between">
                            <div>
                                <p class="text-sm font-medium text-slate-600">Total Employees</p>
                                <p class="mt-2 text-3xl font-bold text-slate-900">{{ $totalEmployees }}</p>
                                <p class="mt-2 text-sm text-green-600 font-medium">+{{ $newEmployeesThisMonth }} this month</p>
                            </div>
                            <div class="rounded-lg bg-blue-100 p-3">
                                <i class="fas fa-users text-xl text-blue-600"></i>
                            </div>
                        </div>
                    </div>

                    <!-- New Hires Card -->
                    <div class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm hover:shadow-md transition">
                        <div class="flex items-start justify-between">
                            <div>
                                <p class="text-sm font-medium text-slate-600">New Hires</p>
                                <p class="mt-2 text-3xl font-bold text-slate-900">{{ $newHires }}</p>
                                <p class="mt-2 text-sm text-orange-600 font-medium">Onboarding now</p>
                            </div>
                            <div class="rounded-lg bg-orange-100 p-3">
                                <i class="fas fa-user-plus text-xl text-orange-600"></i>
                            </div>
                        </div>
                    </div>

                    <!-- On Leave Today Card -->
                    <div class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm hover:shadow-md transition">
                        <div class="flex items-start justify-between">
                            <div>
                                <p class="text-sm font-medium text-slate-600">On Leave Today</p>
                                <p class="mt-2 text-3xl font-bold text-slate-900">{{ $onLeaveToday }}</p>
                                <p class="mt-2 text-sm text-green-600 font-medium">{{ $leavesPendingApproval }} approved</p>
                            </div>
                            <div class="rounded-lg bg-orange-100 p-3">
                                <i class="fas fa-calendar text-xl text-orange-600"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Payroll (current) Card -->
                    <div class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm hover:shadow-md transition">
                        <div class="flex items-start justify-between">
                            <div>
                                <p class="text-sm font-medium text-slate-600">Payroll (current)</p>
                                <p class="mt-2 text-3xl font-bold text-slate-900">₱{{ number_format($totalPayroll, 0) }}</p>
                                <p class="mt-2 text-sm text-blue-600 font-medium">{{ $payrollProcessing }} Processing</p>
                            </div>
                            <div class="rounded-lg bg-purple-100 p-3">
                                <i class="fas fa-wallet text-xl text-purple-600"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Attendance and Leave Section -->
                <div class="mt-8 grid gap-6 lg:grid-cols-2">
                    <!-- Today's Attendance -->
                    <div class="rounded-lg border border-slate-200 bg-white shadow-sm">
                        <div class="border-b border-slate-200 px-6 py-4 flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-slate-900">Today's Attendance</h3>
                            <a href="#" class="text-sm text-blue-600 hover:text-blue-700 flex items-center gap-1">View all <i class="fas fa-arrow-right h-4 w-4"></i></a>
                        </div>
                        <div class="divide-y divide-slate-200">
                            @forelse($todayAttendance as $attendance)
                                <div class="flex items-center justify-between px-6 py-4 hover:bg-slate-50 transition">
                                    <div>
                                        <p class="font-medium text-slate-900">{{ $attendance->user->name }}</p>
                                        <p class="text-sm text-slate-500">
                                            In: {{ $attendance->check_in ? $attendance->check_in->format('H:i') : '—' }} • Out: {{ $attendance->check_out ? $attendance->check_out->format('H:i') : '—' }}
                                        </p>
                                    </div>
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                        @if($attendance->status === 'present') bg-green-100 text-green-800
                                        @elseif($attendance->status === 'late') bg-orange-100 text-orange-800
                                        @elseif($attendance->status === 'absent') bg-red-100 text-red-800
                                        @else bg-slate-100 text-slate-800
                                        @endif">
                                        {{ ucfirst($attendance->status) }}
                                    </span>
                                </div>
                            @empty
                                <div class="px-6 py-8 text-center">
                                    <p class="text-slate-500">No attendance records yet</p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Pending Leave -->
                    <div class="rounded-lg border border-slate-200 bg-white shadow-sm">
                        <div class="border-b border-slate-200 px-6 py-4">
                            <h3 class="text-lg font-semibold text-slate-900">Pending Leave</h3>
                        </div>
                        <div class="divide-y divide-slate-200">
                            @forelse($pendingLeaves as $leave)
                                <div class="px-6 py-4 hover:bg-slate-50 transition">
                                    <div class="flex items-start justify-between mb-3">
                                        <div>
                                            <p class="font-medium text-slate-900">{{ $leave->user->name }}</p>
                                            <p class="text-sm text-slate-500">{{ ucfirst($leave->type) }} • {{ $leave->start_date->format('M d') }} – {{ $leave->end_date->format('M d') }} ({{ $leave->start_date->diffInDays($leave->end_date) + 1 }}d)</p>
                                        </div>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                                            Pending
                                        </span>
                                    </div>
                                    <div class="flex gap-2">
                                        <form method="POST" action="#" class="inline">
                                            @csrf
                                            <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-blue-600 text-white text-sm font-medium rounded hover:bg-blue-700 transition">
                                                Approve
                                            </button>
                                        </form>
                                        <form method="POST" action="#" class="inline">
                                            @csrf
                                            <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-slate-200 text-slate-700 text-sm font-medium rounded hover:bg-slate-300 transition">
                                                Decline
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @empty
                                <div class="px-6 py-8 text-center">
                                    <p class="text-slate-500">No pending leave requests</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</x-app-layout>
