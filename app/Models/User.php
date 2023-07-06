<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Casts\Attribute;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'salary',
        'role',
        'manger_id',
        'department_id',
        'email',
        'password',
    ];

    protected $appends = ['full_name'];
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
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    protected function fullName(): Attribute
    {
        return new Attribute(
            get: fn () => $this->first_name .' '. $this->last_name ,
        );
    }
 
    public function manger(): BelongsTo
    {
        return $this->belongsTo($this);
    }
    public function employess(): HasMany
    {
        return $this->hasMany($this, 'manger_id');
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class, 'manger_id');
    }

    public function assignTasks(): HasMany
    {
        return $this->hasMany(Task::class, 'employee_id');
    }
}
