<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePenerimaMbgRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'sekolah_id' => 'required|exists:sekolah,id',
            'nama_siswa' => 'required|string|max:255',
            'nis' => 'required|string|max:20|unique:penerima_mbg,nis',
            'kelas' => 'required|string|max:10',
            'tanggal_lahir' => 'required|date|before:today',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'alamat' => 'required|string',
            'nama_orang_tua' => 'required|string|max:255',
        ];
    }

    /**
     * Get custom error messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'sekolah_id.required' => 'Sekolah wajib dipilih.',
            'sekolah_id.exists' => 'Sekolah yang dipilih tidak valid.',
            'nama_siswa.required' => 'Nama siswa wajib diisi.',
            'nama_siswa.max' => 'Nama siswa maksimal 255 karakter.',
            'nis.required' => 'NIS wajib diisi.',
            'nis.unique' => 'NIS sudah terdaftar.',
            'nis.max' => 'NIS maksimal 20 karakter.',
            'kelas.required' => 'Kelas wajib diisi.',
            'kelas.max' => 'Kelas maksimal 10 karakter.',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
            'tanggal_lahir.date' => 'Tanggal lahir harus berupa tanggal yang valid.',
            'tanggal_lahir.before' => 'Tanggal lahir harus sebelum hari ini.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
            'jenis_kelamin.in' => 'Jenis kelamin harus Laki-laki atau Perempuan.',
            'alamat.required' => 'Alamat wajib diisi.',
            'nama_orang_tua.required' => 'Nama orang tua wajib diisi.',
            'nama_orang_tua.max' => 'Nama orang tua maksimal 255 karakter.',
        ];
    }
}