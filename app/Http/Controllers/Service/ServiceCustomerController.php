<?php

namespace App\Http\Controllers\Service;

use App\Contracts\ServiceRepository;
use App\Http\Controllers\ApiController;

class ServiceCustomerController extends ApiController
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($service_id, ServiceRepository $service)
    {
        $customers = $service->getCustomers($service_id);

        return $this->showAll($customers);
    }
}
