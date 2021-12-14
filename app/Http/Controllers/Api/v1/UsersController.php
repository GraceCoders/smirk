<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;

/**
 * Traits
 */

use App\Traits\OutputTrait;

/**
 * Models
 */

use App\Models\User;
use App\Models\Device;
use Illuminate\Auth\Events\Registered;

class UsersController extends Controller
{
    use OutputTrait;

    public function validateLogin()
    {
        return [
            'phone' => ['required', 'string', 'max:255']
        ];
    }
    /**
     * signUp
     *
     * @param  Request $request
     * @param  User $user
     * @return void
     */
    public function login(Request $request, User $user)
    {
        try {
            $this->validateRequest($request->all(), $this->validateLogin());
            $arrayData = $request->all();
            $user->fill($arrayData)->save();
            $userDetail = $this->loginUser($user);
            event(new Registered($user));
            $this->sendSuccessResponse(trans("Messages.LoggedInSuccessful"), $userDetail->toArray());
        } catch (Exception $ex) {
            $this->sendErrorOutput($ex);
        }
    }
    public function loginUser(User $user): User
    {
        $request = request();
        $device = new Device();
        $device->createOrUpdateDeviceToken($user, $request->only("device_id", "notification_token", "device_type"));
        $userDetails = User::getUserDetails($user->id);
        $userDetails->token = $user->createToken(env("AUTH_TOKEN_NAME"))->plainTextToken;
        return $userDetails;
    }
}