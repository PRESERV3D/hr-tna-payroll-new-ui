<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'HR System' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            --sidebar-width: 5rem;
        }

        body:has(.sidebar:hover) {
            --sidebar-width: 18rem;
        }

        html,
        body {
            overflow-x: hidden;
        }

        details > .organization-submenu {
            display: none;
        }

        details[open] > .organization-submenu {
            display: block;
        }

        details .organization-arrow {
            transition: transform 300ms ease;
        }

        details[open] .organization-arrow {
            transform: rotate(180deg);
        }

        details > summary::-webkit-details-marker {
            display: none;
        }

        .sidebar {
            width: var(--sidebar-width);
        }

        .main-content {
            margin-left: 0;
            padding-left: var(--sidebar-width);
            width: 100%;
        }
    </style>
    {{ $head ?? '' }}
</head>
<body class="min-h-screen font-sans text-slate-900">
    <div class="flex min-h-screen bg-transparent">
        <!-- Sidebar -->
        <aside class="sidebar group fixed left-0 top-0 z-40 flex h-screen flex-col overflow-hidden border-r border-slate-200 bg-white p-3 text-slate-700 transition-[width,padding] duration-300 ease-in-out">
            <div class="flex flex-1 flex-col overflow-y-auto pb-4">
                <div class="mb-6 flex items-center gap-3 rounded-2xl bg-sky-50 p-3">
                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-sky-100 text-sky-600">
                        <i class="fas fa-briefcase text-base"></i>
                    </div>
                    <div class="hidden min-w-0 whitespace-nowrap group-hover:block">
                        <p class="text-sm font-semibold tracking-wide text-slate-900">Northwind HR</p>
                        <p class="text-xs text-slate-500">People Platform</p>
                    </div>
                </div>

                <!-- Navigation -->
                <nav class="space-y-2">
                    <p class="hidden px-3 pb-2 text-xs font-semibold uppercase tracking-[0.16em] text-slate-500 group-hover:block">Overview</p>
                    <a href="{{ route('dashboard') }}" class="flex items-center justify-start gap-3 rounded-xl px-3 py-3 text-slate-700 transition hover:bg-slate-100 {{ request()->routeIs('dashboard') ? 'bg-sky-100 text-sky-700 shadow-lg shadow-sky-200/30' : '' }}">
                        <span class="inline-flex h-6 w-6 shrink-0 items-center justify-center">
                            <i class="fas fa-home text-base"></i>
                        </span>
                        <span class="hidden whitespace-nowrap font-medium group-hover:inline">Dashboard</span>
                    </a>

                    <p class="hidden px-3 pt-3 pb-2 text-xs font-semibold uppercase tracking-[0.16em] text-slate-500 group-hover:block">Modules</p>

                    <a href="{{ route('employees.index') }}" class="flex items-center justify-start gap-3 rounded-xl px-3 py-3 text-slate-700 transition hover:bg-slate-100 {{ request()->routeIs('employees.*') ? 'bg-sky-100 text-sky-700 shadow-lg shadow-sky-200/30' : '' }}">
                        <span class="inline-flex h-6 w-6 shrink-0 items-center justify-center">
                            <i class="fas fa-user text-base"></i>
                        </span>
                        <span class="hidden whitespace-nowrap font-medium group-hover:inline">Employees</span>
                    </a>

                    <a href="{{ route('payroll.index') }}" class="flex items-center justify-start gap-3 rounded-xl px-3 py-3 text-slate-700 transition hover:bg-slate-100 {{ request()->routeIs('payroll.*') ? 'bg-sky-100 text-sky-700 shadow-lg shadow-sky-200/30' : '' }}">
                        <span class="inline-flex h-6 w-6 shrink-0 items-center justify-center">
                            <i class="fas fa-money-bill text-base"></i>
                        </span>
                        <span class="hidden whitespace-nowrap font-medium group-hover:inline">Payroll</span>
                    </a>

                    <details class="group" {{ request()->routeIs('organization.departments.*', 'organization.positions.*') ? 'open' : '' }}>
                        <summary class="flex cursor-pointer list-none items-center justify-start gap-3 px-3 py-3 text-slate-700 transition hover:bg-slate-100">
                            <span class="inline-flex h-6 w-6 shrink-0 items-center justify-center">
                                <i class="fas fa-building text-base"></i>
                            </span>
                            <span class="hidden flex-1 whitespace-nowrap font-medium group-hover:block">Organization</span>
                            <span class="hidden organization-arrow inline-flex items-center text-xs text-slate-500 transition-transform duration-300 group-hover:block">
                            <i class="fas fa-chevron-down"></i>
                        </span>
                        </summary>

                        <div class="ml-3 mt-1 hidden space-y-0 border-l-2 border-sky-400 bg-sky-50/50 py-2 pl-3 pr-3 group-hover:block">
                            <a href="{{ route('organization.departments.index') }}" class="block px-4 py-2 text-sm text-slate-600 transition hover:text-slate-900 {{ request()->routeIs('organization.departments.*') ? 'text-sky-700 font-semibold' : '' }}">
                                Departments
                            </a>

                            <a href="{{ route('organization.positions.index') }}" class="block px-4 py-2 text-sm text-slate-600 transition hover:text-slate-900 {{ request()->routeIs('organization.positions.*') ? 'text-sky-700 font-semibold' : '' }}">
                                Positions
                            </a>
                        </div>
                    </details>
                </nav>
            </div>

            <!-- Footer: logout pinned to bottom -->
            <div class="mt-auto pt-4">
                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <button type="submit" class="flex w-full items-center justify-start gap-3 rounded-xl border border-slate-200 bg-slate-100 px-3 py-3 text-slate-700 transition hover:bg-slate-200">
                        <svg class="h-6 w-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                        <span class="hidden whitespace-nowrap font-medium group-hover:inline">Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content flex-1 overflow-y-auto transition-[padding-left] duration-300 ease-in-out">
            <!-- Top Bar -->
            <div class="sticky top-0 z-20 border-b border-slate-200/80 bg-white/85 px-8 py-5 backdrop-blur-md">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.16em] text-slate-400">Workspace</p>
                        <h1 class="text-3xl font-extrabold text-slate-900">{{ $header ?? '' }}</h1>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="hidden items-center gap-2 rounded-xl border border-slate-200 bg-white px-3 py-2 shadow-sm lg:flex">
                            <i class="fas fa-search text-xs text-slate-400"></i>
                            <span class="text-sm text-slate-500">Search...</span>
                        </div>
                        <button class="inline-flex h-10 w-10 items-center justify-center rounded-xl border border-slate-200 bg-white text-slate-500 shadow-sm transition hover:bg-slate-50" type="button" aria-label="Notifications">
                            <i class="fas fa-bell text-sm"></i>
                        </button>
                        <div class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-sky-100 text-sm font-bold text-sky-700">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
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
