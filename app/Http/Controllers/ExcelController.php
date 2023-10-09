<?php

namespace App\Http\Controllers;

use App\Contracts\Action\Excel\CreateJobContract;
use App\Http\Requests\ExcelUploadRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

class ExcelController extends Controller
{
    private CreateJobContract $createJob;

    public function __construct(CreateJobContract $createJobContract)
    {
        $this->createJob = $createJobContract;
    }

    public function upload(ExcelUploadRequest $request): JsonResponse
    {
        $this->createJob->handle(storage_path()."/app/".$request->storeFile());

        return Response::json();
    }
}
