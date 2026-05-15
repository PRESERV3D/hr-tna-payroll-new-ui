<x-app-layout>
    <x-slot:title>Departments</x-slot:title>
    <x-slot:header>Departments</x-slot:header>

    <div>
        <h1 class="text-2xl font-semibold">Departments</h1>
        <p class="text-sm text-slate-500">Manage department records and parent departments.</p>
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
        <h2 class="text-lg font-semibold text-slate-900">Departments</h2>
        <p class="mt-1 text-sm text-slate-600">Create top-level or child departments.</p>

        <form method="POST" action="{{ route('organization.departments.store') }}" class="mt-6 grid gap-4 rounded-xl border border-slate-200 bg-slate-50 p-4">
            @csrf
            <div>
                <label for="department_name" class="mb-2 block text-sm font-medium text-slate-700">Department Name</label>
                <input id="department_name" name="name" type="text" value="{{ old('name') }}" class="w-full rounded-lg border-slate-300 focus:border-slate-500 focus:ring-slate-500" placeholder="Human Resources">
            </div>
            <div>
                <label for="parent_dept_id" class="mb-2 block text-sm font-medium text-slate-700">Parent Department</label>
                <select id="parent_dept_id" name="parent_dept_id" class="w-full rounded-lg border-slate-300 focus:border-slate-500 focus:ring-slate-500">
                    <option value="">None</option>
                    @foreach ($departments as $department)
                        <option value="{{ $department->id }}" @selected(old('parent_dept_id') == $department->id)>{{ $department->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <button type="submit" class="btn-primary">Add Department</button>
            </div>
        </form>

        <div class="mt-6 overflow-hidden rounded-lg border border-slate-200 bg-white">
            <table class="w-full text-sm">
                <thead class="bg-slate-50 text-left text-xs uppercase text-slate-500">
                    <tr>
                        <th class="px-4 py-3">Name</th>
                        <th class="px-4 py-3">Parent</th>
                        <th class="px-4 py-3 text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 bg-white">
                    @forelse ($departments as $department)
                        <tr>
                            <td class="px-4 py-3 font-medium text-slate-900">{{ $department->name }}</td>
                            <td class="px-4 py-3 text-slate-600">{{ $department->parentDepartment->name ?? 'Top Level' }}</td>
                            <td class="px-4 py-3 text-right">
                                <form method="POST" action="{{ route('organization.departments.destroy', $department) }}" onsubmit="return confirm('Delete this department?');" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-sm font-semibold text-red-600 hover:text-red-800">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-4 py-6 text-center text-sm text-slate-500">No departments yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
</x-app-layout>
