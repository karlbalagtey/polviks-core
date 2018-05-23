<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponser;
use App\Http\Requests;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class ApiController extends Controller
{

  use ApiResponser;
	
	/**
	 * status code
	 * 
	 * @var integer
	 */
	protected $statusCode = 200;

	/**
	 * get Status code
	 * 
	 * @return integer
	 */
	public function getStatusCode()
	{
		return $this->statusCode;
	}

	/**
	 * Set status code
	 * 
	 * @param integer $code 
	 */
	public function setStatusCode($code)
	{
		$this->statusCode = $code;

		return $this;
	}

	/**
	 * Will receive data and headers
	 * 
	 * @param  array  $data    
	 * @param  array  $headers 
	 * @return Illuminate\Http\Response        
	 */
	protected function respond(array $data, $headers = [])
	{
		return response()->json($data, $this->getStatusCode(), $headers);
	}

	/**
	 * Return message after processing request
	 * 
	 * @param  string $message 
	 * @return mixed
	 */
   protected function respondProcessed($message = 'Successfully added')
   {
   		return $this->setStatusCode(HttpResponse::HTTP_CREATED)
   					->respondWithSuccessMessage($message);
   }

   /**
    * Will return not found
    * 
    * @param  string $message 
    * @return Response
    */
   public function respondNotFound($message = 'Not found')
   {
   		return $this->setStatusCode(HttpResponse::HTTP_NOT_FOUND)
   					->respondWithError($message);
   }

   /**
    * will return message error
    * 
    * @param  string $message
    * @return Response
    */
   public function respondWithError($message)
   {
   		return $this->respond([

   			'error' => [

   				'message' => $message,

   				'code' => $this->getStatusCode()
   			]
   		]);
   }

   /**
    * Will return success message 
    * 
    * @param  string $message [description]
    * @return Response
    */
   public function respondWithSuccessMessage($message)
   {
   		return $this->respond([

   			'data' => [

   				'message' => $message,

   				'code' => $this->getStatusCode()
   			]
   		]);
   }
}