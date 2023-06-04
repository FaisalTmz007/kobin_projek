<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jenis_Paket extends Model
{
    use HasFactory;

    protected $table = 'jenis_paket';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = ['jenis_paket', 'harga', 'durasi/bulan'];
}

