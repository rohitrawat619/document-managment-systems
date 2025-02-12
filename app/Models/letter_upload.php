<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class letter_upload extends Model
{
    use HasFactory;

    protected $table = 'letter_upload';

    protected $guarded = ['*'];

    protected $fillable = [
       'record_id',
       'file_path',
       'file_name',
       'user_id'
    ];

    public function letter()
    {
        return $this->belongsTo(letter::class);
    }
}
