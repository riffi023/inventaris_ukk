<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserActivity extends Model
{
    protected $fillable = [
        'user_id',
        'activity_type',
        'page_accessed',
        'ip_address',
        'user_agent',
        'login_at',
        'logout_at'
    ];

    protected $dates = [
        'login_at',
        'logout_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
