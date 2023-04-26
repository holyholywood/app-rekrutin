<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileService
{
    public function saveFile($file)
    {

        try {
            $type = [
                'pdf' => 'docs',
                'docs' => 'docs',
                'png' => 'images',
                'jpg' => 'images'
            ];

            $userId = Auth::id();
            $filename = $file->getClientOriginalName();
            $fileExtension = $file->getClientOriginalExtension();

            $fileType = $type[$fileExtension];

            $newFilename = Str::uuid() . '-' . Str::remove(' ', Str::lower(Auth::user()->name)) . '-' . implode('-', [$userId, $filename]);
            $path = $file->storeAs($fileType, $newFilename);

            Storage::url($path);

            return url('/') . '/' . $path;
        } catch (\Throwable $th) {

            if ($th->getCode() === 0) {
                throw new Exception('file type unsupported', 415);
            }
        }
    }
}
