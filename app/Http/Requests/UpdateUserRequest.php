<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;


use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{

	public function authorize()
	{
		return true;
	}


	public function rules()
	{
		return [
			'name' => ['required', 'string'],
			'role' => ['required', Rule::in(['admin', 'user'])],
			'password' => ['required','min:8', 'confirmed'],
			'email'=> ['required', 'email', 'unique:users,email'],
			'avatar_file' => ['image', 'nullable'],
			'number_id' => ['integer', 'required']
		];
	}
	public function menssage()
	{
		return [
			'name.required' => 'El nombre del usuario es requerido',
			'name.string' => 'El nombre del usuario debe contener letras',

			'email.required' => 'El  correo del usuario es requerido',
			'email.email' => 'El  correo del usuario debe ser un email valido',

			'password.required' => 'La contraseña del usuario  es requerida',
			'password.min' => 'La contraseña debe ser mayor a 8 caracteres',
			'password.confirmed' => 'La contraseña debe ser confirmada',
			'password.min' => 'La contraseña debe ser mayor a 8 caracteres',

			'role.required' => ' El role del usuario debe ser requerido',
			'role.in' => ' El valor del role que se envio no es correcto',


			'avatar_file.image' => ' La avatar debe de ser una imagen valida',
			'number_id.integer' => ' La cedula debe ser un numero valido',
			'number_id.required' => ' La cedula es requerida',



		];
	}
}