<?php

namespace App\Contracts;

interface ProductTransactionRepository
{
	public function addCustomerProduct($product_id, $customer_id, $request);
}