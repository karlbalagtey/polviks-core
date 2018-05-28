<?php

namespace App\Contracts;

interface ProductTransactionRepository
{
	public function getAll();

	public function getAgent($id);

	public function getOne($product_id);

	public function getCategories($id);

	public function addCustomerProduct($product_id, $customer_id, $request);
}