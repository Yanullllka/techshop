<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Поля, которые можно массово заполнять
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // добавили роль
    ];

    /**
     * Скрытые поля
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Преобразование типов
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // 🔹 Связь: пользователь имеет много заказов
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    // 🔹 Связь: пользователь имеет много отзывов
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    // 🔹 Связь: пользователь имеет список избранного
    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }
}