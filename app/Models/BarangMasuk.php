<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class BarangMasuk extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = ['barangs_id', 'suppliers_id', 'jumlah_barang', 'tanggal_masuk'];

    protected $table = 'barang_masuks';
    protected $primaryKey = 'id';

    public function barangs(): BelongsTo
    {
        return $this->belongsTo(Barang::class);
    }
    public function suppliers(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->logOnlyDirty()
            ->useLogName('BarangMasuk')
            ->dontSubmitEmptyLogs()
            ->setDescriptionForEvent(function(string $eventName) {
                return "{$eventName} BarangMasuk";
            });
    }
}
