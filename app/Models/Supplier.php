<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = ['nama_supplier','telepon_supplier'];

    protected $table = 'suppliers';
    protected $primaryKey = 'id';
}
