<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'location', 'email', 'phone1', 'phone2', 'landline', 'pager_number',
        'profile_image', 'id_front_image', 'id_back_image', 'salary', 'basic_salary',
        'number_of_wives', 'number_of_children', 'employment_type', 'salary_increase'
    ];

    protected $casts = [
        'profile_image' => 'string',
        'id_front_image' => 'string',
        'id_back_image' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
