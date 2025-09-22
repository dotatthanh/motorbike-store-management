<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function changePassword(User $user)
    {
        $data = [
            'user' => $user,
        ];

        return view('admin.user.change-password', $data);
    }

    public function updatePassword(ChangePasswordRequest $request, User $user)
    {
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->back()->with('alert-success', 'Đổi mật khẩu thành công!');
    }

    public function profile()
    {

        $data = [
            'user' => auth()->guard('admin')->user(),
        ];

        return view('admin.user.profile', $data);
    }
}
