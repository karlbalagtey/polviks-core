<?php

namespace App\Contracts;

interface CustomerRepository
{
	public function getAll();

	public function getProducts($id);

	public function getServices($id);

	public function getProductAgents($id);

	public function getServiceAgents($id);

	public function getTransactions($id, $type);

	public function getServiceCategories($id);

	public function getProductCategories($id);

	public function getProductTransaction($id);

	public function getServiceTransaction($id);

	public function show($id);

	public function showBySlug($slug);

	public function store($request);

	public function update($request, $id);

	public function destroy($id);

	public function verify($token);

}