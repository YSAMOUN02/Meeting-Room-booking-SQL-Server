<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function upload_file($file) {
        // Generate a random name to avoid conflicts
        $FileName = $file->getClientOriginalName();

        // Move the uploaded file to the desired directory
        $file->move(public_path('Uploads'), $FileName);

        return $FileName;
    }

}
