<?php

namespace App\Contracts;

interface ProductRepository
{
	public function getAll();

	public function show($id);

	public function getAgentProduct($agent_id, $product_id);

	public function showBySlug($slug);

	public function update($agent_id, $product_id, $request);

	public function destroy($id);

	public function store($request, $id);
}