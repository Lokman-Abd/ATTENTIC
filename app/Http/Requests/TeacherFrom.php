<?php

namespace App\Http\Requests;

use App\Models\Student;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class TeacherFrom extends FormRequest
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
        $id = $this->request->get("id");
        return [
            'id' =>['required','unique:teachers','numeric'],
            'first_name' =>'required',
            'last_name' =>'required',
            'grade' =>'required',
            'email' =>['required', 'unique:teachers,email,'.$id,],
            'phone' =>['required', 'unique:teachers,phone,'.$id,],
            'password' => [Rule::requiredIf(!$id),'min:6'],
            
        ];
    }
}
