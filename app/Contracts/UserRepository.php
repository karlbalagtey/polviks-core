<?php

namespace App\Contracts;

interface UserRepository
{
	public function index();

	public function show($id);

	public function showByBatch($id);

	public function update($request, $id);

	public function destroy($id);

	public function store($data);
}