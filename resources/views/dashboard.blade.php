<x-app-layout>
    <x-slot:title>Dashboard</x-slot:title>
    <x-slot:header>Dashboard</x-slot:header>

    <!-- Welcome Message -->
    <div class="nw-panel mb-8 rounded-2xl bg-linear-to-r from-sky-50 to-cyan-50 p-6">
        <h2 class="text-xl font-bold text-slate-900">Good morning, {{ strtok(auth()->user()->name, ' ') ?: auth()->user()->name }}</h2>
        <p class="mt-2 text-sm text-slate-600">Here is your command center for people, attendance, leave, and payroll. Use quick insights below to spot what needs attention now.</p>
    </div>

    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-4">
        <!-- Total Employees Card -->
        <div class="nw-panel rounded-2xl p-6 transition hover:-translate-y-0.5 hover:shadow-xl">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-500">Total Employees</p>
                    <p class="mt-2 text-3xl font-extrabold text-slate-900">{{ $totalEmployees }}</p>
                    <p class="mt-2 text-sm font-semibold text-emerald-600">+{{ $newEmployeesThisMonth }} this month</p>
                </div>
                <div class="rounded-xl bg-sky-100 p-3">
                    <i class="fas fa-users text-xl text-sky-700"></i>
                </div>
            </div>
        </div>

        <!-- New Hires Card -->
        <div class="nw-panel rounded-2xl p-6 transition hover:-translate-y-0.5 hover:shadow-xl">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-500">New Hires</p>
                    <p class="mt-2 text-3xl font-extrabold text-slate-900">{{ $newHires }}</p>
                    <p class="mt-2 text-sm font-semibold text-amber-600">Onboarding now</p>
                </div>
                <div class="rounded-xl bg-amber-100 p-3">
                    <i class="fas fa-user-plus text-xl text-amber-700"></i>
                </div>
            </div>
        </div>

        <!-- On Leave Today Card -->
        <div class="nw-panel rounded-2xl p-6 transition hover:-translate-y-0.5 hover:shadow-xl">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-500">On Leave Today</p>
                    <p class="mt-2 text-3xl font-extrabold text-slate-900">{{ $onLeaveToday }}</p>
                    <p class="mt-2 text-sm font-semibold text-emerald-600">{{ $leavesPendingApproval }} approved</p>
                </div>
                <div class="rounded-xl bg-rose-100 p-3">
                    <i class="fas fa-calendar text-xl text-rose-700"></i>
                </div>
            </div>
        </div>

        <!-- Payroll (current) Card -->
        <div class="nw-panel rounded-2xl p-6 transition hover:-translate-y-0.5 hover:shadow-xl">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-500">Payroll (current)</p>
                    <p class="mt-2 text-3xl font-extrabold text-slate-900">₱{{ number_format($totalPayroll, 0) }}</p>
                    <p class="mt-2 text-sm font-semibold text-sky-700">{{ $payrollProcessing }} Processing</p>
                </div>
                <div class="rounded-xl bg-cyan-100 p-3">
                    <i class="fas fa-wallet text-xl text-cyan-700"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Attendance and Leave Section -->
    <div class="mt-8 grid gap-6 lg:grid-cols-2">
        <!-- Today's Attendance -->
        <div class="nw-panel rounded-2xl">
            <div class="flex items-center justify-between border-b border-slate-200 px-6 py-4">
                <h3 class="text-lg font-bold text-slate-900">Today's Attendance</h3>
                <a href="#" class="flex items-center gap-1 text-sm font-semibold text-sky-700 hover:text-sky-800">View all <i class="fas fa-arrow-right h-4 w-4"></i></a>
            </div>
            <div class="divide-y divide-slate-200">
                @php
                    $attendanceStatus = [1 => 'Present', 2 => 'Late', 3 => 'Absent', 4 => 'Excused'];
                @endphp
                @forelse($todayAttendance as $attendance)
                    <div class="flex items-center justify-between px-6 py-4 transition hover:bg-slate-50/90">
                        <div>
                            <p class="font-semibold text-slate-900">{{ $attendance->user->name }}</p>
                            <p class="text-sm text-slate-500">
                                In: {{ $attendance->check_in ? $attendance->check_in->format('H:i') : '—' }} • Out: {{ $attendance->check_out ? $attendance->check_out->format('H:i') : '—' }}
                            </p>
                        </div>
                        @php $s = $attendance->status; @endphp
                        <span class="inline-flex items-center rounded-full px-3 py-1 text-sm font-medium
                            @if($s == 1) bg-green-100 text-green-800
                            @elseif($s == 2) bg-orange-100 text-orange-800
                            @elseif($s == 3) bg-red-100 text-red-800
                            @else bg-slate-100 text-slate-800
                            @endif">
                            {{ $attendanceStatus[$s] ?? 'Unknown' }}
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
        <div class="nw-panel rounded-2xl">
            <div class="border-b border-slate-200 px-6 py-4">
                <h3 class="text-lg font-bold text-slate-900">Pending Leave</h3>
            </div>
            <div class="divide-y divide-slate-200">
                @forelse($pendingLeaves as $leave)
                    <div class="px-6 py-4 transition hover:bg-slate-50/90">
                        <div class="mb-3 flex items-start justify-between">
                            <div>
                                <p class="font-semibold text-slate-900">{{ $leave->user->name }}</p>
                                <p class="text-sm text-slate-500">{{ ucfirst($leave->type) }} • {{ $leave->start_date->format('M d') }} – {{ $leave->end_date->format('M d') }} ({{ $leave->start_date->diffInDays($leave->end_date) + 1 }}d)</p>
                            </div>
                            <span class="inline-flex items-center rounded-full bg-yellow-100 px-2.5 py-0.5 text-sm font-medium text-yellow-800">
                                Pending
                            </span>
                        </div>
                        <div class="flex gap-2">
                            <form method="POST" action="#" class="inline">
                                @csrf
                                <button type="submit" class="inline-flex items-center rounded-lg bg-sky-600 px-3 py-1.5 text-sm font-medium text-white transition hover:bg-sky-700">
                                    Approve
                                </button>
                            </form>
                            <form method="POST" action="#" class="inline">
                                @csrf
                                <button type="submit" class="inline-flex items-center rounded-lg bg-slate-200 px-3 py-1.5 text-sm font-medium text-slate-700 transition hover:bg-slate-300">
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
</x-app-layout>
