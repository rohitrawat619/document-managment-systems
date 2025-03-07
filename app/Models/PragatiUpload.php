<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PragatiUpload extends Model
{
    use HasFactory;
    protected $table = 'pragati_uploads';

    protected $guarded = ['*'];

    protected $fillable = [
       'record_id',
       'file_path',
       'file_name',
       'user_id'
    ];

    public function VIPReference()
    {
        return $this->belongsTo(Pragati::class);
    }
}
