<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadFile extends FormRequest
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
            'name' => 'required',
            //20MG
            'file' => 'required|max:20480| 
                mimes:pdf,png,jpeg,doc,docx,xls,xlsx,csv', //https://svn.apache.org/repos/asf/httpd/httpd/trunk/docs/conf/mime.types
        ];
    }
}
