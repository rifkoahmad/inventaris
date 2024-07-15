<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Mahasiswa extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'users_id',
        'prodi_id',
        'nama',
        'nim',
        'angkatan',
        'ipk',
    ];
    protected $table = 'mahasiswas';
    protected $primaryKey = 'id';

    public function prodis(): BelongsTo
    {
        return $this->belongsTo(Prodi::class, 'prodi_id');
    }
    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->logOnlyDirty()
            ->useLogName('Mahasiswa')
            ->dontSubmitEmptyLogs()
            ->setDescriptionForEvent(function(string $eventName) {
                return "{$eventName} Mahasiswa";
            });
    }
}
