<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function index(){

        $data = [
            'user' => User::all()
        ];
        return view('user.index', $data);
    }
    
    public function store(UserRequest $request)
{
    $data = $request->validated();
    
    // Hash password
    $data['password'] = Hash::make($data['password']);
    
    $user = User::create($data);

    if (!$user) {
        return response()->json([
            'message' => 'Failed create user'
        ], 403);
    }

    return response()->json([
        'message' => 'User created'
    ], 201);
}

    public function delete(string $username): JsonResponse
    {
        $username = User::query()->find($username)->delete();

        if ($username):
            //Pesan Berhasil
            $pesan = [
                'success' => true,
                'pesan' => 'Data user berhasil dihapus'
            ];
        else:
            //Pesan Gagal
            $pesan = [
                'success' => false,
                'pesan' => 'Data gagal dihapus'
            ];
        endif;
        return response()->json($pesan);
    }
    public function update(UserUpdateRequest $request, $username)
{
    $data = $request->validated();
    dd($data);
    $user = User::where('username', $username)->first();

    if (!$user) {
        return response()->json([
            'message' => 'User not found'
        ], 404);
    }

    // Jika password ada dalam data yang dikirimkan, hash password
    if (isset($data['password'])) {
        $data['password'] = Hash::make($data['password']);
    }

    $user->update($data);

    return response()->json([
        'message' => 'User updated'
    ], 200);
}

}
