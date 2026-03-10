<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Services\admin\AdminService;
use Illuminate\Http\Request; 

class AdminController extends Controller
{
    protected $adminService;

    public function __construct(AdminService $adminService){
        $this->adminService = $adminService;
    }

    public function getuser(Request $request){
        try {
            $role = $request->query('role'); 
            
            $users = $this->adminService->getuser($role);

            return view('admindashboard.index', compact('users'));
        } catch (\Throwable $th) {
            return back()->with('error', 'Something went wrong!');
        }
    }
}
