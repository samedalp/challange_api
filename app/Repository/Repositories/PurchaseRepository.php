<?php


namespace App\Repository\Repositories;


use App\Models\Device;
use App\Models\Purchase;
use App\Repository\Interface\DeviceRepositoryInterface;
use App\Repository\BaseRepository;
use App\Repository\Interface\PurchaseRepositoryInterface;

class PurchaseRepository extends BaseRepository implements PurchaseRepositoryInterface
{
    /**
     * UserRepository constructor.
     *
     * @param Purchase $model
     */
    public function __construct(Purchase $model)
    {
        parent::__construct($model);
    }

}
