<?php

namespace App\Http\Controllers\Service;

use Illuminate\Http\Request;
use App\Contracts\ServiceRepository;
use App\Http\Controllers\ApiController;

class ServiceController extends ApiController
{
    protected $service;

    /**
     * Constructor injected with Service Repository
     * @param ServiceRepository $service with Eloquent
     */
    public function __construct(ServiceRepository $service)
    {
        $this->middleware('client.credentials')->only(['index', 'show']);
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = $this->service->getAll();

        return $this->showAll($services);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $service = $this->service->show($id);

        return $this->showOne($service);
    }
}
