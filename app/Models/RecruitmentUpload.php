<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecruitmentUpload extends Model
{
    use HasFactory;
    protected $table = 'recruitment_upload';

    protected $guarded = ['*'];

    protected $fillable = [
       'record_id',
       'file_path',
       'file_name',
       'user_id'
    ];

    public function recruitment()
    {
        return $this->belongsTo(RecruitmentModel::class);
    }
}
