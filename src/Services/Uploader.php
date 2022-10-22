<?php

namespace Mbhanife\UploadFile\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Mbhanife\UploadFile\Models\File;

class Uploader
{
    private $request;
    private $storageManager;

    public function __construct(Request $request, StorageManager $storageManager)
    {
        $this->request = $request;
        $this->storageManager = $storageManager;
        $this->file = $request->file;
    }

    public function upload()
    {
        if ($this->isFileExists()) throw ValidationException::withMessages(['file' => 'File exicts']);

        $this->putFileIntoStorage();
        return $this->saveFileIntoDatabase();
    }

    public function putFileIntoStorage()
    {
        $method = $this->is_private() ? 'putFileAsPrivate' : 'putFileAsPublic' ;
        $this->storageManager->$method($this->file->getClientOriginalName(), $this->file, $this->getType());
    }

    private function saveFileIntoDatabase()
    {
        $file = new File([
            'user_id' => Auth::id(),
            'name' => $this->file->getClientOriginalName(),
            'size'=> $this->file->getSize(),
            'type' => $this->getType(),
            'is_private' => $this->is_private()
        ]);
        $file->save();
    }

    private function is_private()
    {
        return $this->request->has('is_private');
    }

    private function getType()
    {
        return [
            'image/jpeg'=>'image',
            'video/mp4'=>'video',
            'application/zip'=>'archive',
            'application/pdf'=>'pdf'
        ][$this->file->getClientMimeType()];
    }

    private function isFileExists()
    {
        return $this->storageManager->isFileExists($this->file->getClientOriginalName(),$this->getType(), $this->is_private());
    }
}
