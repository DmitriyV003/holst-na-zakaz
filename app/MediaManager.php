<?php

namespace App;

use App\Models\Media;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Spatie\MediaLibrary\HasMedia;
use Str;

class MediaManager
{
    private ?Media $media;
    private const MEDIA_COLLECTION = 'media';

    public function __construct(?Media $media = null)
    {
        $this->media = $media;
    }

    public function putUploadedFile(HasMedia $mediaContainer, UploadedFile $uploadedFile): Media
    {
        $fileName = Str::random();
        if ($extension = $uploadedFile->extension()) {
            $fileName .= ".$extension";
        }

        $this->media = $mediaContainer->addMedia($uploadedFile)
            ->setFileName($fileName)
            ->usingName($fileName)
            ->toMediaCollection(self::MEDIA_COLLECTION);

        $this->media->save();

        return $this->media;
    }
}
