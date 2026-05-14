<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Department;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class EmployeeController extends Controller
{
    /**
     * Display a listing of employees.
     */
    public function index(): View
    {
        $employees = Employee::with(['department', 'position', 'manager'])
            ->paginate(15);

        return view('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new employee.
     */
    public function create(): View
    {
        $departments = Department::all();
        $positions = Position::all();
        $managers = Employee::whereNotNull('manager_id')
            ->orWhere('position_id', 'LIKE', '%Manager%')
            ->get();

        return view('employees.create', compact('departments', 'positions', 'managers'));
    }

    /**
     * Store a newly created employee in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'employee_code' => ['required', 'string', 'unique:employees'],
            'first_name' => ['required', 'string', 'max:80'],
            'last_name' => ['required', 'string', 'max:80'],
            'middle_name' => ['nullable', 'string', 'max:80'],
            'email' => ['required', 'email', 'unique:employees'],
            'phone' => ['nullable', 'string', 'max:30'],
            'birth_date' => ['nullable', 'date'],
            'gender' => ['nullable', 'in:Male,Female,Non-binary,Prefer not to say'],
            'nationality' => ['nullable', 'string', 'max:80'],
            'marital_status' => ['nullable', 'in:Single,Married,Widowed,Divorced,Separated'],
            'address_line1' => ['nullable', 'string', 'max:200'],
            'address_line2' => ['nullable', 'string', 'max:200'],
            'city' => ['nullable', 'string', 'max:100'],
            'province' => ['nullable', 'string', 'max:100'],
            'postal_code' => ['nullable', 'string', 'max:20'],
            'country' => ['nullable', 'string', 'max:80'],
            'employment_type' => ['required', 'in:Full-time,Part-time,Contractual,Intern'],
            'status' => ['required', 'in:Active,Probationary,On Leave,Resigned,Terminated'],
            'hire_date' => ['required', 'date'],
            'regularization_date' => ['nullable', 'date'],
            'termination_date' => ['nullable', 'date'],
            'termination_reason' => ['nullable', 'string'],
            'position_id' => ['nullable', 'exists:positions,id'],
            'department_id' => ['nullable', 'exists:departments,id'],
            'manager_id' => ['nullable', 'exists:employees,id'],
        ]);

        Employee::create($validated);

        return redirect()->route('employees.index')
            ->with('success', 'Employee created successfully.');
    }

    /**
     * Display the specified employee.
     */
    public function show(Employee $employee): View
    {
        $employee->load([
            'department',
            'position',
            'manager',
            'emergencyContacts',
            'governmentIds',
            'salaryRecords',
            'documents'
        ]);

        return view('employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified employee.
     */
    public function edit(Employee $employee): View
    {
        $departments = Department::all();
        $positions = Position::all();
        $managers = Employee::where('id', '!=', $employee->id)->get();

        return view('employees.edit', compact('employee', 'departments', 'positions', 'managers'));
    }

    /**
     * Update the specified employee in storage.
     */
    public function update(Request $request, Employee $employee): RedirectResponse
    {
        $validated = $request->validate([
            'employee_code' => ['required', 'string', 'unique:employees,employee_code,' . $employee->id],
            'first_name' => ['required', 'string', 'max:80'],
            'last_name' => ['required', 'string', 'max:80'],
            'middle_name' => ['nullable', 'string', 'max:80'],
            'email' => ['required', 'email', 'unique:employees,email,' . $employee->id],
            'phone' => ['nullable', 'string', 'max:30'],
            'birth_date' => ['nullable', 'date'],
            'gender' => ['nullable', 'in:Male,Female,Non-binary,Prefer not to say'],
            'nationality' => ['nullable', 'string', 'max:80'],
            'marital_status' => ['nullable', 'in:Single,Married,Widowed,Divorced,Separated'],
            'address_line1' => ['nullable', 'string', 'max:200'],
            'address_line2' => ['nullable', 'string', 'max:200'],
            'city' => ['nullable', 'string', 'max:100'],
            'province' => ['nullable', 'string', 'max:100'],
            'postal_code' => ['nullable', 'string', 'max:20'],
            'country' => ['nullable', 'string', 'max:80'],
            'employment_type' => ['required', 'in:Full-time,Part-time,Contractual,Intern'],
            'status' => ['required', 'in:Active,Probationary,On Leave,Resigned,Terminated'],
            'hire_date' => ['required', 'date'],
            'regularization_date' => ['nullable', 'date'],
            'termination_date' => ['nullable', 'date'],
            'termination_reason' => ['nullable', 'string'],
            'position_id' => ['nullable', 'exists:positions,id'],
            'department_id' => ['nullable', 'exists:departments,id'],
            'manager_id' => ['nullable', 'exists:employees,id'],
        ]);

        $employee->update($validated);

        return redirect()->route('employees.show', $employee)
            ->with('success', 'Employee updated successfully.');
    }

    /**
     * Remove the specified employee from storage.
     */
    public function destroy(Employee $employee): RedirectResponse
    {
        $employee->delete();

        return redirect()->route('employees.index')
            ->with('success', 'Employee deleted successfully.');
    }
}
