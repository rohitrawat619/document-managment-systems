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
use Illuminate\Support\Facades\Hash;

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
        // Check if the user needs to change their password
        if ($user->is_pwd_changed == 0) {
            return redirect()->route('admin.password.change');
        }
        if ($role && !empty($role->permission_id)) {
            $permissions = explode(',', $role->permission_id); // Convert CSV to array

            Session::put('user_permissions', $permissions);
            Session::save();

        } else {
            $permissions = []; // Default empty permissions array
        }
            $totalUsers = User::count();
            $totaldivision = Division::count();

            $totalForms = TotalCountModel::getTotalSubmissions();

            return view('backend.index', compact('totalUsers', 'totaldivision', 'totalForms'));
    }

    public function showChangePasswordForm()
    {
        return view('auth.change-password'); // Create this view file
    }

    public function changePassword(Request $request)
    {
    $request->validate([
        'password' => 'required|min:6|confirmed',
    ]);

    $user = Auth::user();

    if (!$user) {
        return redirect()->route('login')->with('error', 'User not authenticated.');
    }

    $user->update([
        'password' => Hash::make($request->password),
        'is_pwd_changed' => 1,
    ]);

    session()->flash('success', 'Password Changed Successfully,Now You Can login With Your New Password');
    Auth::logout();
    return redirect()->route('admin.login');
    }

    public function error404()
    {
        return view('errors.404');
    }

}
