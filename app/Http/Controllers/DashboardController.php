<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Division;
use App\Models\TotalCountModel;   
class DashboardController extends Controller
{
    public function index()
    {
        {
            $totalUsers = User::count();
            $totaldivision = Division::count(); 
            $totalForms = TotalCountModel::getTotalSubmissions(); 

            return view('backend.index', compact('totalUsers', 'totaldivision', 'totalForms'));
        }
    }


}
