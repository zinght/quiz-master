<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quiz extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "quizzes";

    protected $fillable = [
        'name',
        'description',
        'created_by',
    ];
    public function createdby()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function questions()
    {
        return $this->hasMany(QuizQuestion::class, 'quiz_id');
    }

    public function getCreatedAtDateDisplayAttribute()
    {
        return Carbon::parse($this->created_at)->format('d/m/Y');
    }
}
