<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable , HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $with= ['roles'];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected function getActionAttribute(): string
    {
        $action = '<a href="' . route('admin.users.edit', $this->attributes['id']) . '" class="action"><i class="fa-regular fa-pen-to-square"></i></a>';

        $action .= '<a href="javascript:void(0);" onClick="deleteHandler(' . $this->attributes['id'] . ');" class="ml-2 action text-danger"><i class="fa-solid fa-trash-can"></i></a>';
        return $action;
    }

    // protected function  getRoleAttribute(){
    //     // $roles =  Role::all();

    //     // dd($this->attributes->);
    //     // return $role;
    // }
}
