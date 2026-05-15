<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'HR System' }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --primary: #4f46e5;
            --bg: #f8fafc;
            --muted: #f1f5f9;
            --border: #e2e8f0;
            --fg: #0f172a;
            --muted-fg: #64748b;
        }
        body { background: var(--bg); color: var(--fg); font-family: ui-sans-serif, system-ui, -apple-system, "Segoe UI", Roboto, sans-serif; }
        .card { background: #fff; border: 1px solid var(--border); border-radius: 12px; }
        .btn-primary { background: var(--primary); color: #fff; padding: .5rem 1rem; border-radius: 8px; font-size: .875rem; font-weight: 500; }
        .btn-outline { border: 1px solid var(--border); padding: .5rem 1rem; border-radius: 8px; font-size: .875rem; background: #fff; }
        .nav-link { display: flex; align-items: center; gap: .625rem; padding: .5rem .75rem; border-radius: 8px; color: var(--muted-fg); font-size: .875rem; }
        .nav-link:hover { background: var(--muted); color: var(--fg); }
        .nav-link.active { background: #eef2ff; color: var(--primary); font-weight: 500; }
        .badge { display: inline-flex; align-items: center; padding: .125rem .5rem; border-radius: 9999px; font-size: .75rem; font-weight: 500; }
        .badge-green { background: #dcfce7; color: #166534; }
        .badge-amber { background: #fef3c7; color: #92400e; }
        .badge-red { background: #fee2e2; color: #991b1b; }
        .badge-blue { background: #dbeafe; color: #1e40af; }
        .badge-gray { background: #f1f5f9; color: #475569; }
        .sidebar-toggle {
            width: 2rem;
            height: 2rem;
            padding: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 0.5rem;
        }
        .sidebar-shell {
            width: 15rem;
            transition: width 180ms ease;
        }
        .sidebar-collapsed .sidebar-shell {
            width: 4.75rem;
        }
        .sidebar-collapsed .sidebar-brand-text,
        .sidebar-collapsed .sidebar-group-label,
        .sidebar-collapsed .sidebar-nav-label,
        .sidebar-collapsed .sidebar-user-text {
            display: none;
        }
        .sidebar-collapsed .sidebar-nav-link {
            justify-content: center;
            gap: 0;
        }
    </style>
</head>
<body>
    @php
        $nav = [
            ['route' => 'dashboard', 'label' => 'Dashboard', 'group' => 'Overview', 'icon' => 'home'],
            ['route' => 'employees.index', 'label' => 'Employees', 'group' => 'Modules', 'icon' => 'users'],
            ['route' => 'organization.departments.index', 'label' => 'Organization', 'group' => 'Modules', 'icon' => 'building'],
            ['route' => 'onboarding', 'label' => 'Onboarding', 'group' => 'Modules', 'icon' => 'user-plus'],
            ['route' => 'timekeeping', 'label' => 'Timekeeping', 'group' => 'Modules', 'icon' => 'clock'],
            ['route' => 'leave', 'label' => 'Leave', 'group' => 'Modules', 'icon' => 'calendar'],
            ['route' => 'payroll.index', 'label' => 'Payroll', 'group' => 'Modules', 'icon' => 'wallet'],
            ['route' => 'benefits', 'label' => 'Benefits', 'group' => 'Modules', 'icon' => 'shield-heart'],
            ['route' => 'self-service', 'label' => 'Self-Service', 'group' => 'Modules', 'icon' => 'address-card'],
            ['route' => 'reports', 'label' => 'Reports', 'group' => 'Modules', 'icon' => 'chart-column'],
        ];
        $groups = collect($nav)->groupBy('group');
    @endphp

    <div class="min-h-screen flex w-full" id="app-shell">
        <aside class="sidebar-shell shrink-0 border-r border-slate-200 bg-white p-4 hidden md:block">
            <div class="flex items-center justify-start px-2 py-1">
                <button id="sidebar-collapse-toggle" class="btn-outline sidebar-toggle" type="button" aria-label="Collapse sidebar" aria-pressed="false">
                    <i id="sidebar-collapse-icon" class="fa-solid fa-angles-left text-xs"></i>
                </button>
            </div>
            @foreach ($groups as $groupName => $items)
                <div class="mt-4">
                    <p class="sidebar-group-label px-3 text-xs font-medium uppercase tracking-wide text-slate-400 mb-1">{{ $groupName }}</p>
                    <nav class="space-y-1">
                        @foreach ($items as $item)
                            <a href="{{ route($item['route']) }}" class="nav-link sidebar-nav-link {{ request()->routeIs($item['route']) ? 'active' : '' }}">
                                <span class="w-4 shrink-0 text-center"><i class="fas fa-{{ $item['icon'] }}"></i></span>
                                <span class="sidebar-nav-label">{{ $item['label'] }}</span>
                            </a>
                        @endforeach
                    </nav>
                </div>
            @endforeach
        </aside>

        <div class="flex-1 flex flex-col min-w-0">
            <header class="h-14 flex items-center justify-between border-b border-slate-200 bg-white px-6">
                <div class="flex items-center gap-3 min-w-0">
                    <input type="search" placeholder="Search..." class="w-72 max-w-sm rounded-lg border border-slate-200 bg-slate-50 px-3 py-1.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-200" />
                </div>
                <div class="flex items-center gap-3">
                    <button class="btn-outline text-sm" type="button">🔔</button>
                    <div class="h-8 w-8 rounded-full bg-indigo-100 text-indigo-700 flex items-center justify-center text-sm font-semibold">{{ strtoupper(substr(auth()->user()->name, 0, 2)) }}</div>
                </div>
            </header>

            <main class="flex-1 p-6 space-y-6">{{ $slot }}</main>
        </div>
    </div>
</body>
</html>
