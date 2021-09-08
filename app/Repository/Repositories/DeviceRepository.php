<?php


namespace App\Repository\Repositories;


use App\Models\Device;
use App\Repository\Interface\DeviceRepositoryInterface;
use App\Repository\BaseRepository;

class DeviceRepository extends BaseRepository implements DeviceRepositoryInterface
{
    /**
     * UserRepository constructor.
     *
     * @param Device $model
     */
    public function __construct(Device $model)
    {
        parent::__construct($model);
    }

}
