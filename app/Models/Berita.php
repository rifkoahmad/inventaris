<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Berita extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = ['kategori_beritas_id', 'judul', 'catatan', 'gambar', 'tanggal_publikasi'];

    protected $table = 'beritas';
    protected $primaryKey = 'id';

    public function kategori_beritas(): BelongsTo
    {
        return $this->belongsTo(KategoriBerita::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->logOnlyDirty()
            ->useLogName('Berita')
            ->dontSubmitEmptyLogs()
            ->setDescriptionForEvent(function(string $eventName) {
                return "{$eventName} Berita";
            });
    }
}
