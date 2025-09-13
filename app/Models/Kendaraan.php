<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Kendaraan
 *
 * @property int $id
 * @property string $nama_kendaraan
 * @property string $plat_nomor
 * @property string $driver_name
 * @property string $driver_phone
 * @property string $status
 * @property string|null $keterangan
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Distribusi[] $distribusi
 * @property-read int|null $distribusi_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Kendaraan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Kendaraan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Kendaraan query()
 * @method static \Illuminate\Database\Eloquent\Builder|Kendaraan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kendaraan whereDriverName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kendaraan whereDriverPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kendaraan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kendaraan whereKeterangan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kendaraan whereNamaKendaraan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kendaraan wherePlatNomor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kendaraan whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kendaraan whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kendaraan aktif()
 * @method static \Database\Factories\KendaraanFactory factory($count = null, $state = [])
 *
 * @mixin \Eloquent
 */
class Kendaraan extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'kendaraan';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nama_kendaraan',
        'plat_nomor',
        'driver_name',
        'driver_phone',
        'status',
        'keterangan',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get all distribusi for this kendaraan.
     */
    public function distribusi(): HasMany
    {
        return $this->hasMany(Distribusi::class, 'kendaraan_id');
    }

    /**
     * Scope a query to only include active kendaraan.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    }
}