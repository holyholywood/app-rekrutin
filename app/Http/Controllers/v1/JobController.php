<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreJobRequest;
use App\Http\Requests\UpdateJobRequest;
use App\Http\Response\ResponseTraits;
use App\Services\JobService;

class JobController extends Controller
{
    use ResponseTraits;
    /**
     * Display a listing of the resource.
     */
    public function index(JobService $Service)
    {
        return $this->sendResponse($Service->getJob());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JobService $Service, StoreJobRequest $request)
    {
        return $this->sendResponse($Service->createNewJob($request->all()), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(JobService $Service,  StoreJobRequest $request)
    {
        return $this->sendResponse($Service->getJob(['fieldName' => 'id', 'value' => $request->id]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JobService $Service, UpdateJobRequest $request)
    {
        return $this->sendResponse($Service->updateJob(['fieldName' => 'id', 'value' => $request->id], $request->all()));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobService $Service, Request $request)
    {
        return $this->sendResponse($Service->deleteJob(['fieldName' => 'id', 'value' => $request->id]), 200, 'Delete succesful');
    }
}
