<?php

namespace App\Models;

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
    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
