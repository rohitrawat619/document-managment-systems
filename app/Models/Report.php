<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Report extends Model
{
    public static function getTableCounts()
    {
        $tables = [
            'office_memorandum', 
            'office_order', 
            'notification', 
            'letter', 
            'guidelines'
        ];

        $data = [];

        foreach ($tables as $table) {
            $count = DB::table($table)->count();
            $data[] = [
                "label" => ucfirst($table),
                "value" => $count
            ];
        }

        return $data;
    }
}
