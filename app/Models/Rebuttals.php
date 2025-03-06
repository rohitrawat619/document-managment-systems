<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rebuttals extends Model
{
    use HasFactory;
    protected $table = 'rebuttals';

    protected $guarded = ['*'];
    protected $fillable = [
        'computer_no',
        'receipt_no',
        'court_name',
        'case_no',
        'petitioner',
        'respondent',
        'subject',
        'issuer_name',
        'user_id',
        'issuer_designation',
        'date_of_upload',
        'uploaded_by',
        'keyword'
    ];

    public function uploads()
    {
        return $this->hasMany(RebuttalsUpload::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
}
