<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incentive extends Model
{
    use HasFactory;

    protected $primaryKey = 'IncentiveID'; // تعديل اسم العمود الرئيسي
    protected $fillable = [
        'IncentiveType',
        'Description',
        'Amount',
        'DateIssued',
        'EmployeeID', // إضافة هذا العمود
    ];
}
