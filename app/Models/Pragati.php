<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pragati extends Model
{
    use HasFactory;
    protected $table = 'pragati';

    protected $guarded = ['*'];
    protected $fillable = [
        'computer_no',
        'file_no',
        'date_of_receipt',
        'agenda',
        'action_taken',
        'date_of_reply',
        'issuer_name',
        'user_id',
        'issuer_designation',
        'division_id',
        'date_of_upload',
        'uploaded_by',
        'keywords'
    ];

    public function uploads()
    {
        return $this->hasMany(PragatiUpload::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
}
