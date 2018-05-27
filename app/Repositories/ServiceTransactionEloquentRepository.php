<?php

namespace App\Repositories;

use App\Models\Service;
use App\Models\Customer;
use App\Traits\ApiResponser;
use App\Models\ServiceTransaction;
use Illuminate\Support\Facades\DB;
use App\Contracts\ServiceTransactionRepository;

class ServiceTransactionEloquentRepository implements ServiceTransactionRepository
{
    use ApiResponser;

    protected $transaction;
    protected $service;
    protected $customer;

    /**
     * Constructor inject ServiceTransaction model
     * @param ServiceTransaction $transaction
     */
	public function __construct(ServiceTransaction $transaction, Service $service, Customer $customer)
	{
		$this->transaction = $transaction;
        $this->customer = $customer;
        $this->service = $service;
	}

    /**
     * Creates new user and returns $transaction
     * @param $data
     * @return mixed
     */
    public function addCustomerService($service_id, $customer_id, $request)
    {
        $customer = $this->customer->findOrfail($customer_id);
        $service = $this->service->findOrfail($service_id);

        if ($customer_id == $service->customer_id) {
            return $this->errorResponse('The customer must be different from the agent', 409);
        }

        if (!$customer->isVerified()) {
            return $this->errorResponse('The customer must be a verified user', 409);
        }

        if (!$service->agent->isVerified()) {
            return $this->errorResponse('The agent must be a verified user', 409);
        }

        if (!$service->isAvailable()) {
            return $this->errorResponse('The service is not available', 409);
        }

        if ($service->quantity < $request->quantity) {
            return $this->errorResponse('The service does not have enough units for this transaction', 409);
        }

        return DB::transaction(function() use ($request, $service, $customer) {
            $service->quantity -= $request->quantity;
            $service->save();

            $transaction = $this->transaction::create([
                'quantity' => $request->quantity,
                'customer_id' => $customer->id,
                'service_id' => $service->id,
            ]);

            return $transaction;
        });
    }

    /**
     * Returns all transactions
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getCategories($id)
	{
        $transaction = $this->show($id);
		
        return $transaction->service->categories;
	}

    /**
     * Returns customer
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAgent($id)
    {
        $transaction = $this->show($id);
        
        return $transaction->service->agent;
    }

    /**
     * Returns one user
     * @param $id
     * @return mixed
     */
    public function show($id)
	{
		return $this->transaction->findOrfail($id);
	}

    /**
     * Return transaction via slug
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function showBySlug($slug)
    {
        return $this->transaction->where('slug', $slug)->first();
    }

    /**
     * Creates new user and returns $transaction
     * @param $data
     * @return mixed
     */
    public function store($data)
    {
        $transaction = $this->transaction::create([
            'quantity' => $request->quantity,
            'customer_id' => $request->customer_id,
            'service_id' => $request->service_id
        ]);

        return $transaction;
    }

    /**
     * Updates user and returns $transaction
     * @param $request
     * @param $id
     * @return mixed
     */
    public function update($request, $id)
	{
        $transaction = $this->show($id);

        $transaction->update([
        	'quantity' => $request->quantity,
        	'customer_id' => $request->customer_id,
        	'service_id' => $request->service_id
        ]);

        return $transaction;
    }

    /**
     * Deletes transaction
     * @param $id
     * @return int
     */
    public function destroy($id)
	{
        $transaction = $this->show($id);
        $transaction->delete();

		return $transaction;
	}

}