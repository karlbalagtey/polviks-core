<?php

namespace App\Contracts;

interface ServiceTransactionRepository
{
	public function getAll();

	public function getAgent($id);

	public function getOne($service_id);

	public function getCategories($id);

	public function addCustomerService($service_id, $customer_id, $request);

	public function update($request, $id);

	public function destroy($id);

	public function store($data);
}