<?php

namespace App\Contracts;

interface ServiceTransactionRepository
{
	public function getCategories($id);

	public function getAgent($id);

	public function show($id);

	public function showBySlug($slug);

	public function update($request, $id);

	public function destroy($id);

	public function store($data);
}