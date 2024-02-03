<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenuRequest extends FormRequest
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
            'nombre' => 'required|unique:cg_menus,nombre,' . $this->id . '|max:50',
            'slug' => 'required|unique:cg_menus,slug,' . $this->id . '|max:70',
            'orden' => 'min:1',
            'cg_modulo_id' => 'required|numeric|min:1',
            'padre_cg_menu_id' => [
                'required',
                function ($attribute, $value, $fail) {
                    if ($this->tipo_concepto_id == 'crud' && $value <= 0) {
                        $fail($attribute . ' debe ser mayor que 0 cuando Tipo es un crud.');
                    }
                },
            ]
        ];




    }
}
