<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Raise extends Model
{
    use HasFactory;

    protected $primaryKey = 'RaiseID';
    public $timestamps = true;

    public function employee()
    {
        return $this->belongsTo(Client::class, 'EmployeeID');
    }
}
