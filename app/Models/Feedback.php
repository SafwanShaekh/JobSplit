<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'feedbacks'; // <-- YEH LINE MASLA HAL KAREGI

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'application_id',
        'job_id',
        'employer_id',
        'worker_id',
        'q1_punctual',
        'q2_satisfactory',
        'q3_professional',
        'q4_hire_again',
        'q5_fair_price',
        'rating', 
    ];
}