<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * Hum yahan batate hain ke 'email' column mein data
     * direct controller se save kiya ja sakta hai.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
    ];
}