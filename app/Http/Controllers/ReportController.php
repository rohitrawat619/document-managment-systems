<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController  extends Controller
{
    public function getCounts()
    {
        try {
            $tables = ['office_memorandum', 'office_order', 'notification', 'letter', 'guidelines','records_of_discussion','minutes_of_metting','achievenment','recruitment','presentations','gazette_notification'];
            $labels = ['office memorandum', 'office order', 'notification', 'letter', 'guidelines','Records of discussion','Minutes of Metting','Achievenment','Recruitment','Presentations','Gazette Notification'];
            
            $data = [];
            
            foreach ($tables as $index => $table) {
                $count = DB::table($table)->count();
                $data[] = [
                    "label" => ucfirst($labels[$index]), // Use the corresponding label
                    "value" => $count
                ];
            }

            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
