<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Pengembalian extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = ['peminjamen_id', 'pegawais_id', 'tanggal_kembali'];

    protected $table = 'pengembalians';
    protected $primaryKey = 'id';

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

    public function pegawais(): BelongsTo
    {
        return $this->belongsTo(Pegawai::class, 'pegawais_id', 'id');
    }

    public function peminjamen(): BelongsTo
    {
        return $this->belongsTo(Peminjaman::class, 'peminjamen_id', 'id');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->logOnlyDirty()
            ->useLogName('Pengembalian')
            ->dontSubmitEmptyLogs()
            ->setDescriptionForEvent(function(string $eventName) {
                return "{$eventName} Pengembalian";
            });
    }
}
