<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'phone1', 'phone2', 'landline', 'pager_number', 'profile_image', 'id_front_image', 'id_back_image'
    ];

    protected $casts = [
        'profile_image' => 'string',
        'id_front_image' => 'string',
        'id_back_image' => 'string',
    ];
}
