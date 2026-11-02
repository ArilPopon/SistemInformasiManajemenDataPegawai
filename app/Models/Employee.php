<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'nip',
        'name',
        'gender',
        'place_of_birth',
        'date_of_birth',
        'address',
        'last_education',
        'position',
        'hire_date',
        'phone',
        'email',
    ];

    protected function casts(): array
    {
        return [
            'date_of_birth' => 'date',
            'hire_date' => 'date',
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'nip';
    }
}
