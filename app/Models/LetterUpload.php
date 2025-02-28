<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LetterUpload extends Model
{
    use HasFactory;

    protected $table = 'letter_uploads';

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
