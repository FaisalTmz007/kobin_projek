<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Role;

class Owner extends Authenticatable
{
    use HasFactory;

    protected $table = 'owner';
    protected $primaryKey = 'id_owner';

    protected $fillable = ['name', 'username', 'password', 'telp', 'alamat', 'role', 'gambar'];

    public function getRole()
    {
        return $this->belongsTo(Role::class, 'role', 'id_role');
    }
}
