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
}
