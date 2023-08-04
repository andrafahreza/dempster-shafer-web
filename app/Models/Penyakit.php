<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penyakit extends Model
{
    use HasFactory;

    protected $table     = 'penyakit';
    public $primaryKey   = 'id';
    protected $keyType   = 'string';
    public $incrementing = false;

    protected $fillable  = [
        'id',
        'kode_penyakit',
        'nama_penyakit',
        'solusi',
    ];
}
