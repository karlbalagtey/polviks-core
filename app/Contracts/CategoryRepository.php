<?php

namespace App\Contracts;

interface CategoryRepository
{
	public function getAll();

	public function show($id);

	public function showBySlug($slug);

	public function update($request, $id);

	public function destroy($id);

	public function store($request);
}