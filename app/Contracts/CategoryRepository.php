<?php

namespace App\Contracts;

interface CategoryRepository
{
	public function getAll();

	public function getItems($id);

	public function getItemsByType($id, $type);

	public function getProducts($category_id);

	public function getServices($category_id);

	public function getAgents($category_id);

	public function getAgentsByType($id, $type);

	public function getCustomers($category_id);

	public function getCustomersByType($category_id, $type);

	public function getTransactions($id);

	public function getTransactionsByType($id, $type);

	public function show($id);

	public function showBySlug($slug);

	public function update($request, $id);

	public function destroy($id);

	public function store($request);
}