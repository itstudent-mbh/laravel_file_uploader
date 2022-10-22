<?php

namespace Mbhanife\UploadFile\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Expr\Cast\String_;

class StorageManager
{
    public function putFileAsPublic(String $name, UploadedFile $file, String $type)
    {
        return Storage::disk('public')->putFileAs($type, $file, $name);
    }

    public function putFileAsPrivate(String $name, UploadedFile $file, String $type)
    {
        return Storage::disk('private')->putFileAs($type, $file, $name);
    }


    public function getAbsolutePathOf(String $name, String $type, bool $is_private)
    {
        return $this->disk($is_private)->path($this->directoryPrefix($type, $name));
    }


    public function isFileExists(String $name, String $type, bool $isPrivate)
    {
        return $this->disk($isPrivate)->exists($this->directoryPrefix($type, $name));
    }

    public function getFile(String $name, String $type, bool $isPrivate)
    {
        return $this->disk($isPrivate)->download($this->directoryPrefix($type, $name));
    }

    public function deleteFile(String $name, String $type, bool $isPrivate)
    {
        return $this->disk($isPrivate)->delete($this->directoryPrefix($type, $name));
    }

    private function directoryPrefix($type, $name)
    {
        return $type . DIRECTORY_SEPARATOR . $name;
    }

    private function disk(bool $is_private)
    {
        return $is_private ? Storage::disk('private') : Storage::disk('public');
    }
}
