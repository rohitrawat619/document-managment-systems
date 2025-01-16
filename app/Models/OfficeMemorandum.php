<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfficeMemorandum extends Model
{
    use HasFactory;

    protected $table = 'office_memorandum';

    protected $guarded = ['*'];
}
