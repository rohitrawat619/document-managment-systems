<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PmReferenceUpload extends Model
{
    use HasFactory;
    protected $table = 'pm_reference_upload';

    protected $guarded = ['*'];

    protected $fillable = [
       'record_id',
       'file_path',
       'file_name',
       'user_id'
    ];

    public function PmReference()
    {
        return $this->belongsTo(PmReference::class);
    }
}
