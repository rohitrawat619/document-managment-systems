<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RebuttalsUpload extends Model
{
    use HasFactory;
    protected $table = 'rebuttals_upload';

    protected $guarded = ['*'];

    protected $fillable = [
       'record_id',
       'file_path',
       'file_name',
       'user_id'
    ];

    public function Rebuttals()
    {
        return $this->belongsTo(Rebuttals::class);
    }
}
