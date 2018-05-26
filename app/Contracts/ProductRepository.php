<?php

namespace App\Contracts;

interface ProductRepository
{
	public function getAll();

	public function show($id);

	public function showBySlug($slug);

	public function update($request, $id);

	public function destroy($id);

	public function store($data);
}