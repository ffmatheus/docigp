<?php

namespace App\Http\Controllers\Web\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Data\Repositories\UploadFiles as UploadFilesRepository;
use App\Http\Requests\UploadFile as UploadFileRequest;


class UploadFiles extends Controller
{

    private $repository;

    public function __construct(UploadFilesRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(UploadFilesRepository $repository, Request $request)
    {
        return view('admin.upload_files.index')->with('uploadedFiles', ['']);
    }


    public function create()
    {
        dump('create');
        return view('admin.upload_files.form')->with(['uploadedFiles' => $this->repository->new()]);
    }


    /**
     * @param UploadFileRequest $request
     * @param UploadFileRepository $repository
     */
    public function store(
        UploadFileRequest $request,
        UploadFilesRepository $repository
    ) {

        
            $isOkUploadFile = $repository->uploadFile($request);

            dump($isOkUploadFile);

            return redirect()
                ->route('uploadFiles.index')
                ->with(
                    $this->getSuccessMessage(
                        'Arquivo está sendo processado.'
                    )
                );

    }
}
