<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Distribusi
 *
 * @property int $id
 * @property int $sekolah_id
 * @property int $kendaraan_id
 * @property \Illuminate\Support\Carbon $tanggal_distribusi
 * @property int $jumlah_porsi
 * @property string $status
 * @property string|null $waktu_berangkat
 * @property string|null $waktu_tiba
 * @property string|null $catatan
 * @property string|null $foto_distribusi
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Sekolah $sekolah
 * @property-read \App\Models\Kendaraan $kendaraan
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Distribusi newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Distribusi newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Distribusi query()
 * @method static \Illuminate\Database\Eloquent\Builder|Distribusi whereCatatan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Distribusi whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Distribusi whereFotoDistribusi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Distribusi whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Distribusi whereJumlahPorsi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Distribusi whereKendaraanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Distribusi whereSekolahId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Distribusi whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Distribusi whereTanggalDistribusi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Distribusi whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Distribusi whereWaktuBerangkat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Distribusi whereWaktuTiba($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Distribusi sudah()
 * @method static \Illuminate\Database\Eloquent\Builder|Distribusi belum()
 * @method static \Database\Factories\DistribusiFactory factory($count = null, $state = [])
 *
 * @mixin \Eloquent
 */
class Distribusi extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'distribusi';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'sekolah_id',
        'kendaraan_id',
        'tanggal_distribusi',
        'jumlah_porsi',
        'status',
        'waktu_berangkat',
        'waktu_tiba',
        'catatan',
        'foto_distribusi',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tanggal_distribusi' => 'date',
        'jumlah_porsi' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the sekolah that owns this distribusi.
     */
    public function sekolah(): BelongsTo
    {
        return $this->belongsTo(Sekolah::class, 'sekolah_id');
    }

    /**
     * Get the kendaraan that owns this distribusi.
     */
    public function kendaraan(): BelongsTo
    {
        return $this->belongsTo(Kendaraan::class, 'kendaraan_id');
    }

    /**
     * Scope a query to only include completed distributions.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSudah($query)
    {
        return $query->where('status', 'sudah');
    }

    /**
     * Scope a query to only include pending distributions.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeBelum($query)
    {
        return $query->where('status', 'belum');
    }
}