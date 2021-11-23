<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function store(Request $request) {

        $this->validateUserInput($request, 'add');

        // create new user account

        $user = new User();
        $user->name = $this->trimInputs($request->name);
        $user->email = $this->trimInputs($request->email);
        $user->password = Hash::make($this->trimInputs($request->password));

        if($user->save()) {
            return response()->json([
                'message' => 'User Successfully Added.'
            ], 200);
        }

        return response()->json([
            'err_msg' => 'There was an Error Encountered'
        ], 401);
    }

    public function trimInputs($input) {

        $user_input = trim($input);

        return $user_input;
    }

    public function validateUserInput(Request $request, $action) {

        $arr = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ];

        if($action === 'update') {
            unset($arr['password'], $arr['confirmation'], $arr['email']);
        }

        $request->validate($arr);

    }
}
