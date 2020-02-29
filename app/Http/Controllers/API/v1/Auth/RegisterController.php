<?php

namespace App\Http\Controllers\API\v1\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\UserService\CreateUser\CreateUser;
use App\Services\UserService\CreateUser\ValueObjects\CreateUserValueObject;
use App\Services\UploadFileService\UploadImageService;
use Illuminate\Auth\Events\Registered;



class RegisterController extends Controller
{
    public function register(RegisterRequest $request, CreateUser $createUser,UploadImageService $imageService)
    {
        $data = $request->all();

        $valueObject = new CreateUserValueObject();
        $valueObject->setName($data['name'])
            ->setMobile($data['mobile'])
            ->setEmail($data['email'])
            ->setPassword($data['password']);

        if($request->hasFile('image'))
            $valueObject->setImage( $imageService->upload('image')->getFileAddress());
        $user = $createUser->create($valueObject);
        event(new Registered($user));

        $credentials = $request->all(['email', 'password']);

        $token = auth('api')->attempt($credentials);

        return response()->json([
            'message' => 'User is registered successfully',
            'token'   => $token,
            'type'    => 'bearer',
            'expires' => auth('api')->factory()->getTTL() * 60, // time to expiration
        ]);
    }


}
