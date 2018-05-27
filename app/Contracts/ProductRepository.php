<?php

namespace App\Contracts;

interface ProductRepository
{
	public function getAll();

	public function getAgentProduct($agent_id, $product_id);

	public function getTransactions($product_id);

	public function getCustomers($product_id);

	public function getCategories($product_id);

	public function addCategory($product_id, $category_id);

	public function removeCategory($product_id, $category_id);

	public function show($id);

	public function showBySlug($slug);

	public function update($agent_id, $product_id, $request);

	public function destroy($agent_id, $product_id);

	public function store($request, $id);
}