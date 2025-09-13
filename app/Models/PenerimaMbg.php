<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\PenerimaMbg
 *
 * @property int $id
 * @property int $sekolah_id
 * @property string $nama_siswa
 * @property string $nis
 * @property string $kelas
 * @property \Illuminate\Support\Carbon $tanggal_lahir
 * @property string $jenis_kelamin
 * @property string $alamat
 * @property string $nama_orang_tua
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Sekolah $sekolah
 *
 * @method static \Illuminate\Database\Eloquent\Builder|PenerimaMbg newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PenerimaMbg newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PenerimaMbg query()
 * @method static \Illuminate\Database\Eloquent\Builder|PenerimaMbg whereAlamat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PenerimaMbg whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PenerimaMbg whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PenerimaMbg whereJenisKelamin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PenerimaMbg whereKelas($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PenerimaMbg whereNamaSiswa($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PenerimaMbg whereNamaOrangTua($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PenerimaMbg whereNis($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PenerimaMbg whereSekolahId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PenerimaMbg whereTanggalLahir($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PenerimaMbg whereUpdatedAt($value)
 * @method static \Database\Factories\PenerimaMbgFactory factory($count = null, $state = [])
 *
 * @mixin \Eloquent
 */
class PenerimaMbg extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'penerima_mbg';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'sekolah_id',
        'nama_siswa',
        'nis',
        'kelas',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'nama_orang_tua',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tanggal_lahir' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the sekolah that owns this penerima MBG.
     */
    public function sekolah(): BelongsTo
    {
        return $this->belongsTo(Sekolah::class, 'sekolah_id');
    }
}