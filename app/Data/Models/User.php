<?php

namespace App\Data\Models;

use OwenIt\Auditing\Auditable;
use App\Data\Traits\Selectable;
use Illuminate\Notifications\Notifiable;
use Silber\Bouncer\Database\HasRolesAndAbilities;
use Illuminate\Foundation\Auth\User as Authenticatable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use Silber\Bouncer\BouncerFacade as Bouncer;

class User extends Authenticatable implements AuditableContract
{
    use Notifiable, Auditable, Selectable, HasRolesAndAbilities;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
<<<<<<< HEAD
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'congressman_id',
    ];
=======
    protected $fillable = ['name', 'email', 'username'];
>>>>>>> Users roles crud

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    protected $appends = ['roles', 'abilities', 'roles_string'];

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
        return $this->abilities()->get() ? $this->abilities()->get() : [];
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
            $rolesToSync[] = $role['name'];
        }

        Bouncer::sync($this)->roles($rolesToSync);
    }

    public function departament()
    {
        return $this->belongsTo(Departament::class);
    }
}
