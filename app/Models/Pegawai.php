<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Pegawai extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = ['users_id', 'nama', 'nip_nik', 'jabatan_akademik', 'no_telepon', 'email', 'foto'];


    protected $table = 'pegawais';
    protected $primaryKey = 'id';
    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

    public function peminjamen()
    {
        return $this->hasMany(Peminjaman::class, 'pegawais_id');
    }

    public function pengembalians()
    {
        return $this->hasMany(Pengembalian::class, 'pegawais_id');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->logOnlyDirty()
            ->useLogName('Pegawai')
            ->dontSubmitEmptyLogs()
            ->setDescriptionForEvent(function(string $eventName) {
                return "{$eventName} Pegawai";
            });
    }
}
