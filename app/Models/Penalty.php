<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Penalty extends Model
{    use HasFactory;
    protected $primaryKey = 'PenaltyID';

  protected $fillable = [
        'PenaltyType',
        'Description',
        'PenaltyAmount',
        'DateIssued',
        'EmployeeID',
    ];
}
