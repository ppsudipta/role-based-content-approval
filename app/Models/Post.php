<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'user_id',
        'title',
        'body',
        'status',
        'approved_by',
        'rejected_reason'
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
        public function logs()
    {
        return $this->hasMany(PostLog::class);
    }
}