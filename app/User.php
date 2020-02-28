<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    const ADMIN = 0;
    const TUTOR = 1;
    const STUDENT = 2;

    /**
     * @return bool
     */
    public function isTutor()
    {
        return $this->getUserType() === self::TUTOR;
    }

    /**
     * @return bool
     */
    public function isStudent()
    {
        return $this->getUserType() === self::STUDENT;
    }

    /**
     * @return bool
     */
    public function isAdmin()
    {
        return $this->getUserType() === self::ADMIN;
    }

    /**
     * @return int
     */
    public function getUserType()
    {
        return (int)$this->getAttribute('user_type');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','user_type'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
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
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function student()
    {
        return $this->hasOne(Student::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function tutor()
    {
        return $this->hasOne(Tutor::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function district()
    {
        return $this->belongsTo(District::class);
    }
}
