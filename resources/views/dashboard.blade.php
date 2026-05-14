<x-app-layout>
    <x-slot:title>Dashboard</x-slot:title>
    <x-slot:header>Dashboard</x-slot:header>

    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-4">
        <!-- Card 1 -->
        <div class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-600 uppercase">Total Employees</p>
                    <p class="mt-2 text-3xl font-bold text-slate-900">1,248</p>
                </div>
                <div class="rounded-lg bg-blue-100 p-3">
                    <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.856-1.487M15 10h.01M13 16h2v2h-2v-2zm2-6h2v2h-2v-2zm0-6h2v2h-2V4zm-8 6h2v2H7v-2zm0-6h2v2H7V4zm0 12h2v2H7v-2z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-600 uppercase">Pending Payroll</p>
                    <p class="mt-2 text-3xl font-bold text-slate-900">$2.4M</p>
                </div>
                <div class="rounded-lg bg-green-100 p-3">
                    <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-600 uppercase">Leave Requests</p>
                    <p class="mt-2 text-3xl font-bold text-slate-900">24</p>
                </div>
                <div class="rounded-lg bg-purple-100 p-3">
                    <svg class="h-6 w-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Card 4 -->
        <div class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-600 uppercase">Active Positions</p>
                    <p class="mt-2 text-3xl font-bold text-slate-900">12</p>
                </div>
                <div class="rounded-lg bg-orange-100 p-3">
                    <svg class="h-6 w-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Welcome Message -->
    <div class="mt-8 rounded-lg border border-slate-200 bg-gradient-to-r from-blue-50 to-purple-50 p-6">
        <h2 class="text-xl font-bold text-slate-900 uppercase">Welcome back, {{ auth()->user()->name }}!</h2>
        <p class="mt-1 text-slate-600">Here's what's happening in the system today.</p>
    </div>
</x-app-layout>
