<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RumahRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'kelurahan_id' => 'required|exists:kelurahan,id',
            'nama_pemilik' => [
                'required',
                'string',
                'max:100',
                Rule::unique('rumah', 'nama_pemilik')->ignore($this->rumah),
            ],
            'nik' => ['required', 'string', 'digits:16', 'starts_with:6472', Rule::unique('rumah', 'nik')->ignore($this->rumah)],
            'alamat' => 'required|string',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'kondisi' => 'required|string|max:30',
            'tahun_pendataan' => 'required|integer|min:2000|max:' . date('Y'),
            'keterangan' => 'nullable|string',
            'foto' => ['nullable', 'array', 'max:10'],
            'foto.*' => ['image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'nama_pemilik.unique' => 'Nama pemilik tersebut sudah terdaftar.',
            'nik.unique' => 'NIK tersebut sudah terdaftar.',
            'tahun_pendataan.required' => 'Tahun pendataan wajib diisi.',
            'tahun_pendataan.integer' => 'Tahun pendataan harus berupa angka.',
            'tahun_pendataan.min' => 'Tahun pendataan minimal adalah 2000.',
            'tahun_pendataan.max' => 'Tahun pendataan tidak boleh lebih dari tahun saat ini.',
            'foto.max' => 'Maksimal 10 foto.',
            'foto.*.max' => 'Ukuran Maksimal 2MB.',
            'foto.*.mimes' => 'Format foto harus jpg, jpeg, atau png.',
            'foto.*.image' => 'File harus berupa gambar.',
        ];
    }
}
