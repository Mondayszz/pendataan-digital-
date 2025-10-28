<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penduduk extends Model
{
    protected $fillable = [
        'nama',
        'nik',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'pekerjaan',
        'status_perkawinan',
        'agama',
        'pendidikan',
        'jaga',
        'kk_id',
        'status_keluarga',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    /**
     * Get the age attribute.
     *
     * @return int|null
     */
    public function getUmurAttribute()
    {
        return $this->tanggal_lahir ? $this->tanggal_lahir->age : null;
    }

    public function kk()
    {
        return $this->belongsTo(Kk::class);
    }
}
