<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{
    // Menampilkan daftar pegawai
    public function index(Request $request)
    {
        $employees = Employee::query()
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->input('search');

                $query->where(function ($q) use ($search) {
                    $q->where('nip', 'like', "%{$search}%")
                        ->orWhere('name', 'like', "%{$search}%")
                        ->orWhere('position', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('employees.index', compact('employees'));
    }

    // Form tambah pegawai
    public function create()
    {
        return view('employees.create');
    }

    // Menyimpan pegawai baru
    public function store(Request $request)
    {
        $validated = $request->validate($this->rules());

        Employee::create($validated);

        return redirect()
            ->route('employees.index')
            ->with('success', 'Data pegawai berhasil ditambahkan.');
    }

    // Detail pegawai
    public function show(Employee $employee)
    {
        return view('employees.show', compact('employee'));
    }

    // Form edit pegawai
    public function edit(Employee $employee)
    {
        return view('employees.edit', compact('employee'));
    }

    // Memperbarui data pegawai
    public function update(Request $request, Employee $employee)
    {
        $validated = $request->validate(
            $this->rules($employee)
        );

        $employee->update($validated);

        return redirect()
            ->route('employees.index')
            ->with('success', 'Data pegawai berhasil diperbarui.');
    }

    // Menghapus pegawai
    public function destroy(Employee $employee)
    {
        $employee->delete();

        return redirect()
            ->route('employees.index')
            ->with('success', 'Data pegawai berhasil dihapus.');
    }

    // Aturan validasi terpusat
    private function rules(?Employee $employee = null): array
    {
        return [
            'nip' => [
                'required',
                'string',
                'max:30',
                Rule::unique('employees', 'nip')
                    ->ignore($employee?->id),
            ],
            'name' => ['required', 'string', 'max:150'],
            'gender' => ['required', Rule::in(['L', 'P'])],
            'place_of_birth' => ['required', 'string', 'max:100'],
            'date_of_birth' => ['required', 'date', 'before:today'],
            'address' => ['required', 'string'],
            'last_education' => ['required', 'string', 'max:100'],
            'position' => ['required', 'string', 'max:100'],
            'hire_date' => ['required', 'date', 'after_or_equal:date_of_birth'],
            'phone' => ['required', 'string', 'max:20'],
            'email' => [
                'nullable',
                'email',
                'max:255',
                Rule::unique('employees', 'email')
                    ->ignore($employee?->id),
            ],
        ];
    }
}
