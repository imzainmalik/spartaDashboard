<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AssementFillup extends Model
{
    //

    /**
     * Get all of the Question for the AssementFillup
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */

    public function question()
    {
        return $this->belongsTo(AssementQuestion::class, 'question_id');
    }

    public function answer()
    {
        return $this->belongsTo(AssementAnswer::class);
    }

    public function customer(){
        return $this->hasOne(Customer::class,'id','customer_id');
    }

    public function assessment_by(){
        return $this->hasOne( User::class,'id','employee_id');
    }

    public function assessment_riskscore(){
        return $this->belongsTo(AssementNotes::class,'assement_no','assement_no');
    }

    public function assessment_report(){
        return $this->hasOne(ReportGenrated::class,'assessment_no','assement_no');
    }
}
