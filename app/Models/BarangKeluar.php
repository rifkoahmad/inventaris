<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class BarangKeluar extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = ['users_id','tanggal_keluar'];

    protected $table = 'barang_keluars';
    protected $primaryKey = 'id';

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }
    public function peminjamen(): BelongsTo
    {
        return $this->belongsTo(Peminjaman::class, 'users_id', 'id');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->logOnlyDirty()
            ->useLogName('BarangKeluar')
            ->dontSubmitEmptyLogs()
            ->setDescriptionForEvent(function(string $eventName) {
                return "{$eventName} BarangKeluar";
            });
    }
}
