<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use App\Models\Users;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,  HasUlids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'country',
        'state',
        'gender',
        'age',
    ];

    public function age25(){
        return User::where('age', '<', 25)->count();
    }

    public function age25to40(){
        return User::where('age', '>', 25)->where('age', '>', 41)->count();
    }
}
