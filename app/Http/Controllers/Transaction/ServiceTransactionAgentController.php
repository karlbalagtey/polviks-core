<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\ApiController;
use App\Contracts\ServiceTransactionRepository;

class ServiceTransactionAgentController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id, ServiceTransactionRepository $transaction)
    {
        $agent = $transaction->getAgent($id);

        return $this->showOne($agent);
    }
}
