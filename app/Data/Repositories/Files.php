<?php

namespace App\Data\Repositories;

use App\Data\Models\AttachedFile;
use App\Data\Models\File as FileModel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
        return Storage::disk($this->getDrive())->exists(
            $this->makePath($file->hash, $uploadedFile)
        );
    }

    private function findOrCreateFile($uploadedFile)
    {
        $hash = sha1(file_get_contents($uploadedFile->getPathName()));

        if (!($file = $this->findByHash($hash))) {
            $file = $this->new();

            $file->hash = $hash;

            $file->drive = $this->getDrive();

            $file->path = $this->makePath($hash, $uploadedFile);

            $file->mime_type = $uploadedFile->getClientMimeType();

            $file->save();
        }

        return $file;
    }

    private function makeDirectory($hash)
    {
        return make_deep_path($hash);
    }

    /**
     * @param $file
     * @param $uploadedFile
     */
    protected function storeFile($file, $uploadedFile): void
    {
        if (!$this->fileExists($file, $uploadedFile)) {
            $uploadedFile->storeAs(
                $this->makeDirectory($file->hash),
                $this->makeFileName($file->hash, $uploadedFile),
                $this->getDrive()
            );
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

    private function getDrive()
    {
        return config('filesystems.documents_default', 'documents');
    }

    /**
     * @param $hash
     * @param $uploadedFile
     * @return string
     */
    private function makeFileName($hash, $uploadedFile): string
    {
        return $hash .
            '.' .
            Str::lower($uploadedFile->getClientOriginalExtension());
    }

    /**
     * @param $hash
     * @param $uploadedFile
     * @return string
     */
    private function makePath($hash, $uploadedFile): string
    {
        $deep = $this->makeDirectory($hash);

        $filename = $this->makeFileName($hash, $uploadedFile);

        return "{$deep}{$filename}";
    }
}
