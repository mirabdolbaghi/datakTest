<?php

namespace App\Http\Controllers\API\v1\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\ResetPassword;
use App\Services\UploadFileService\UploadImageService;






class UserController extends Controller
{

    public function resetPassword(ResetPassword $request)
    {
        $data = $request->all();

        $user = $request->user();

        $user->password = Hash::make($data['password']);

        $user->save();

        event(new PasswordReset($user));

        auth('api')->invalidate();

        return response()->json([
            'message' => 'User password is changed'
        ]);
    }
    public function updateProfile(Request $request,UploadImageService $imageService)
    {
        $data = $request->all();

        $user = $request->user();

        if(isset($data['name']))
            $user->name = $data['name'];
        if($request->hasFile('image'))
            $user->image = $imageService->upload('image')->getFileAddress();

        $user->save();


        return response()->json([
            'message' => 'profile Updated'
        ]);
    }
}
