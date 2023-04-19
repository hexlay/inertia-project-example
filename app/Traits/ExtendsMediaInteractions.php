<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;
use function request;

trait ExtendsMediaInteractions
{

    /**
     * @throws FileIsTooBig
     * @throws FileDoesNotExist
     */
    public function saveMedia(string $mediaKey, string $collection): void
    {
        $requestMedia = request($mediaKey);

        if (!$requestMedia) {
            $this->clear($collection);
        }

        if ($requestMedia instanceof UploadedFile) {
            $this->clear($collection);
            $this->addMedia($requestMedia)->toMediaCollection($collection);
        }
    }

    public function clear(string $collection): void
    {
        $this->clearMediaCollection($collection);
    }

}
