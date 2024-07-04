<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UbahPasswordController extends Controller
{
    public function index()
    {
        //cek auth
        $this->checkAuth([0]);

        $user = User::find(auth()->user()->user_id);

        return view('ubah_password')
            ->with('user', $user);
    }

    public function action(Request $request)
    {
        $user = User::find(auth()->user()->id_user);

        $validator = Validator::make($request->all(), [
            'old_password' => 'required_with:password',
            'password' => 'required|confirmed|min:8',
        ], [
            'old_password.required_with' => 'Password lama tidak boleh kosong',
            'password.required' => 'Password baru tidak boleh kosong',
            'password.min' => 'Password baru minimal 8 karakter',
            'password.confirmed' => 'Konfirmasi password baru tidak sama dengan password lama',
        ]);

        if ($validator->fails()) {
            $errors = [];
            foreach ($validator->errors()->all() as $error) {
                $errors[] = $error;
            }
            return $this->setResponse(false, "Validation Error", $errors);
        }

        //check old password
        if (!password_verify($request->old_password, $user->password)) {
            return $this->setResponse(false, "Password lama salah");
        }

        $user->password = bcrypt($request->password);

        $user->save();

        return $this->setResponse(true, "Sukses mengubah password");
    }
}
