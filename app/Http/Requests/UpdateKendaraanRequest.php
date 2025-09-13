<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateKendaraanRequest extends FormRequest
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
            'nama_kendaraan' => 'required|string|max:255',
            'plat_nomor' => 'required|string|max:20|unique:kendaraan,plat_nomor,' . $this->route('kendaraan')->id,
            'driver_name' => 'required|string|max:255',
            'driver_phone' => 'required|string|max:20',
            'status' => 'required|in:aktif,tidak_aktif',
            'keterangan' => 'nullable|string',
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
            'nama_kendaraan.required' => 'Nama kendaraan wajib diisi.',
            'plat_nomor.required' => 'Plat nomor wajib diisi.',
            'plat_nomor.unique' => 'Plat nomor sudah terdaftar untuk kendaraan lain.',
            'driver_name.required' => 'Nama driver wajib diisi.',
            'driver_phone.required' => 'Nomor telepon driver wajib diisi.',
            'status.required' => 'Status kendaraan wajib dipilih.',
            'status.in' => 'Status kendaraan tidak valid.',
        ];
    }
}