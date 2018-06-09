<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\ApiController;
use App\Contracts\ServiceTransactionRepository;

class ServiceTransactionAgentController extends ApiController
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('scope:read-general')->only('index');
        $this->middleware('can:view,App\Models\ServiceTransaction')->only('index');
    }
    
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
