<?php

namespace App\Contracts;

interface CustomerRepository
{
	public function getAll();

	public function getAllProducts($id);

	public function getAllServices($id);

	public function getAllProductAgents($id);

	public function getAllServiceAgents($id);

	public function getAllServiceCategories($id);

	public function getAllProductCategories($id);

	public function getServiceTransactions($id);

	public function getProductTransactions($id);

	public function hasProductTransactions();

	public function hasServiceTransactions();

	public function show($id);

	public function showBySlug($slug);

	public function showOneWithProductTransaction($id);

	public function showOneWithServiceTransaction($id);

	public function store($request);

	public function update($request, $id);

	public function destroy($id);
}