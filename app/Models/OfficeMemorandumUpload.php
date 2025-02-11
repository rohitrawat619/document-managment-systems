<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfficeMemorandumUpload extends Model
{
    use HasFactory;

    protected $table = 'office_memorandum_uploads';

    protected $guarded = ['*'];

    protected $fillable = [
       'record_id',
       'file_path',
       'file_name',
       'user_id'
    ];

    public function officeMemorandum()
    {
        return $this->belongsTo(OfficeMemorandum::class);
    }
}
