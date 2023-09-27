<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'department_id',
        'birth_date',
        'gender',
        'starting_date',
        'role',
        'status',
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

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function manager()
    {
        return $this->hasOne(Department::class, 'manager_id');
    }

    public function updateUser($user)
    {
        return User::update([
            'name' => $user['name'],
            'email' => $user['email'],
            'birth_date' => $user['birth_date'],
            'gender' => $user['gender'],
            'starting_date' => $user['starting_date'],
            'status' => $user['status'],
            'departmment' => $user['department'],
        ]);
    }
}
