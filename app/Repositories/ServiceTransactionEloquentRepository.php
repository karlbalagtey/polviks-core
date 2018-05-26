<?php

namespace App\Repositories;

use App\Models\ServiceTransaction;
use App\Contracts\ServiceTransactionRepository;

class ServiceTransactionEloquentRepository implements ServiceTransactionRepository
{

	protected $transaction;

    /**
     * Constructor inject ServiceTransaction model
     * @param ServiceTransaction $transaction
     */
	public function __construct(ServiceTransaction $transaction)
	{
		$this->transaction = $transaction;
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