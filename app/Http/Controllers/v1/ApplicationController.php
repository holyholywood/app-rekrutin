<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreApplicationRequest;
use App\Http\Requests\UpdateApplicationRequest;
use App\Http\Response\ResponseTraits;
use App\Services\ApplicationService;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{

    use ResponseTraits;
    /**
     * Display a listing of the resource.
     */
    public function index(ApplicationService $Service, Request $request)
    {
        return $this->sendResponse($Service->getApplication());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ApplicationService $Service, StoreApplicationRequest $request)
    {
        return $this->sendResponse($Service->createNewApplication($request->all()), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(ApplicationService $Service,  StoreApplicationRequest $request)
    {
        return $this->sendResponse($Service->getApplication(['fieldName' => 'id', 'value' => $request->id]));
    }

    /**
     * Display the specified resource.
     */
    public function showStatus(ApplicationService $Service,  StoreApplicationRequest $request)
    {
        return $this->sendResponse($Service->getApplication(['fieldName' => 'id', 'value' => $request->id]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateStatus(ApplicationService $Service, UpdateApplicationRequest $request)
    {
        return $this->sendResponse($Service->updateApplication(['fieldName' => 'id', 'value' => $request->id], ['status' => $request->get('status')]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ApplicationService $Service, Request $request)
    {
        return $this->sendResponse($Service->deleteApplication(['fieldName' => 'id', 'value' => $request->id]), 200, 'Delete succesful');
    }
}
