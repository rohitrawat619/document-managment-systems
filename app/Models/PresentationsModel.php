<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PresentationsModel extends Model
{
    use HasFactory;
    protected $table = 'presentations';

    protected $guarded = ['*'];

    protected $fillable = [
    
         'computer_no',
         'file_no',
         'date_of_publication',
         'subject',
         'issuer_name',
         'user_id',
         'approvedBy',
         'issuer_designation',
         'date_of_upload',
         'uploaded_by',
         'keyword'
    ];

    public function uploads()
    {
        return $this->hasMany(PresentationUpload::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
}
