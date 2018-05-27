<?php

namespace App\Http\Controllers\Service;

use Illuminate\Http\Request;
use App\Contracts\ServiceRepository;
use App\Http\Controllers\ApiController;

class ServiceCategoryController extends ApiController
{
    protected $service;

    /**
     * Constructor injected with Admin User Repository
     * @param UserRepository $service User repository with Eloquent
     */
    public function __construct(ServiceRepository $service)
    {
        $this->service = $service;
    }    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($service_id)
    {
        $categories = $this->service->getCategories($service_id);

        return $this->showAll($categories);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($service_id, $category_id)
    {
        $categories = $this->service->addCategory($service_id, $category_id);

        return $this->showAll($categories);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($service_id, $category_id)
    {
        $categories = $this->service->removeCategory($service_id, $category_id);

        return $this->showAll($categories);
    }
}
