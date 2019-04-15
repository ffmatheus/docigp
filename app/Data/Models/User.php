<?php

namespace App\Data\Models;

use OwenIt\Auditing\Auditable;
use App\Data\Traits\Selectable;
use Illuminate\Notifications\Notifiable;
use Silber\Bouncer\Database\HasRolesAndAbilities;
use Illuminate\Foundation\Auth\User as Authenticatable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use Silber\Bouncer\BouncerFacade as Bouncer;
use Illuminate\Support\Facades\Gate;
use Silber\Bouncer\Database\Role as BouncerRole;

class User extends Authenticatable implements AuditableContract
{
    use Notifiable, Auditable, Selectable, HasRolesAndAbilities;

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

        $array = $this->getRoles()->toArray();

        sort($array);

        foreach ($array as $role) {
            if ($role == end($array)) {
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

    public function getAssignableRolesAttribute()
    {
        return collect(BouncerRole::all())->filter(function ($item, $key) {
            return $this->can('assign:' . $item['name']);
        });
    }
}
