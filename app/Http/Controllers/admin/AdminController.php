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

    public function index()
    {
        try {
            //code...0
            return view('admindashboard.index');
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('error', 'page not load.');
        }
    }

    public function getuser(Request $request)
    {
        try {
            $name = $request->query('name');
            $users = $this->adminService->getuser($name);

            // Return JSON instead of view()
            return response()->json(
                [
                    'status' => 'success',
                    'data' => $users,
                ],
                200,
            );
        } catch (\Throwable $th) {
            return response()->json(
                [
                    'status' => 'error',
                    'message' => 'Failed to retrieve users.',
                ],
                500,
            );
        }
    }

    public function getdoctor(Request $request)
    {
        try {
            $name = $request->query('name');

            $usersdoctor = $this->adminService->getdoctor($name);

            return view('admindashboard.doctor', compact('usersdoctor'));
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
