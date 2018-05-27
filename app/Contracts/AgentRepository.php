<?php

namespace App\Contracts;

interface AgentRepository
{
	public function getAll();

	public function getProducts($id);

	public function getServices($id);

	public function getTransactions($id, $type);

	public function getCategories($id, $type);

	public function getCustomers($id, $type);

	public function hasProducts();

	public function hasServices();

	public function show($id);

	public function showBySlug($slug);

	public function store($request);

	public function update($request, $id);

	public function destroy($id);
}