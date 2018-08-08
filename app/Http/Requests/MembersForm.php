<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use App\Member;

class MembersForm extends FormRequest
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
            'first_name' => 'required',
            'middle_name' => 'required',
            'last_name' => 'required',
            'address' => 'required',
            'contact_no' => 'required',
        ];
    }

    public function persist() {
        Member::create(
            $this->only([
                'first_name', 
                'middle_name',
                'last_name',
                'address',
                'contact_no',
            ])
        );
    }
}
