<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PmReference extends Model
{
    use HasFactory;
    protected $table = 'pm_reference';

    protected $guarded = ['*'];
    protected $fillable = [
        'computer_no',
        'file_no',
        'date_of_receipt',
        'subject',
        'action',
        'date_of_sent',
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
        return $this->hasMany(PmReferenceUpload::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

}
