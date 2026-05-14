<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'HR System' }}</title>
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
                    <svg class="h-6 w-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-3m0 0l7-4 7 4M5 9v10a1 1 0 001 1h12a1 1 0 001-1V9m-9 4h4"></path>
                    </svg>
                    <span class="hidden whitespace-nowrap font-medium group-hover:inline">Dashboard</span>
                </a>

                <a href="{{ route('employees.index') }}" class="flex items-center gap-4 rounded-lg px-3 py-3 text-slate-200 transition hover:bg-slate-800 {{ request()->routeIs('employees.*') ? 'bg-slate-800' : '' }}">
                    <svg class="h-6 w-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.856-1.487M15 10h.01M13 16h2v2h-2v-2zm2-6h2v2h-2v-2zm0-6h2v2h-2V4zm-8 6h2v2H7v-2zm0-6h2v2H7V4zm0 12h2v2H7v-2z"></path>
                    </svg>
                    <span class="hidden whitespace-nowrap font-medium group-hover:inline">Employees</span>
                </a>

                <a href="#" class="flex items-center gap-4 rounded-lg px-3 py-3 text-slate-200 transition hover:bg-slate-800">
                    <svg class="h-6 w-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="hidden whitespace-nowrap font-medium group-hover:inline">Payroll</span>
                </a>

                <a href="#" class="flex items-center gap-4 rounded-lg px-3 py-3 text-slate-200 transition hover:bg-slate-800">
                    <svg class="h-6 w-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                    <span class="hidden whitespace-nowrap font-medium group-hover:inline">Reports</span>
                </a>

                <button type="button" data-submenu-toggle="organization-submenu" aria-expanded="{{ request()->routeIs('organization.departments.*', 'organization.positions.*') ? 'true' : 'false' }}" class="flex w-full items-center gap-4 rounded-lg px-3 py-3 text-slate-200 transition hover:bg-slate-800 {{ request()->routeIs('organization.departments.*', 'organization.positions.*') ? 'bg-slate-800' : '' }}">
                    <svg class="h-6 w-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <span class="hidden flex-1 whitespace-nowrap text-left font-medium group-hover:inline">Organization</span>
                    <svg class="hidden h-4 w-4 shrink-0 group-hover:inline" data-submenu-caret="organization-submenu" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>

                <div id="organization-submenu" class="ml-3 space-y-1 border-l border-slate-800 pl-4 {{ request()->routeIs('organization.departments.*', 'organization.positions.*') ? '' : 'hidden' }}">
                    <a href="{{ route('organization.departments.index') }}" class="flex items-center gap-3 rounded-lg px-3 py-2 text-sm text-slate-300 transition hover:bg-slate-800 hover:text-white {{ request()->routeIs('organization.departments.*') ? 'bg-slate-800 text-white' : '' }}">
                        <span class="h-2 w-2 rounded-full bg-slate-500"></span>
                        <span class="hidden whitespace-nowrap group-hover:inline">Departments</span>
                    </a>

                    <a href="{{ route('organization.positions.index') }}" class="flex items-center gap-3 rounded-lg px-3 py-2 text-sm text-slate-300 transition hover:bg-slate-800 hover:text-white {{ request()->routeIs('organization.positions.*') ? 'bg-slate-800 text-white' : '' }}">
                        <span class="h-2 w-2 rounded-full bg-slate-500"></span>
                        <span class="hidden whitespace-nowrap group-hover:inline">Positions</span>
                    </a>
                </div>
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
