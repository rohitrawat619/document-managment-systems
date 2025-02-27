<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GazetteModel extends Model
{
    use HasFactory;
    protected $table = 'gazette_notification';

    protected $guarded = ['*'];

    protected $fillable = [
        'notification_no',
        'title',
        'date_of_notification',
        'issuer_name',
        'user_id',
        'issuer_designation',
        'division_id',
        'date_of_upload',
        'uploaded_by',
         'keyword'
    ];

    public function uploads()
    {
        return $this->hasMany(OfficeMemorandumUpload::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
}
