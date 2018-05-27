<?php

namespace App\Contracts;

interface CategoryRepository
{
	public function getAll();

	public function getItems($id, $type);

	public function getAgents($id, $type);

	public function getCustomers($id, $type);

	public function getTransactions($id, $type);

	public function show($id);

	public function showBySlug($slug);

	public function update($request, $id);

	public function destroy($id);

	public function store($request);
}