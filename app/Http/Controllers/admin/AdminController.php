<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminEdit\EditUserRequest;
use App\Services\admin\AdminService;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    protected AdminService $adminService;

    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }

    public function index()
    {
        try {
            // code...0
            return view('admindashboard.index');
        } catch (\Throwable $th) {
            // throw $th;
            return back()->with('error', 'page not load.');
        }
    }

    public function getuser(Request $request)
    {
        try {
            $name = $request->query('name');
            $users = $this->adminService->getuser($name);

            return $this->success($users, 'Users retrieved successfully.', 200);
        } catch (\Throwable $th) {
            return $this->error($th->getMessage(), 'Failed to retrieve users.', 500);
        }
    }

    public function getdoctor(Request $request)
    {
        try {
            $name = $request->query('name');

            $usersdoctor = $this->adminService->getdoctor($name);

            return $this->success($usersdoctor, 'Users retrieved successfully.', 200);

            return view('admindashboard.doctor', compact('usersdoctor'));
        } catch (\Throwable $th) {
            return $this->error($th->getMessage(), 'Failed to retrieve users.', 500);
        }
    }

    public function show($id)
    {
        try {
            $user = $this->adminService->iduser($id);

            return $this->success($user, 'user details retrived successfully', 200);
        } catch (\Throwable $th) {
            return $this->error($th->getMessage(), 'user not found', 404);
        }
    }

    public function edit(EditUserRequest $request, $id)
    {
        try {
            $updatedata = $this->adminService->updatedata($id, $request->validated());

            return $this->success($updatedata, 'update successfully', 200);
        } catch (\Throwable $th) {
            // throw $th;
            return $this->error($th->getMessage(), 'server error.', 500);
        }
    }

    public function destroy($id)
    {
        try {
            $this->adminService->deleteuser($id);

            return $this->success(null, ' User deleted successfully', 200);
        } catch (\Throwable $th) {
            return $this->error($th->getMessage(), 'fail to delete user.', 400);
        }
    }

    public function getappoiment($id)
    {
        try {
            $appointment = $this->adminService->getappointment($id);

            // dd($value);
            return $this->success($appointment, 'Appointment details retrieved successfully.', 200);
        } catch (\Throwable $th) {
            return $this->error($th->getMessage(), 'no appoiment', 500);
        }
    }
}
