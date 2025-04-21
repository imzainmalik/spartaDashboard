<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReportSetting extends Model
{
    protected $fillable = [
        'report_title',
        'report_logo',
        'report_phone',
        'report_email',
        'report_address',
    ];
}
