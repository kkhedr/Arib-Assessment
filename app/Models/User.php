<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laratrust\Contracts\LaratrustUser;
use Laratrust\Traits\HasRolesAndPermissions;
use App\Traits\ImageHandler;
use Laravel\Sanctum\HasApiTokens;
use App\Filter\Filterable;

class User extends Authenticatable implements LaratrustUser
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRolesAndPermissions, ImageHandler, HasApiTokens, Filterable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'salary',
        'image',
        'manager_id',
        'department_id',
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

    protected $appends = [
         'full_name'
    ];

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

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->image = $model->setFile($model->image, 'uploads/employee');
        });
        static::updating(function ($model) {
            $model->image = $model->setFile($model->image, 'uploads/employee');
        });
    }


    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    /**
     * Get the employees under the same manager.
     */
    public function employees()
    {
        return $this->hasMany(User::class, 'manager_id');
    }

     /**
     * Get the employees under the same manager.
     */
    public function tasks()
    {
        return $this->hasMany(AssignTask::class, 'employee_id', 'id');
    }

       /**
     * getImagePathAttribute function
     *
     * @return string
     */
    public function getImagePathAttribute(){
        return $this->getFile($this->attributes['image']);
    }

    public function getFullNameAttribute(){
        return $this->first_name.' '.$this->last_name;
    }

}
