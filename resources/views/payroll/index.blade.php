<x-app-layout>
    <x-slot:title>Payroll</x-slot:title>
    <x-slot:header>Payroll</x-slot:header>

    <div class="mb-6 flex items-center justify-between">
        <p class="text-sm text-slate-600">Payroll runs, payslips, and statutory contributions.</p>
        <button onclick="alert('Run Payroll feature coming soon')" class="bg-blue-600 text-white px-6 py-2.5 rounded-lg hover:bg-blue-700 transition flex items-center gap-2 font-medium">
            <i class="fas fa-play"></i>
            Run Payroll
        </button>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- YTD Gross Card -->
        <div class="bg-white rounded-lg border border-slate-200 p-6 shadow-sm hover:shadow-md transition">
            <h3 class="text-sm font-medium text-slate-600 mb-2">YTD Gross</h3>
            <p class="text-3xl font-bold text-slate-900">
                ₱{{ number_format($ytdGross, 0) }}
            </p>
        </div>

        <!-- YTD Net Card -->
        <div class="bg-white rounded-lg border border-slate-200 p-6 shadow-sm hover:shadow-md transition">
            <h3 class="text-sm font-medium text-slate-600 mb-2">YTD Net</h3>
            <p class="text-3xl font-bold text-slate-900">
                ₱{{ number_format($ytdNet, 0) }}
            </p>
        </div>

        <!-- Statutory Card -->
        <div class="bg-white rounded-lg border border-slate-200 p-6 shadow-sm hover:shadow-md transition">
            <h3 class="text-sm font-medium text-slate-600 mb-2">Statutory ({{ now()->format('M') }})</h3>
            <p class="text-3xl font-bold text-slate-900">
                ₱{{ number_format($statutoryAmount, 0) }}
            </p>
        </div>
    </div>

    <!-- Payroll Runs Table -->
    <div class="bg-white rounded-lg border border-slate-200 overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-slate-50 border-b border-slate-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-slate-700 uppercase tracking-wider">Pay Period</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-slate-700 uppercase tracking-wider">Employees</th>
                        <th class="px-6 py-3 text-right text-xs font-semibold text-slate-700 uppercase tracking-wider">Gross</th>
                        <th class="px-6 py-3 text-right text-xs font-semibold text-slate-700 uppercase tracking-wider">Net</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-slate-700 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-slate-700 uppercase tracking-wider">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    @forelse($payRuns as $payRun)
                        @php
                            $grossTotal = $payRun->payslips()->sum('gross_pay');
                            $netTotal = $payRun->payslips()->sum('net_pay');
                            $employeeCount = $payRun->payslips()->count();
                            $statusColor = match($payRun->status) {
                                'Paid', 'Completed' => 'bg-green-100 text-green-800',
                                'Processing' => 'bg-blue-100 text-blue-800',
                                'Draft' => 'bg-slate-100 text-slate-800',
                                'Cancelled' => 'bg-red-100 text-red-800',
                                default => 'bg-slate-100 text-slate-800'
                            };
                        @endphp
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-6 py-4 text-sm text-slate-900 font-medium">
                                {{ $payRun->period_start->format('M d') }} – {{ $payRun->period_end->format('M d, Y') }}
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-700">
                                {{ $employeeCount }}
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-700 text-right">
                                ₱{{ number_format($grossTotal, 0) }}
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-700 text-right">
                                ₱{{ number_format($netTotal, 0) }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium {{ $statusColor }}">
                                    {{ ucfirst($payRun->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm">
                                <a href="#" class="text-blue-600 hover:text-blue-800 font-medium transition">
                                    View
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-slate-500">
                                <div class="flex flex-col items-center gap-2">
                                    <i class="fas fa-inbox text-3xl opacity-50"></i>
                                    <p>No payroll runs yet. Click "Run Payroll" to create your first payroll run.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
