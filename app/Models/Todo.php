<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'content',
        'due_date',
        'status',
        'user_id',
    ];

    protected $dates = [
        'due_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
