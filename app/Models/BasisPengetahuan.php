<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BasisPengetahuan extends Model
{
    use HasFactory;

    protected $table     = 'rule';
    public $primaryKey   = 'id';
    protected $keyType   = 'string';
    public $incrementing = false;

    protected $fillable  = [
        'id',
        'id_penyakit',
        'id_gejala',
    ];

    public function penyakit(){
        return $this->belongsTo(Penyakit::class, "id_penyakit");
    }

    public function gejala(){
        return $this->belongsTo(Gejala::class, "id_gejala");
    }
}
