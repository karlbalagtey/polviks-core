<?php

namespace App\Repositories;

use App\Models\Service;
use App\Traits\ApiResponser;
use App\Contracts\ServiceRepository;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ServiceEloquentRepository implements ServiceRepository
{
    use ApiResponser;

	protected $service;

    /**
     * Constructor injects Agent Model
     * @param User       $service  User model
     * @param Curriculum $class Curriculum
     */
	public function __construct(Service $service)
	{
		$this->service = $service;
	}

    /**
     * Returns all users
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAll()
	{
		return $this->service->all();
	}

    /**
     * Returns one user
     * @param $id
     * @return mixed
     */
    public function getAgentService($agent_id, $service_id)
    {
        $service = $this->service->findOrfail($service_id);

        $this->checkAgent($agent_id, $service);

        return $service;
    }

    /**
     * Returns one user
     * @param $id
     * @return mixed
     */
    public function show($id)
	{
		return $this->service->findOrfail($id);
	}

    /**
     * Return service via slug
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function showBySlug($slug)
    {
        return $this->service->where('slug', $slug)->first();
    }

    /**
     * Creates new user and returns $service
     * @param $data
     * @return mixed
     */
    public function store($request, $id)
    {
        $data = $request->all();

        $data['status'] = Service::UNAVAILABLE_SERVICE;
        $data['agent_id'] = $id;

        $service = Service::create($data);

        return $service;
    }

    /**
     * Updates user and returns $service
     * @param $request
     * @param $id
     * @return mixed
     */
    public function update($agent_id, $service_id, $request)
    {
        $service = $this->getAgentService($agent_id, $service_id);

        $service->fill($request->only([
            'name',
            'description',
            'quantity',
        ]));

        if ($request->has('status')) {
            $service->status = $request->status;
            
            if ($service->isAvailable() && $service->categories()->count() == 0) {
                return $this->errorResponse('An active service must have at least one category', 409);
            }
        }

        if ($service->isClean()) {
            return $this->errorResponse('You need to specify a different value to update', 422);
        }

        $service->save();

        return $service;
    }

    /**
     * Deletes service
     * @param $id
     * @return int
     */
    public function destroy($agent_id, $service_id)
    {
        $service = $this->getAgentService($agent_id, $service_id);

        $service->delete();

        return $service;
    }

    /**
     * Checks agent if its correct
     * @param  [type] $request [description]
     * @param  [type] $id      [description]
     * @return [type]          [description]
     */
    protected function checkAgent($agent_id, $service)
    {   
        if ($agent_id != $service->agent_id) {
            throw new HttpException(422, 'The specified agent is not the actual seller of this service');
        }
    }

}