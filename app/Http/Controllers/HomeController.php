<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use App\Models\Division;
use App\Models\TotalCountModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $role = Role::find($user->role_id);

        if ($role && !empty($role->permission_id)) {
            $permissions = explode(',', $role->permission_id); // Convert CSV to array
            Session::put('user_permissions', $permissions);
        } else {
            $permissions = []; // Default empty permissions array
        }
        $totalUsers = User::count();
            $totaldivision = Division::count();

            $totalForms = TotalCountModel::getTotalSubmissions();

            return view('backend.index', compact('totalUsers', 'totaldivision', 'totalForms'));

        //return view('backend.index');
    }

    public function error404()
    {
        return view('errors.404');
    }

}
