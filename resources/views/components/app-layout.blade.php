<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'HR System' }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{ $head ?? '' }}
</head>
<body class="min-h-screen bg-slate-100">
    <div class="flex h-screen bg-slate-100">
        <!-- Sidebar -->
        <aside class="sidebar group fixed left-0 top-0 h-screen w-20 overflow-y-auto bg-slate-950 transition-all duration-300 hover:w-64 z-50">
            <!-- Navigation -->
            <nav class="space-y-2 px-3 py-6">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-4 rounded-lg px-3 py-3 text-slate-200 transition hover:bg-slate-800 {{ request()->routeIs('dashboard') ? 'bg-slate-800' : '' }}">
                    <span class="inline-flex h-6 w-6 flex-shrink-0 items-center justify-center">
                        <i class="fas fa-home text-lg"></i>
                    </span>
                    <span class="hidden whitespace-nowrap font-medium group-hover:inline">Dashboard</span>
                </a>

                <a href="{{ route('employees.index') }}" class="flex items-center gap-4 rounded-lg px-3 py-3 text-slate-200 transition hover:bg-slate-800 {{ request()->routeIs('employees.*') ? 'bg-slate-800' : '' }}">
                    <span class="inline-flex h-6 w-6 flex-shrink-0 items-center justify-center">
                        <i class="fas fa-user text-lg"></i>
                    </span>
                    <span class="hidden whitespace-nowrap font-medium group-hover:inline">Employees</span>
                </a>

                <a href="{{ route('payroll.index') }}" class="flex items-center gap-4 rounded-lg px-3 py-3 text-slate-200 transition hover:bg-slate-800 {{ request()->routeIs('payroll.*') ? 'bg-slate-800' : '' }}">
                    <span class="inline-flex h-6 w-6 flex-shrink-0 items-center justify-center">
                        <i class="fas fa-money-bill text-lg"></i>
                    </span>
                    <span class="hidden whitespace-nowrap font-medium group-hover:inline">Payroll</span>
                </a>

                <details class="rounded-lg {{ request()->routeIs('organization.departments.*', 'organization.positions.*') ? 'bg-slate-900/60' : '' }}" {{ request()->routeIs('organization.departments.*', 'organization.positions.*') ? 'open' : '' }}>
                    <summary class="flex cursor-pointer list-none items-center gap-4 rounded-lg px-3 py-3 text-slate-200 transition hover:bg-slate-800">
                        <span class="inline-flex h-6 w-6 flex-shrink-0 items-center justify-center">
                            <i class="fas fa-building text-lg"></i>
                        </span>
                        <span class="hidden flex-1 whitespace-nowrap font-medium group-hover:inline">Organization</span>
                        <span class="hidden text-xs text-slate-400 group-hover:inline">▼</span>
                    </summary>

                    <div class="mx-3 mb-2 hidden space-y-1 rounded-md border border-slate-800 bg-slate-900/70 p-2 group-hover:block">
                        <a href="{{ route('organization.departments.index') }}" class="flex items-center gap-3 rounded-md px-3 py-2 text-sm text-slate-200 transition hover:bg-slate-800 {{ request()->routeIs('organization.departments.*') ? 'bg-slate-800' : '' }}">
                            <i class="fas fa-chart-bar text-xs"></i>
                            <span>Departments</span>
                        </a>

                        <a href="{{ route('organization.positions.index') }}" class="flex items-center gap-3 rounded-md px-3 py-2 text-sm text-slate-200 transition hover:bg-slate-800 {{ request()->routeIs('organization.positions.*') ? 'bg-slate-800' : '' }}">
                            <i class="fas fa-cog text-xs"></i>
                            <span>Positions</span>
                        </a>
                    </div>
                </details>
            </nav>

            <!-- User Menu -->
            <div class="absolute bottom-0 left-0 right-0 border-t border-slate-800 px-3 py-4">
                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <button type="submit" class="flex w-full items-center gap-4 rounded-lg px-3 py-3 text-slate-200 transition hover:bg-slate-800">
                        <svg class="h-6 w-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                        <span class="hidden whitespace-nowrap font-medium group-hover:inline">Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="ml-20 flex-1 transition-all duration-300 group-hover:ml-64 overflow-y-auto">
            <!-- Top Bar -->
            <div class="border-b border-slate-200 bg-white px-8 py-6 shadow-sm sticky top-0 z-10">
                <div class="flex items-center justify-between">
                    <h1 class="text-3xl font-bold text-slate-900">{{ $header ?? '' }}</h1>
                    <div class="flex items-center gap-4">
                        <div class="text-right">
                            <p class="text-sm font-medium text-slate-900">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-slate-500 lowercase">{{ auth()->user()->email }}</p>
                        </div>
                        <div class="h-10 w-10 rounded-full bg-linear-to-br from-blue-500 to-purple-600"></div>
                    </div>
                </div>
            </div>

            <!-- Page Content -->
            <div class="p-8">
                {{ $slot }}
            </div>
        </main>
    </div>
    {{ $scripts ?? '' }}
</body>
</html>
