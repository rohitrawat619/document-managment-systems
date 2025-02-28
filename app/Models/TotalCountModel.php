<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class TotalCountModel extends Model
{
    public static function getTotalSubmissions()
    {
        $tables = ['office_memorandum', 'office_order', 'notification', 'letter', 'guidelines','records_of_discussion','minutes_of_metting','achievenment','recruitment','presentations','gazette_notification']; 
        $total = 0;

        foreach ($tables as $table) {
            $total += DB::table($table)->count();
        }

        return $total;
    }
}
