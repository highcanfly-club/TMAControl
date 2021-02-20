<?php

namespace App\Models;

use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    protected static function booted()
    {
        static::created(function ($user) {
            //by default each new user has the viewer role
            $role = Role::where('name', '=', 'viewer')->first();
            $user->roles()->attach($role);
        });
    }

    /**
     * App\Models\Role relation.
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function hasRole($roleId)
    {
        if (is_string($roleId))
        {
            try
            {
                $roleId = Role::where('name',$roleId)->first()->id;
            }catch (\Exception $e) {
                return false;
            }
            
        }
        if ($this->roles->find($roleId))      //admin id=1
        {
            return true;
        }

        return false;
    }

    public function hasAdminRole()
    {
        return $this->hasRole(1);
    }

    public function hasViewerRole()
    {
        return $this->hasRole(2);
    }

    public function hasSetterRole()
    {
        return $this->hasRole(3);
    }
}
