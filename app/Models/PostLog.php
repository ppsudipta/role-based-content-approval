<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostLog extends Model
{
    protected $fillable = [
        'post_id',
        'action',
        'performed_by',
        'meta'
    ];

    protected $casts = [
        'meta' => 'array',
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'performed_by');
    }
}