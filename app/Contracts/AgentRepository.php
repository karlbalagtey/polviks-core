<?php

namespace App\Contracts;

interface AgentRepository
{
	public function getAll();

	public function hasProducts();

	public function hasServices();

	public function show($id);

	public function showBySlug($slug);

	public function store($request);

	public function update($request, $id);

	public function destroy($id);
}