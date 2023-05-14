<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Mchev\Banhammer\Traits\Bannable;

class Student extends Authenticatable
{
    use Bannable, HasApiTokens, HasFactory, Notifiable;

    protected $guard = 'student';

    protected $fillable = [
        'fullname',
        'matric_no',
        'department_id',
        'level_id',
        'password'
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

    public function getAuthPassword()
    {
     return $this->password;
    }

    public function department(): BelongsTo {
        return $this->belongsTo(Department::class);
    }


    public function level(): BelongsTo {
        return $this->belongsTo(Level::class);
    }
}