<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Position;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrganizationController extends Controller
{
    public function departments(): View
    {
        $departments = Department::with('parentDepartment')
            ->orderBy('name')
            ->get();

        return view('organization.departments', compact('departments'));
    }

    public function positions(): View
    {
        $positions = Position::with('department')
            ->orderBy('title')
            ->get();

        $topLevelDepartments = Department::whereNull('parent_dept_id')
            ->orderBy('name')
            ->get();

        return view('organization.positions', compact('positions', 'topLevelDepartments'));
    }

    public function storeDepartment(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'parent_dept_id' => ['nullable', 'exists:departments,id'],
        ]);

        Department::create($validated);

        return redirect()->route('organization.index')->with('success', 'Department created successfully.');
    }

    public function destroyDepartment(Department $department): RedirectResponse
    {
        $department->delete();

        return redirect()->route('organization.index')->with('success', 'Department deleted successfully.');
    }

    public function storePosition(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:120'],
            'level' => ['nullable', 'string', 'max:60'],
            'department_id' => ['nullable', 'exists:departments,id'],
            'min_salary' => ['nullable', 'numeric', 'min:0'],
            'max_salary' => ['nullable', 'numeric', 'gte:min_salary'],
        ]);

        Position::create($validated);

        return redirect()->route('organization.index')->with('success', 'Position created successfully.');
    }

    public function destroyPosition(Position $position): RedirectResponse
    {
        $position->delete();

        return redirect()->route('organization.index')->with('success', 'Position deleted successfully.');
    }
}
