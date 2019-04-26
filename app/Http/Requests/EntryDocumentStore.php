<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Gate;

class EntryDocumentStore extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('entry-documents:store');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'file' => 'required|max:20480| 
                mimes:pdf,png,jpeg,doc,docx,xls,xlsx,csv', //https://svn.apache.org/repos/asf/httpd/httpd/trunk/docs/conf/mime.types
        ];
    }
}
