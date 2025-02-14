<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuidelinesUpload extends Model
{
    use HasFactory;

    protected $table = 'guideline_uploads';

    protected $guarded = ['*'];

    protected $fillable = [
       'record_id',
       'file_path',
       'file_name',
       'user_id'
    ];

    public function guidelines()
    {
        return $this->belongsTo(Guidelines::class);
    }
}
