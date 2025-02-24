<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AchievementUpload extends Model
{
    use HasFactory;
    protected $table = 'achievenment_upload';

    protected $guarded = ['*'];

    protected $fillable = [
       'record_id',
       'file_path',
       'file_name',
       'user_id'
    ];

    public function Achievement()
    {
        return $this->belongsTo(Achievement::class);
    }
}
