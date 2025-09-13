<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Sekolah
 *
 * @property int $id
 * @property string $nama_sekolah
 * @property string $alamat
 * @property string $kepala_sekolah
 * @property string|null $telepon
 * @property string|null $email
 * @property int $jumlah_siswa
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PenerimaMbg[] $penerimaMbg
 * @property-read int|null $penerima_mbg_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Distribusi[] $distribusi
 * @property-read int|null $distribusi_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Sekolah newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Sekolah newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Sekolah query()
 * @method static \Illuminate\Database\Eloquent\Builder|Sekolah whereAlamat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sekolah whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sekolah whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sekolah whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sekolah whereJumlahSiswa($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sekolah whereKepalaSekolah($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sekolah whereNamaSekolah($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sekolah whereTelepon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sekolah whereUpdatedAt($value)
 * @method static \Database\Factories\SekolahFactory factory($count = null, $state = [])
 *
 * @mixin \Eloquent
 */
class Sekolah extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sekolah';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nama_sekolah',
        'alamat',
        'kepala_sekolah',
        'telepon',
        'email',
        'jumlah_siswa',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'jumlah_siswa' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get all penerima MBG for this sekolah.
     */
    public function penerimaMbg(): HasMany
    {
        return $this->hasMany(PenerimaMbg::class, 'sekolah_id');
    }

    /**
     * Get all distribusi for this sekolah.
     */
    public function distribusi(): HasMany
    {
        return $this->hasMany(Distribusi::class, 'sekolah_id');
    }
}