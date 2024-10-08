<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    // Define the table if necessary, otherwise Laravel will assume it's 'notifications'
    protected $table = 'notifications';

    // Define the fillable fields
    protected $fillable = [
        'user_id',
        'title',
        'message',
        'received_at',
        'is_for_admin'
    ];
}
