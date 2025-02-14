<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $guarded = ['*'];
    
    protected $fillable = [
        'name',
        'designation_id',
        'permission_id'
        
    ];
    

    public function permission()
    {
        return $this->belongsTo(Permission::class);
    }
}
