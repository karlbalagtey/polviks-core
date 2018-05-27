<?php

namespace App\Http\Controllers\Service;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;
use App\Contracts\ServiceTransactionRepository;

class ServiceTransactionAgentController extends ApiController
{
    protected $transaction;

    /**
     * Constructor injected with Service Transaction Repository
     * @param ServiceTransactionRepository $transaction
     */
    public function __construct(ServiceTransactionRepository $transaction)
    {
        $this->transaction = $transaction;
    }
}
