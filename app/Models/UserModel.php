<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Casts\Attribute;

class UserModel extends Authenticatable implements JWTSubject
{
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
    
    use HasFactory;
    
    protected $table = 'm_user'; // mendefinisikan nama tabel yang digunakan oleh model ini
    protected $primaryKey = 'user_id'; // mendefinisikan primary key dari tabel yang digunakan
    protected $fillable = ['level_id', 'username', 'nama', 'password','image'];

    protected $hidden = ['password']; // jangan ditampilkan saat select

    protected $casts = ['password' => 'hashed']; //casting password agar otomatis di hash

     /**
     * Relasi ke tabel level
     */
    public function level(): BelongsTo
    {
        return $this->belongsTo(LevelModel::class, 'level_id', 'level_id');
    }

    /**
     * Mendapatkan nama role
     */
    public function getRoleName(): string
    {
        return $this->level->level_nama;
    }

    /**
     * Cek apakah user memiliki role tertentu
     */
    public function hasRole($role): bool
    {
        return $this->level->level_kode == $role;
    }

    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn($image) => url("/storage/posts/{$image}")
        );
    }

    /**
     * Mendapatkan kode role
     */
    public function getRole()
    {
        return $this->level->level_kode;
    }

    public function getProfilePictureUrl()
    {
        return $this->image
            ? asset($this->image) // karena langsung di public/
            : asset('adminlte/dist/img/user2-160x160.jpg');
    }
}
