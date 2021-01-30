<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Password;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\ResetPasswordRequest;
use Illuminate\Auth\Events\PasswordReset;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(15);
        return Response($users,200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegisterUserRequest $request)
    {
        $validated = $request->validated();
        return User::create($request->only(
            [
                'name',
                'cellphone',
                'email',
                'password',
                'username',
                'birthdate'
            ]
        ));
    }

    public function login(Request $request)
    {
        $credentials = $request->only(['email','password']);
        $token = auth()->attempt($credentials);
        if(empty($token))
            return response()->json(['Error'=>'User or password incorrect'],401);
        
        return response()->json(['Token'=>$token],200);
    }

    public function register(RegisterUserRequest $request)
    {
        $validated = $request->validated();
        User::create($request->all());
    }

    public function forgotPassword(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $status = Password::sendResetLink(
            $request->only('email')
        );
        return $status === Password::RESET_LINK_SENT
                ? response(['status' => __($status)],200)
                : response()->withErrors(['email' => __($status)],200);
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        $validated = $request->validated();
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) use ($request) {
                $user->forceFill([
                    'password' => $password
                ])->save();
                event(new PasswordReset($user));
            }
        );
        return $status == Password::PASSWORD_RESET
                ? response(['status' => __($status)],200)
                : response()->withErrors(['email' => [__($status)]]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return response()->json($user,200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $validated = $request->validated();
        $user = User::find($id);
        $user->update($request->only(
            [
                'name',
                'cellphone',
                'birthdate'
            ]
        ));
        return response()->json($user,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return response()->json(['Deleted'=>'Successfully deleted'],200);
    }
}
