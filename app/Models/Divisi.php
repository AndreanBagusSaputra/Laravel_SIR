<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Divisi extends Model
{
    use HasFactory;
    protected $table = 'divisi'; // Pemangilan nama table
    protected $primarykey = 'id'; // Pemangilan id atau premary key
    protected $fillable = ['nama']; // Pemangilan kolam nama

    public function pegawai(){
        return $this -> hasMany(Pegawai::class); // Memangil relasi antara table divisi dengan table pegawai
    }
}
