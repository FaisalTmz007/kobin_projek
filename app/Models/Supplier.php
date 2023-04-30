<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Role;

class Supplier extends Authenticatable
{
    use HasFactory;

    protected $table = 'supplier';
    protected $primaryKey = 'id_supplier';

    protected $fillable = ['name', 'username', 'password', 'telp', 'alamat', 'role', 'gambar'];

    public function ambilRole()
    {
        return $this->belongsTo(Role::class, 'role', 'id_role');
    }
}
