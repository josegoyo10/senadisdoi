<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class EncuestaRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules(Request $request)
    {
        $rules = [];

        $rules = ['image'      =>  'required|mimes:jpeg,png,pdf',];

        // Se aplica reglas solo cuando va a guardar y enviar.
        if ($request->get('btn_guardar_enviar') == 'enviar') {
            for($i = 1; $i <= $request->get("total_preguntas"); $i++) {
                $rules['preguntas.'.$i] = 'required';
            }
        }
        return $rules;
    }
}
