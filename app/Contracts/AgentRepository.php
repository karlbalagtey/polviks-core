<?php

namespace App\Contracts;

interface AgentRepository
{
	public function index();

	public function show($id);

	public function store($request);

	public function showByType($id);

	public function update($request, $id);

	public function destroy($id);
}