<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfficeOrderUpload extends Model
{
    use HasFactory;

    protected $table = 'office_order_uploads';

    protected $guarded = ['*'];

    protected $fillable = [
       'record_id',
       'file_path',
       'file_name',
       'user_id'
    ];

    public function officeOrder()
    {
        return $this->belongsTo(OfficeOrder::class);
    }
}
