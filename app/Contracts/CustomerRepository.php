<?php

namespace App\Contracts;

interface CustomerRepository
{
	public function getAll();

	public function hasProductTransactions();

	public function hasServiceTransactions();

	public function show($id);

	public function showOneWithProductTransaction($id);

	public function showOneWithServiceTransaction($id);

	public function store($request);

	public function showByType($id);

	public function update($request, $id);

	public function destroy($id);
}