<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    use HasFactory;

    protected $fillable = ['nama_ruangan','gedung'];

    protected $table = 'ruangans';
    protected $primaryKey = 'id';
}
