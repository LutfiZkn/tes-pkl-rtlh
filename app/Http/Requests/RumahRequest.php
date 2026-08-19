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
            'nama_pemilik' => 'required|string|max:100',
            'nik' => ['required', 'string', 'max:16', Rule::unique('rumah', 'nik')->ignore($this->rumah)],
            'alamat' => 'required|string',
            'kondisi' => 'required|string|max:30',
            'tahun_pendataan' => 'required|integer|min:2000|max:' . date('Y'),
            'keterangan' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'tahun_pendataan.min' => 'Tahun pendataan tidak boleh kurang dari 2000.',
            'tahun_pendataan.max' => 'Tahun pendataan tidak boleh lebih dari tahun saat ini.',
        ];
    }
}
