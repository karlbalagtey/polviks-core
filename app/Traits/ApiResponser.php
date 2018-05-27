<?php

namespace App\Traits;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

trait ApiResponser
{
	private function successResponse($data, $code)
	{
		return response()->json($data, $code);
	}

	protected function errorResponse($message, $code)
	{
		return response()->json(['error' => $message, 'code' => $code], $code);
	}

	protected function showAll($collection, $code = 200)
	{
        if ( ! is_array(json_decode($collection, true))) {
            return $collection;
        }

		return $this->successResponse(['data' => $collection], $code);
	}

	protected function showOne($model, $code = 200)
	{
        if ( ! is_array(json_decode($model, true))) {
            return $model;
        }

		return $this->successResponse(['data' => $model], $code);
	}
}