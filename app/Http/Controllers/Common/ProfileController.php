<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Resources\FileController;
use App\Mail\ActivateMail;
use App\Models\Crm\PermissionGroup;
use App\Models\Crm\UserUniversity;
use App\Models\Resources\Media;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->media = new FileController();
        $this->user = auth()->user();
    }

    public function updateProfile(Request $request)
    {
        if (!$user = User::where('id', $this->user->id)->first())
            abort(404);

        $validator = Validator::make($request->all(), [
            'firstname' => 'required|string|max:20',
            'surname' => 'required|string|max:20',
            'patronymic' => 'required|string|max:20',
            'phone' => 'nullable|string|max:15',
            'bio' => 'nullable|string|max:255',
            'birth_date' => 'required|date|date_format:d.m.Y',
            'username' => 'required|string|min:4|max:255|email:rfc,dns|unique:users,username,' . $user->id,
            'profile_img' => 'exists:media,id',
        ]);

        if ($validator->fails())
            return $this->errorResponse($validator->messages(), 422);

        $user->update([
            'updated_by' => auth()->id(),
            'bio' => $request->bio,
            'phone' => $request->phone,
            'firstname' => $request->firstname,
            'surname' => $request->surname,
            'patronymic' => $request->patronymic,
            'birth_date' => $request->birth_date,
            'username' => $request->username,
            'orcid'=>$request->orcid,
            'google_scholar_link'=>$request->google_scholar_link,
            'scopus_link'=>$request->scopus_link,
            'web_of_science_link'=>$request->web_of_science_link,
            'linkedin_id_link'=>$request->linkedin_id_link,
            'tg_id_or_link'=>$request->tg_id_or_link,
            'fb_id_or_link'=>$request->fb_id_or_link
        ]);

        if ($request->profile_img) {
            $user->syncMedia($request->profile_img, ['avatar']);
            $this->media->moveFolderImage($request->profile_img, $user->id, 'Profile');
        }

        return $this->successResponse('User profile changed successfully');
    }

    public function changePassword(Request $request)
    {
        if (!$user = User::where('id', $this->user->id)->first())
            abort(404);
        $validator = Validator::make($request->all(), [
            'currentPassword' => 'required|string|max:20',
            'password' => 'required|string|max:20',
            'passwordRepeat' => 'same:password',
        ]);

        if ($validator->fails())
            return $this->errorResponse($validator->messages(), 422);

        if (!Hash::check($request->currentPassword, $user->password)) {
            return $this->errorResponse('Return error with current password is not match', 422);
        } else {
            $user->update([
                'updated_by' => auth()->id(),
                'password' => bcrypt($request->password),
            ]);
            return $this->successResponse('Password changed successfully');
        }
    }


    public function show(Request $request)
    {
        $users = User::
        where([['users.id', $this->user->id]])
            ->with('permission_group.permissions')
            ->select(
                'users.id',
                'users.role',
                'users.username',
                'firstname',
                'surname',
                'patronymic',
                'birth_date',
                'users.permission_group_id',
                'users.status',
                'users.phone',
                'users.orcid',
                'users.google_scholar_link',
                'users.scopus_link',
                'users.web_of_science_link',
                'users.linkedin_id_link',
                'users.tg_id_or_link',
                'users.fb_id_or_link',
                'users.bio',
                'profile_img'
            )
            ->get();

        $users = User::mediaUrl($users);

        return $this->successResponse($users);
    }

    public function getPermissionGroup($id)
    {
        if (!$permission_group = PermissionGroup::select('id', 'name')
            ->with('permissions.permission')
            ->where('id', $id)
            ->first()) {
            return $this->errorResponse('I18nSource not found', 404);
        }

        return $this->successResponse($permission_group);

    }

    public function photo(Request $request)
    {
        if (!$user = User::where('id', $this->user->id)->first())
            abort(404);

        $validator = Validator::make($request->all(), [
            'profile_img' => 'exists:media,id'
        ]);

        if ($validator->fails())
            return $this->errorResponse($validator->messages(), 422);

        $user->update([
            'profile_img' => $request->profile_img ? $request->profile_img : $user->profile_img,
            'updated_by' => auth()->id()
        ]);

        if ($request->profile_img) {
            $user->syncMedia($request->profile_img, ['avatar']);
            $this->media->moveFolderImage($request->profile_img, $user->id, 'Profile');
        }

        return $this->successResponse('Photo removed successfully');

    }
}
