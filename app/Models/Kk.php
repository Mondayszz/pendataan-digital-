<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kk extends Model
{
    protected $fillable = [
        'kepala_keluarga',
        'alamat',
        'jaga',
    ];

    public function penduduks()
    {
        return $this->hasMany(Penduduk::class);
    }
}
