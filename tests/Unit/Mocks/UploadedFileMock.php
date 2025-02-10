<?php

namespace Tests\Unit\Mocks;

use Illuminate\Http\UploadedFile;

class UploadedFileMock
{
    public function getMock()
    {
        return new UploadedFile(storage_path('app/public/win-98.jpeg'), 'win-98.jpeg');
    }
}