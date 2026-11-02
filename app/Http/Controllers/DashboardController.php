<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistik pegawai
        $totalEmployees = Employee::count();

        $totalMale = Employee::where('gender', 'L')->count();

        $totalFemale = Employee::where('gender', 'P')->count();

        // Statistik pegawai berdasarkan pendidikan
        $employeesByEducation = Employee::selectRaw('last_education, COUNT(*) as total')
            ->groupBy('last_education')
            ->orderByDesc('total')
            ->get();

        // Statistik pegawai berdasarkan jabatan
        $employeesByPosition = Employee::selectRaw('position, COUNT(*) as total')
            ->groupBy('position')
            ->orderByDesc('total')
            ->get();

        // Statistik pegawai berdasarkan usia
        $employeesByAge = Employee::selectRaw("
            CASE
                WHEN TIMESTAMPDIFF(YEAR, date_of_birth, CURDATE()) < 25
                    THEN 'Di bawah 25 tahun'
                WHEN TIMESTAMPDIFF(YEAR, date_of_birth, CURDATE()) BETWEEN 25 AND 34
                    THEN '25 - 34 tahun'
                WHEN TIMESTAMPDIFF(YEAR, date_of_birth, CURDATE()) BETWEEN 35 AND 44
                    THEN '35 - 44 tahun'
                WHEN TIMESTAMPDIFF(YEAR, date_of_birth, CURDATE()) BETWEEN 45 AND 54
                    THEN '45 - 54 tahun'
                ELSE '55 tahun ke atas'
            END AS age_group,
            COUNT(*) AS total
        ")
            ->whereNotNull('date_of_birth')
            ->groupBy('age_group')
            ->orderByRaw("FIELD(age_group,
                'Di bawah 25 tahun',
                '25 - 34 tahun',
                '35 - 44 tahun',
                '45 - 54 tahun',
                '55 tahun ke atas'
            )")
            ->get();

        // Total Admin (khusus Superadmin)
        $totalAdmins = 0;

        if (auth()->user()->role === 'superadmin') {
            $totalAdmins = User::where('role', 'admin')->count();
        }

        return view('dashboard', compact(
            'totalEmployees',
            'totalMale',
            'totalFemale',
            'employeesByEducation',
            'employeesByPosition',
            'employeesByAge',
            'totalAdmins'
        ));
    }
}
