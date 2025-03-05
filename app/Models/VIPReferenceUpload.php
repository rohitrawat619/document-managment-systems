<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VIPReferenceUpload extends Model
{
    use HasFactory;
    protected $table = 'vip_reference_upload';

    protected $guarded = ['*'];

    protected $fillable = [
       'record_id',
       'file_path',
       'file_name',
       'user_id'
    ];

    public function VIPReference()
    {
        return $this->belongsTo(VIPReference::class);
    }

}
