<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssementQuestionType extends Model
{
    //

    public function questions()
    { 
        return $this->hasMany(AssementQuestion::class, 'type_id')->where('is_active', 0);
    }
}
