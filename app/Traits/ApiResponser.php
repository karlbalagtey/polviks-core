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

	// protected function showAll($collection, $code = 200)
	// {
 //        if ( ! is_array(json_decode($collection, true))) {
 //            return $collection;
 //        }

	// 	return $this->successResponse(['data' => $collection], $code);
	// }

	// protected function showOne($model, $code = 200)
	// {
 //        if ( ! is_array(json_decode($model, true))) {
 //            return $model;
 //        }

	// 	return $this->successResponse(['data' => $model], $code);
	// }

	protected function showMessage($message, $code = 200)
	{
		return $this->successResponse(['data' => $message], $code);
	}
	
	protected function showAll($collection, $code = 200)
	{
		if ($collection->isEmpty()) {
			return $this->successResponse(['data' => $collection], $code);
		}

        if ( ! is_array(json_decode($collection, true))) {
            return $collection;
        }

		$transformer = $collection->first()->transformer;

		$collection = $this->transformData($collection, $transformer);

		return $this->successResponse($collection, $code);
	}

	protected function showOne($instance, $code = 200)
	{
        if ( ! is_array(json_decode($instance, true))) {
            return $instance;
        }

        $transformer = $instance->transformer;

        $instance = $this->transformData($instance, $transformer);

		return $this->successResponse($instance, $code);
	}

	protected function transformData($data, $transformer)
	{
		$transformation = fractal($data, new $transformer);

		return $transformation->toArray();
	}
}