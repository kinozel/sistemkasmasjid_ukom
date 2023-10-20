<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PemasukanRequest extends FormRequest
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
            'id_jenis_pemasukan' => ['required'],
            'jumlah_pemasukan' => ['required'],
            'tanggal_pemasukan' => ['required', 'date'],
            'deskripsi' => ['required'],
        ];
    }
    public function attributes()
    {
        return [
            'id_jenis_pemasukan' => 'Jenis pemasukan',
        ];
    }
}
