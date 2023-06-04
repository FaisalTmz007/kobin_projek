<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kas extends Model
{
    use HasFactory;

    protected $table = 'kas';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = ['tanggal', 'jumlah_masuk', 'jumlah_keluar', 'keterangan', 'id_owner', 'id_supplier'];
}
