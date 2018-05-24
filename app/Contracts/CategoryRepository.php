<?php

namespace App\Contracts;

interface CategoryRepository
{
	public function index();

	public function show($id);

	public function showByType($id);

	public function update($request, $id);

	public function destroy($id);

	public function store($data);
}