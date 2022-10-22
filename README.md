# File_upload_Controller
Laravel file upload controller package 
Support zip/jpeg/mp4/pdf files

# Install 
```bash
composer require mbhanife/Laravel_File_uploader
```

```bash
php artisan migrate 
php artisan storage:link
```

Add trait ' use UploadFile ' to user model  

Create folder 'private' in storate/app directory

Copy this to config/filesystems.php into discks array
```bash
    'private' => [
            'driver' => 'local',
            'root' => storage_path('app/private')
        ],
```

# Use

Upload file with uploader in controller 
Request must has 'file' field and 'is_private' if it`s private file
```bash
    $uploader = new Uploader($request, new StorageManager());
    $uploader->upload();
```

Get file absolute path
```bash
    $file = File::find(x);
    $file->absolutePath();
```

Download file
```bash
    $file = File::find(x);
    $file->download();
```

Delete file
```bash
    $file = File::find(x);
    $file->delete();
```

