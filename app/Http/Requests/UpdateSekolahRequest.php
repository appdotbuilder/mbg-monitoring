<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSekolahRequest extends FormRequest
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
            'nama_sekolah' => 'required|string|max:255',
            'alamat' => 'required|string',
            'kepala_sekolah' => 'required|string|max:255',
            'telepon' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'jumlah_siswa' => 'required|integer|min:0',
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
            'nama_sekolah.required' => 'Nama sekolah wajib diisi.',
            'alamat.required' => 'Alamat sekolah wajib diisi.',
            'kepala_sekolah.required' => 'Nama kepala sekolah wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'jumlah_siswa.required' => 'Jumlah siswa wajib diisi.',
            'jumlah_siswa.integer' => 'Jumlah siswa harus berupa angka.',
            'jumlah_siswa.min' => 'Jumlah siswa tidak boleh kurang dari 0.',
        ];
    }
}