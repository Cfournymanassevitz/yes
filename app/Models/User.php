<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasUuids, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'email',
        'payment_adress',
        'password',
        'phone',
        'delivery_adress',
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

    public function hasPermission($permission)
    {
        // Ici, vous vérifiez si l'utilisateur a la permission donnée.
        // Vous devrez implémenter la logique de cette vérification en fonction de la façon dont vous stockez les permissions dans votre base de données.
        // Par exemple, si vous avez une table `permissions` et une table pivot `user_permission`, vous pourriez faire quelque chose comme ceci :
        return $this->permissions()->where('name', $permission)->exists();
    }
    public function stores():HasMany
    {
        return $this->hasMany(Store::class);
    }
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
