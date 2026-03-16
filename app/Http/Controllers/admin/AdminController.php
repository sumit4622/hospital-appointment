<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Services\admin\AdminService;
use Illuminate\Http\Request;
use App\Http\Requests\AdminEdit\EditUserRequest;

class AdminController extends Controller
{
    protected $adminService;

    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }

    public function getuser(Request $request)
    {
        try {
            $role = $request->query('role');

            $users = $this->adminService->getuser($role);

            return view('admindashboard.index', compact('users'));
        } catch (\Throwable $th) {
            return back()->with('error', 'Something went wrong!');
        }
    }

    public function show($id)
    {
        try {
            $user = $this->adminService->iduser($id);
            return view('admindashboard.edit', compact('user'));
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function edit(EditUserRequest $request, $id)
    {
        try {
            //code...
            $this->adminService->updatedata($id, $request->validated());

            return redirect()->route('admin.dashboard')->with('success', 'update succesfull.');
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('success', 'user update sucessfully.');
        }
    }

    public function destory($id)
    {
        try {
            $this->adminService->deleteuser($id);
        } catch (\Throwable $th) {
            return redirect()->route('admin.dashboard')->with('success', 'User delete');
        }
    }

    public function getappoiment($id)
    {
        try {
            $value = $this->adminService->getappointment($id);
            // dd($value);
            return view('admindashboard.appoiments', compact('value'));
        } catch (\Throwable $th) {
            return redirect()->route('admin.dashboard')->with('success', 'no appoiment');
        }
    }
}
