<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Barang extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = ['ruangans_id', 'nama_barang', 'kode_barang', 'stok', 'foto','status'];

    protected $table = 'barangs';
    protected $primaryKey = 'id';

    public function ruangans(): BelongsTo
    {
        return $this->belongsTo(Ruangan::class);
    }
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->logOnlyDirty()
            ->useLogName('Barang')
            ->dontSubmitEmptyLogs()
            ->setDescriptionForEvent(function(string $eventName) {
                return "{$eventName} Barang";
            });
    }
}

