<?php

namespace App\Http\Controllers\Crm;

use App\Http\Controllers\Resources\FileController;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->media = new FileController();
        $this->admin = auth()->user();

    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function view(Request $request)
    {
        $user = User::select(
            'users.id',
            'users.role',
            'users.username',
            'users.birth_date',
            'users.firstname',
            'users.surname',
            'users.patronymic',
            'users.permission_group_id',
            'users.status',
            'profile_img'
        )
            ->with('permission_group',function ($query) use ($request){
                $query->select(
                    'id',
                    'name'
                )->with('permissions',function($query) use ($request){
                    $query->select(
                        'permission_group_id',
                        'permission_id'
                    )->with('permission');
                });
            })
            ->where('id', $this->admin->id)
            ->get();

        $user = User::mediaUrl($user);

        return $this->successResponse($user);
    }

    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|string|max:18',
            'passwordRepeat' => 'same:password'
        ]);

        if ($validator->fails())
            return $this->errorResponse($validator->messages(), 422);

        $this->admin->update([
            'updated_by' => auth()->id(),
            'password' => bcrypt($request->password)
        ]);

        $result = 'Password changed successfully';

        return $this->successResponse($result);
    }

    public function photo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'profile_img' => 'exists:media,id'
        ]);

        if ($validator->fails())
            return $this->errorResponse($validator->messages(), 422);

        $this->admin->update([
            'profile_img' => $request->profile_img ? $request->profile_img : $this->admin->profile_img,
            'updated_by' => auth()->id()
        ]);

        if ($request->profile_img) {
            $this->admin->syncMedia($request->profile_img, ['avatar']);
            $this->media->moveFolderImage($request->profile_img, $this->admin->id, 'Profile');
        }

        return $this->successResponse('Photo added successfully');
    }
}
