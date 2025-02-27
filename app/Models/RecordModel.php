<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecordModel extends Model
{
    use HasFactory;
    protected $table = 'records_of_discussion';

    protected $guarded = ['*'];

    protected $fillable = [
        'date_of_Meeting',
        'subject',
        'agenda',
        'user_id',
        'issuer_designation',
        'division_id',
        'date_of_upload',
        'uploaded_by',
         'keyword'
    ];

    public function uploads()
    {
        return $this->hasMany(RecordUpload::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
}
