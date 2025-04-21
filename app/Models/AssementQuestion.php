<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\AssementAnswer;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AssementQuestion extends Model
{

    public function type()
    {
        return $this->belongsTo(AssementQuestionType::class, 'type_id');
    }

    /**
     * Get all of the comments for the AssementQuestion
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function answerOption(): HasMany
    {
        return $this->hasMany(AssementAnswer::class, 'question_id', 'id')->where('is_active', 0);
    }

    public function fillups()
    {
        return $this->hasMany(AssementFillup::class, 'question_id');
    }
}
