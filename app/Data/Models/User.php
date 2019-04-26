<?php

namespace App\Data\Models;

use App\Data\Traits\Filterable;
use App\Data\Traits\Eventable;
use App\Events\UserCreated;
use App\Support\Constants;
use function foo\func;
use OwenIt\Auditing\Auditable;
use App\Data\Traits\Selectable;
use Illuminate\Notifications\Notifiable;
use Silber\Bouncer\BouncerFacade as Bouncer;
use App\Notifications\UserWelcomeNotification;
use App\Notifications\ResetPasswordNotification;
use Silber\Bouncer\Database\Role as BouncerRole;
use Silber\Bouncer\Database\HasRolesAndAbilities;
use Illuminate\Foundation\Auth\User as Authenticatable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class User extends Authenticatable implements AuditableContract
{
    use Notifiable,
        Auditable,
        Selectable,
        HasRolesAndAbilities,
        Filterable,
        Eventable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'congressman_id',
    ];

    protected $orderBy = ['name' => 'asc'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function boot()
    {
        parent::boot();

        static::created(function (User $model) {
            if (static::$modelEventsEnabled) {
                event(new UserCreated($model));
            }
        });
    }

    /**
     * @return array
     */
    public function getJoins()
    {
        return coollect($this->joins);
    }

    public function getRolesAttribute()
    {
        return $this->roles()->get() ? $this->roles()->get() : [];
    }

    public function getAbilitiesAttribute()
    {
        return $this->getAbilities()->pluck('name');
    }

    public function getRolesStringAttribute()
    {
        $string = '';

        $array = $this->roles
            ->transform(function ($item, $key) {
                return $item['title'];
            })
            ->sort();

        foreach ($array as $role) {
            if ($role == $array->last()) {
                $string .= $role;
            } else {
                $string .= $role . ', ';
            }
        }
        return $string;
    }

    public function syncRoles($roles_array)
    {
        $rolesToSync = [];

        foreach ($roles_array as $role) {
            $rolesToSync[] = $role['id'];
        }

        Bouncer::sync($this)->roles(
            BouncerRole::whereIn('id', $rolesToSync)->get()
        );
    }

    public function departament()
    {
        return $this->belongsTo(Departament::class);
    }

    public function congressman()
    {
        return $this->belongsTo(Congressman::class);
    }

    public function getAssignableRolesAttribute()
    {
        return collect(BouncerRole::all())->filter(function ($item, $key) {
            return $this->can('assign:' . $item['name']) &&
                $item['name'] != Constants::ROLE_CONGRESSMAN;
        });
    }

    /**
     * Send the password reset notification.
     *
     * @param string $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    public function getOrderBy()
    {
        return coollect($this->orderBy);
    }

    public function sendWelcomeMessage()
    {
        $this->notify(new UserWelcomeNotification());
    }
}
