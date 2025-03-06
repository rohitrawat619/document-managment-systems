<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    use HasFactory;
    protected $table = 'achievenment';

    protected $guarded = ['*'];
    protected $fillable = [
        'computer_no',
        'file_no',
        'date_of_publication',
        'subject',
        'issuer_name',
        'user_id',
        'issuer_designation',
        'file_type',
        'division_id',
        'date_of_upload',
        'uploaded_by',
        'keyword'
    ];

    public function uploads()
    {
        return $this->hasMany(AchievementUpload::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

}
