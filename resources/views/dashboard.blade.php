<x-app-layout>
    <x-slot:title>Dashboard</x-slot:title>
    <x-slot:header>Dashboard</x-slot:header>

    <div>
        <h1 class="text-2xl font-semibold">Dashboard</h1>
        <p class="text-sm text-slate-500">Overview of your workforce today.</p>
    </div>

    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
        <div class="card p-5">
            <p class="text-sm text-slate-500">Total employees</p>
            <p class="mt-1 text-2xl font-semibold">{{ $totalEmployees }}</p>
            <p class="mt-1 text-xs text-slate-400">+{{ $newEmployeesThisMonth }} this month</p>
        </div>

        <div class="card p-5">
            <p class="text-sm text-slate-500">New hires</p>
            <p class="mt-1 text-2xl font-semibold">{{ $newHires }}</p>
            <p class="mt-1 text-xs text-slate-400">Onboarding now</p>
        </div>

        <div class="card p-5">
            <p class="text-sm text-slate-500">On leave today</p>
            <p class="mt-1 text-2xl font-semibold">{{ $onLeaveToday }}</p>
            <p class="mt-1 text-xs text-slate-400">{{ $leavesPendingApproval }} pending approval</p>
        </div>

        <div class="card p-5">
            <p class="text-sm text-slate-500">Payroll (current)</p>
            <p class="mt-1 text-2xl font-semibold">₱{{ number_format($totalPayroll, 0) }}</p>
            <p class="mt-1 text-xs text-slate-400">{{ $payrollProcessing }} processing</p>
        </div>
    </div>

    <div class="grid gap-4 lg:grid-cols-2">
        <div class="card overflow-hidden">
            <div class="flex items-center justify-between border-b border-slate-200 px-6 py-4">
                <h2 class="font-medium">Attendance overview</h2>
                <span class="text-xs text-slate-400">Today</span>
            </div>
            <div class="divide-y divide-slate-100">
                @forelse($todayAttendance as $attendance)
                    <div class="flex items-center justify-between px-6 py-4">
                        <div>
                            <p class="font-medium">{{ $attendance->user->name }}</p>
                            <p class="text-sm text-slate-500">In: {{ $attendance->check_in ? $attendance->check_in->format('H:i') : '—' }} • Out: {{ $attendance->check_out ? $attendance->check_out->format('H:i') : '—' }}</p>
                        </div>
                        <span class="badge badge-blue">{{ match($attendance->status) { 1 => 'Present', 2 => 'Late', 3 => 'Absent', default => 'Excused' } }}</span>
                    </div>
                @empty
                    <div class="px-6 py-8 text-center text-sm text-slate-500">No attendance records yet.</div>
                @endforelse
            </div>
        </div>

        <div class="card overflow-hidden">
            <div class="border-b border-slate-200 px-6 py-4">
                <h2 class="font-medium">Pending leave requests</h2>
            </div>
            <div class="divide-y divide-slate-100">
                @forelse($pendingLeaves as $leave)
                    <div class="px-6 py-4">
                        <div class="mb-3 flex items-start justify-between gap-3">
                            <div>
                                <p class="font-medium">{{ $leave->user->name }}</p>
                                <p class="text-sm text-slate-500">{{ ucfirst($leave->type) }} • {{ $leave->start_date->format('M d') }} – {{ $leave->end_date->format('M d') }}</p>
                            </div>
                            <span class="badge badge-amber">Pending</span>
                        </div>
                        <div class="flex gap-2">
                            <button type="button" class="btn-primary text-xs py-1.5">Approve</button>
                            <button type="button" class="btn-outline text-xs py-1.5">Decline</button>
                        </div>
                    </div>
                @empty
                    <div class="px-6 py-8 text-center text-sm text-slate-500">No pending leave requests.</div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
