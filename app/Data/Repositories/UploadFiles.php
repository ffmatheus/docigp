<?php

namespace App\Data\Repositories;

use Input;

use App\Data\Models\UploadFile as UploadFileModel;
use App\Http\Requests\UploadFile as UploadFileRequest;

class UploadFiles extends Repository
{
    protected $model = UploadFileModel::class;

    protected $fillable = ['name'];

    public function uploadFile(UploadFileRequest $request)
    {
        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $file = $request->file('file');
            $extensions = ['pdf', 'png', 'jpg', 'jpeg'];
            $mimesType = ['application/pdf', 'image/png', 'image/jpeg'];

            if (
                in_array($file->getClientOriginalExtension(), $extensions) &&
                in_array($file->getMimeType(), $mimesType) &&
                $file->getSize() <= 20971520
            ) {
                $file->move(
                    storage_path('upload_files/'),
                    $file->getClientOriginalName()
                );

                return true;
            }
        }

        return false;
    }
}
