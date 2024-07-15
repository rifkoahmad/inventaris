<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Peminjaman extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = ['users_id', 'barangs_id', 'pegawais_id', 'jumlah', 'tanggal_pinjam', 'lama_pinjam'];

    protected $table = 'peminjamen';
    protected $primaryKey = 'id';

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }
    public function barangs(): BelongsTo
    {
        return $this->belongsTo(Barang::class, 'barangs_id', 'id');
    }
    public function pegawais(): BelongsTo
    {
        return $this->belongsTo(Pegawai::class, 'pegawais_id', 'id');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->logOnlyDirty()
            ->useLogName('Peminjaman')
            ->dontSubmitEmptyLogs()
            ->setDescriptionForEvent(function(string $eventName) {
                return "{$eventName} Peminjaman";
            });
    }
}
