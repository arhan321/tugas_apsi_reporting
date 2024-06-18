<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fakultas extends Model 
{
    use SoftDeletes, HasFactory;

    protected $table = 'fakultas';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    
    protected $fillable = [
        'nama_fakultas',
        'kode_fakultas',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
    
    public function mahasiswa()
    {
        return $this->hasMany(Jurusan::class, 'fakultas_id', 'id');
    }

    public function jurusan()
    {
        return $this->hasMany(Jurusan::class, 'fakultas_id', 'id');
    }
}
