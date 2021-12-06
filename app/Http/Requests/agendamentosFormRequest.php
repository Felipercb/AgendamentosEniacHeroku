<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class agendamentosFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nome' =>'required|min:6',
            'email' =>'required',
            'nome_evento' =>'required',
            'telefone' =>'required',
            'data' =>'required',
            'espacoID' =>'required',
            'obs' =>'required'
        ];
    }

    public function attributes() //Renomear os atributos
{
    return [
        'horarioIni' => 'hora de início',
        'horariofIM' => 'hora de finalização',
        'espacoID' => 'local',
        'nome_evento' => 'nome do evento',
        'obs' =>'descrição'
    ];
}

    public function messages()
    {
        return[
            'required' => 'O campo :attribute é obrigatório!',
            'nome.min' => 'O campo :attribute precisa ter mais de 5 caracteres.'
        ];
    }
}
