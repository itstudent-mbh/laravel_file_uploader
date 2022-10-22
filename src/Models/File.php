<?php
namespace Mbhanife\UploadFile\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Mbhanife\UploadFile\Services\StorageManager;

class File extends Model
{
    protected $fillable = [
        'user_id','name','size','type','is_private'
    ];

    public function user()
    {
        $this->belongsTo(User::class);
    }

    public function absolutePath()
    {
        return resolve(StorageManager::class)->getAbsolutePathOf($this->name, $this->type, $this->is_private);
    }

    public function download()
    {
        return resolve(StorageManager::class)->getFile($this->name, $this->type, $this->is_private);
    }


    public function delete()
    {
        resolve(StorageManager::class)->deleteFile($this->name, $this->type, $this->is_private);

        parent::delete();
    }
}
