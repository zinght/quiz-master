<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuizQuestion extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "quiz_questions";

    protected $fillable = [
        'questions',
        'answer',
        'clue',
        'position',
        'quiz_id',
    ];
    protected $casts = [
        'position' => 'int',
        'quiz_id' => 'int'
    ];
    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }
}

