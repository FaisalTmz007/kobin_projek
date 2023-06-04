<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResetPassword extends Model
{
    use HasFactory;

    protected $table = 'resetPassword';
    protected $primaryKey = 'id';

    protected $fillable = ['passwordBaru', 'fk_owner', 'fk_supplier'];
}
