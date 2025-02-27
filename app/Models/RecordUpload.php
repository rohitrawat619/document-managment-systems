<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecordUpload extends Model
{
    use HasFactory;
    protected $table = 'records_of_discussion_upload';

    protected $guarded = ['*'];

    protected $fillable = [
       'record_id',
       'file_path',
       'file_name',
       'user_id'
    ];

    public function RecordModel()
    {
        return $this->belongsTo(RecordModel::class);
    }
}
