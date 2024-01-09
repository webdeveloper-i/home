<?php

namespace App\Models;

use App\Models\Crm\BusinessPermission;
use App\Models\Crm\PublisherResourceUser;
use App\Models\Crm\UserUniversity;
use App\Models\Resources\Media;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Plank\Mediable\Mediable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;
    use SoftDeletes;
    use Mediable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    const STATUS_NOT_CONFIRMED = -1; //email not confirmed
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    const ROLE_ADMIN = "admin";
    const ROLE_USER = "user";

    const VERIFY_TIME = 300; //300 sekund

    public $currentPassword;
    public $passwordRepeat;
    protected $fillable = [
        'username',
        'firstname',
        'surname',
        'birth_date',
        'password',
        'role',
        'status',
        'created_by',
        'updated_by',
        'deleted_by',
        'permission_group_id',
        'verify_code',
        'verify_code_expire',
        'profile_img',
        'show_password',
        'phone',
        'bio',
        'device_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password','show_password'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function permission_group()
    {
        return $this->belongsTo('App\Models\Crm\PermissionGroup');
    }


    public function avatar_img()
    {
        return $this->belongsTo(Media::class,'profile_img','id');
    }

    public function setBirthDateAttribute($date)
    {
        return $this->attributes['birth_date'] = Carbon::createFromFormat('d.m.Y', $date)->format('Y-m-d');
    }

    public function getBirthDateAttribute($date)
    {
        return $date ? Carbon::createFromFormat('Y-m-d', $date)->format('d.m.Y') : '';
    }

    public static function mediaUrl($user)
    {
        foreach ($user as $i => $item) {
            $user[$i]->avatar = $item->getMedia('avatar')->first() ? url(
                Storage::url(
                    $item->getMedia('avatar')->first()->directory . '/' .
                    $item->getMedia('avatar')->first()->filename . '.' .
                    $item->getMedia('avatar')->first()->extension)
            ) : "";

        }
        return $user;
    }



    public function getCreatedAtAttribute($date)
    {
        return $date ? Carbon::parse($date)->format('d.m.Y H:i:s') : '';
    }

    public function getUpdatedAtAttribute($date)
    {
        return $date ? Carbon::parse($date)->format('d.m.Y H:i:s') : '';
    }

    public function getDeletedAtAttribute($date)
    {
        return $date ? Carbon::parse($date)->format('d.m.Y H:i:s') : '';
    }

    public function getFullName()
    {
        return strtoupper(trim($this->surname . ' ' . $this->firstname . ' ' . $this->patronymic));
    }

    public function scopeSorting($query = null,Request $request){

        if ($request->has('sort_direction')) {
            $query->orderBy($request->input('sort_direction'), $request->input('sort'));
        } else{
            $query->orderBy('users.created_at', 'DESC');
        }

        return $query;
    }

    public function publisher_resource_user()
    {
        return $this->hasMany(PublisherResourceUser::class, 'user_id');
    }
}
