<?php

namespace App\Contracts;

interface CustomerRepository
{
	public function index();

	public function show($id);

	public function showByType($id);

	public function update($request, $id);

	public function destroy($id);

	public function store($data);
}