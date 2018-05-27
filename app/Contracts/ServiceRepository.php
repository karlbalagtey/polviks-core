<?php

namespace App\Contracts;

interface ServiceRepository
{
	public function getAll();

	public function getAgentService($agent_id, $service_id);

	public function getTransactions($service_id);

	public function getCategories($service_id);

	public function addCategory($service_id, $category_id);

	public function removeCategory($service_id, $category_id);

	public function show($id);

	public function showBySlug($slug);

	public function update($agent_id, $service_id, $request);

	public function destroy($agent_id, $service_id);

	public function store($request, $id);
}