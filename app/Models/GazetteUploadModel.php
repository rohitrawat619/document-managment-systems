<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GazetteUploadModel extends Model
{
    use HasFactory;
    protected $table = 'gazette_notification_uploads';

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
