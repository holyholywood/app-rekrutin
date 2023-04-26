<?php

namespace App\Http\Controllers;

use App\Http\Response\ResponseTraits;
use App\Services\FileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FileController extends Controller
{
    use ResponseTraits;
    /**
     * Store a newly created resource in storage.
     */
    public function store(FileService $Service,  Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|file|max:2048', // maximum size in kilobytes (2MB = 2048KB)
        ]);

        if ($validator->fails()) {
            return $this->sendError(422, "Ukuran file terlalu besar");
        }
        try {
            return $this->sendResponse($Service->saveFile($request->file('file')));
        } catch (\Throwable $th) {
            return $this->sendError($th->getCode(), $th->getMessage());
        }
    }
}
