<?php
namespace Mbhanife\UploadFile\Models\Traits;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Mbhanife\UploadFile\Models\File;

trait UploadFile
{
    /**
     * Get all of the comments for the UploadFile
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function files(): HasMany
    {
        return $this->hasMany(File::class);
    }

}
