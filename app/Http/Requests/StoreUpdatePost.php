<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUpdatePost extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $id = $this->segment(2); //segmente vai contar os campos da URL

        $rules = [
            'title' => [
                'required', 'min:3', 'max:160',
                //"unique:posts,title,{$id},id", //Unique:na tabela posts, coluna title, onde id seja difente do id
                Rule::unique('posts')->ignore($id) //também podemos validar dessa forma
            ],

            'content' => ['nullable', 'min:5', 'max:10000'],
            'image' => ['required', 'image']
        ];
        
        //Fazendo uma validação para o atualizar, para que não seja necessario ficar subindo toda hora uma imagem
        if($this->method() == 'PUT'){
            $rules['image'] = ['nullable', 'image'];
        }


        return $rules;
    }
}
