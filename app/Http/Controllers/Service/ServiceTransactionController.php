<?php

namespace App\Http\Controllers\Service;

use App\Contracts\ServiceRepository;
use App\Http\Controllers\ApiController;

class ServiceTransactionController extends ApiController
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
        $transactions = $service->getTransactions($service_id);

        return $this->showAll($transactions);
    }
}
