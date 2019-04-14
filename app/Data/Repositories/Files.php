<?php

namespace App\Data\Repositories;

use App\Data\Models\AttachedFile;
use App\Data\Models\File as FileModel;
use Illuminate\Support\Facades\Storage;

class Files extends Repository
{
    protected $model = FileModel::class;

    /**
     * @param $entry
     * @param $file
     * @param $uploadedFile
     * @return \App\Data\Models\AttachedFile
     */
    protected function createAttachment(
        $entry,
        $file,
        $uploadedFile
    ): AttachedFile {
        return app(AttachedFiles::class)->firstOrCreate(
            [
                'file_id' => $file->id,
                'fileable_id' => $entry->id,
                'fileable_type' => get_class($entry),
            ],

            [
                'original_name' => $uploadedFile->getClientOriginalName(),
            ]
        );
    }

    /**
     * @param $file
     * @param $uploadedFile
     * @return bool
     */
    protected function fileExists($file, $uploadedFile): bool
    {
        return Storage::disk($this->getDriver())->exists(
            $fileName = $this->makeFileName($file, $uploadedFile)
        );
    }

    private function findOrCreateFile($uploadedFile)
    {
        $sha1_hash = sha1(file_get_contents($uploadedFile->getPathName()));

        if (!($file = $this->findByHash($sha1_hash))) {
            $file = $this->new();

            $file->hash = $sha1_hash;

            $file->drive = $this->getDriver();

            $file->path = "{$file->drive}/{$this->deepPath(
                $sha1_hash
            )}.{$uploadedFile->getClientOriginalExtension()}";

            $file->mime_type = $uploadedFile->getClientMimeType();

            $file->public_url = ''; //TODO descobrir como fazer

            $file->save();
        }

        return $file;
    }

    /**
     * @param $file
     */
    protected function makePublicUrl($file): void
    {
        $file->public_url = 'XXXXXX depois de movido via storage XXXXXX'; //TODO descobrir como fazer

        $file->save();
    }

    /**
     * @param $file
     * @param $uploadedFile
     */
    protected function storeFile($file, $uploadedFile): void
    {
        if (!$this->fileExists($file, $uploadedFile)) {
            $uploadedFile->storeAs(
                $this->deepPath($file->hash),
                $file->hash . '.' . $uploadedFile->getClientOriginalExtension(),
                $this->getDriver()
            );

            $this->makePublicUrl($file);
        }
    }

    /**
     * @param $attributes
     * @param $model
     * @return \App\Data\Models\AttachedFile
     */
    public function uploadFile($attributes, $model): AttachedFile
    {
        $this->storeFile(
            $file = $this->findOrCreateFile(
                $uploadedFile = $attributes['file']
            ),
            $uploadedFile
        );

        return $this->createAttachment($model, $file, $uploadedFile);
    }

    private function deepPath($nameHash, $length = 4)
    {
        $deepPath = '';
        for ($i = 1; $i <= $length; $i++) {
            $deepPath =
                $deepPath . substr($nameHash, $i - 1, 1) . DIRECTORY_SEPARATOR;
        }
        return $deepPath;
    }

    private function getDriver()
    {
        return config('filesystems.documents_default', 'documents');
    }

    /**
     * @param $newFile
     * @return string
     */
    private function makeFileName($newFile, $uploadedFile): string
    {
        return "{$this->deepPath(
            $newFile->hash
        )}{$newFile->hash}.{$uploadedFile->getClientOriginalExtension()}";
    }
}
