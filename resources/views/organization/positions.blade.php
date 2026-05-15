<x-app-layout>
    <x-slot:title>Positions</x-slot:title>
    <x-slot:header>Positions</x-slot:header>

    <div>
        <h1 class="text-2xl font-semibold">Positions</h1>
        <p class="text-sm text-slate-500">Manage position records and department assignments.</p>
    </div>

    @if (session('success'))
        <div class="mb-6 rounded-lg border border-green-200 bg-green-50 p-4 text-sm text-green-700">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="mb-6 rounded-lg border border-red-200 bg-red-50 p-4">
            <ul class="space-y-1 text-sm text-red-700">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <section class="card p-6">
        <h2 class="text-lg font-semibold text-slate-900">Positions</h2>
        <p class="mt-1 text-sm text-slate-600">Create positions and link them to a department.</p>

        <form method="POST" action="{{ route('organization.positions.store') }}" class="mt-6 grid gap-4 rounded-xl border border-slate-200 bg-slate-50 p-4">
            @csrf
            <div>
                <label for="position_title" class="mb-2 block text-sm font-medium text-slate-700">Position Title</label>
                <input id="position_title" name="title" type="text" value="{{ old('title') }}" class="w-full rounded-lg border-slate-300 focus:border-slate-500 focus:ring-slate-500" placeholder="Payroll Officer">
            </div>
            <div>
                <label for="position_level" class="mb-2 block text-sm font-medium text-slate-700">Level</label>
                <input id="position_level" name="level" type="text" value="{{ old('level') }}" class="w-full rounded-lg border-slate-300 focus:border-slate-500 focus:ring-slate-500" placeholder="Senior">
            </div>
            <div>
                <label for="position_department_id" class="mb-2 block text-sm font-medium text-slate-700">Department</label>
                <select id="position_department_id" name="department_id" class="w-full rounded-lg border-slate-300 focus:border-slate-500 focus:ring-slate-500">
                    <option value="">None</option>
                    @foreach ($topLevelDepartments as $department)
                        <option value="{{ $department->id }}" @selected(old('department_id') == $department->id)>{{ $department->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="grid gap-4 sm:grid-cols-2">
                <div>
                    <label for="min_salary" class="mb-2 block text-sm font-medium text-slate-700">Min Salary</label>
                    <input id="min_salary" name="min_salary" type="number" step="0.01" min="0" value="{{ old('min_salary') }}" class="w-full rounded-lg border-slate-300 focus:border-slate-500 focus:ring-slate-500">
                </div>
                <div>
                    <label for="max_salary" class="mb-2 block text-sm font-medium text-slate-700">Max Salary</label>
                    <input id="max_salary" name="max_salary" type="number" step="0.01" min="0" value="{{ old('max_salary') }}" class="w-full rounded-lg border-slate-300 focus:border-slate-500 focus:ring-slate-500">
                </div>
            </div>
            <div>
                <button type="submit" class="btn-primary">Add Position</button>
            </div>
        </form>

        <div class="mt-6 overflow-hidden rounded-lg border border-slate-200 bg-white">
            <table class="w-full text-sm">
                <thead class="bg-slate-50 text-left text-xs uppercase text-slate-500">
                    <tr>
                        <th class="px-4 py-3">Title</th>
                        <th class="px-4 py-3">Department</th>
                        <th class="px-4 py-3 text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 bg-white">
                    @forelse ($positions as $position)
                        <tr>
                            <td class="px-4 py-3 font-medium text-slate-900">{{ $position->title }}</td>
                            <td class="px-4 py-3 text-slate-600">{{ $position->department->name ?? 'Unassigned' }}</td>
                            <td class="px-4 py-3 text-right">
                                <form method="POST" action="{{ route('organization.positions.destroy', $position) }}" onsubmit="return confirm('Delete this position?');" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-sm font-semibold text-red-600 hover:text-red-800">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-4 py-6 text-center text-sm text-slate-500">No positions yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
</x-app-layout>
