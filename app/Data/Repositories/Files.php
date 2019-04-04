<?php
namespace App\Data\Repositories;

use App\Data\Models\CongressmanBudget;
use App\Data\Models\File as FileModel;
use Illuminate\Support\Facades\Storage;

class Files extends Repository
{
    protected $model = FileModel::class;

    public function uploadFile($attributes, $entry)
    {
        $uploadFile = $attributes['file'];

        $sha1_hash = hash(
            'sha1',
            file_get_contents($uploadFile->getPathName())
        );

        if (!($file = $this->findByHash($sha1_hash))) {
            $file = $this->new();
            $file->hash = $sha1_hash;
            $file->drive = $this->getDriver();
            $file->path = "{$file->drive}/{$this->deepPath($sha1_hash)}.{$uploadFile->getClientOriginalExtension()}";
            $file->mime_type = $uploadFile->getClientMimeType();
            $file->public_url = ''; //TODO descobrir como fazer

            $file->save();
        }

        Storage::disk($this->getDriver())->exists(
            ($fileName = $this->makeFileName($file, $uploadFile))
        ) ?:
        $uploadFile->storeAs(
            $this->deepPath($file->hash),
            $file->hash . '.' . $uploadFile->getClientOriginalExtension(),
            $this->getDriver()
        );

        $file->public_url = 'XXXXXX depois de movido via storage XXXXXX'; //TODO descobrir como fazer
        $file->save();

        app(AttachedFiles::class)->firstOrCreate(
            [
                'file_id' => $file->id,
                'fileable_id' => $entry->id,
                'fileable_type' => get_class($entry),
            ],

            [
                'original_name' => $uploadFile->getClientOriginalName(),
            ]
        );
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
    private function makeFileName($newFile, $uploadFile): string
    {
        return "{$this->deepPath($newFile->hash)}{$newFile->hash}.{$uploadFile->getClientOriginalExtension()}";
    }
}
