<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CabinateNoteUpload extends Model
{
    use HasFactory;
    protected $table = 'cabinet_note_upload';

    protected $guarded = ['*'];

    protected $fillable = [
       'record_id',
       'file_path',
       'file_name',
       'user_id'
    ];

    public function VIPReference()
    {
        return $this->belongsTo(CabinateNote::class);
    }
}
