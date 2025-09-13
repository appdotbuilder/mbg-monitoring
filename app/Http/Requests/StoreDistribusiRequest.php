<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDistribusiRequest extends FormRequest
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
            'kendaraan_id' => 'required|exists:kendaraan,id',
            'tanggal_distribusi' => 'required|date',
            'jumlah_porsi' => 'required|integer|min:1',
            'status' => 'required|in:sudah,belum',
            'waktu_berangkat' => 'nullable|date_format:H:i',
            'waktu_tiba' => 'nullable|date_format:H:i|after:waktu_berangkat',
            'catatan' => 'nullable|string',
            'foto_distribusi' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
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
            'kendaraan_id.required' => 'Kendaraan wajib dipilih.',
            'kendaraan_id.exists' => 'Kendaraan yang dipilih tidak valid.',
            'tanggal_distribusi.required' => 'Tanggal distribusi wajib diisi.',
            'tanggal_distribusi.date' => 'Format tanggal tidak valid.',
            'jumlah_porsi.required' => 'Jumlah porsi wajib diisi.',
            'jumlah_porsi.integer' => 'Jumlah porsi harus berupa angka.',
            'jumlah_porsi.min' => 'Jumlah porsi minimal 1.',
            'status.required' => 'Status distribusi wajib dipilih.',
            'status.in' => 'Status distribusi tidak valid.',
            'waktu_berangkat.date_format' => 'Format waktu berangkat tidak valid (HH:MM).',
            'waktu_tiba.date_format' => 'Format waktu tiba tidak valid (HH:MM).',
            'waktu_tiba.after' => 'Waktu tiba harus setelah waktu berangkat.',
            'foto_distribusi.image' => 'File harus berupa gambar.',
            'foto_distribusi.mimes' => 'Format gambar harus jpeg, png, atau jpg.',
            'foto_distribusi.max' => 'Ukuran gambar maksimal 2MB.',
        ];
    }
}