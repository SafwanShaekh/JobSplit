<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    // Kis table ke saath model linked hai
    protected $table = 'jobs';

    // Mass assignment ke liye fillable fields
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'category',
        'pay',
        'date_time',
        'duration',
        'location',
        'status',
    ];

    /**
     * Relationship: Job belongs to one User (Employer)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

     public function applications()
    {
        return $this->hasMany(Application::class);
    }
}
