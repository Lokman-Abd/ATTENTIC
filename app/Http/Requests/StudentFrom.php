<?php

namespace App\Http\Requests;

use App\Models\Student;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StudentFrom extends FormRequest
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
        $id = $this->request->get("student_id");
        return [
            'student_card' => ['required', 'unique:students,student_card,'.$id.',student_id', 'numeric'],
            'student_first_name' => 'required',
            'student_last_name' => 'required',
            'student_email' => ['required', 'unique:students,student_email,'.$id.',student_id'],
            'group_id' => ['required', 'exists:groups,group_id'],
            'student_password' => [Rule::requiredIf(!$id),'min:6'],
        ];
    }
}
