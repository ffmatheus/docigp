<?php

namespace App\Data\Models;

use App\Data\Models\Traits\Selectable;
use FontLib\Table\Type\name;
use OwenIt\Auditing\Auditable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use Silber\Bouncer\Database\HasRolesAndAbilities;

class User extends Authenticatable implements AuditableContract
{
    use Notifiable, Auditable, Selectable, HasRolesAndAbilities;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'username'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    protected $appends = ['roles', 'abitilites', 'roles_string'];

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
        return collect($this->joins);
    }

    public function getRolesStringAttribute()
    {
        $string = '';
        $array = $this->getRoles();
        foreach ($array as $role) {
            if (!($role === end($array))) {
                $string .= $role . ' ';
            } else {
                $string .= $role . ', ';
            }
        }
        return $string;
    }
}
