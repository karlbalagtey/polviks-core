<?php

namespace App\Contracts;

interface UserRepository
{
	public function index();

	public function show($id);

	public function showBySlug($slug);

	public function store($request);

	public function update($request, $id);

	public function destroy($id);
}