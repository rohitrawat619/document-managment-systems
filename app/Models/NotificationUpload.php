<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationUpload extends Model
{
    use HasFactory;

    protected $table = 'notification_uploads';

    protected $guarded = ['*'];

    protected $fillable = [
       'record_id',
       'file_path',
       'file_name',
       'user_id'
    ];

    public function notification()
    {
        return $this->belongsTo(Notification::class);
    }
}

