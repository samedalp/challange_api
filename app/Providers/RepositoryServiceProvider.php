<?php

namespace App\Providers;

use App\Repository\BaseRepositoryInterface;
use App\Repository\Interface\DeviceRepositoryInterface;
use App\Repository\BaseRepository;
use App\Repository\Repositories\DeviceRepository;
use Illuminate\Support\ServiceProvider;

/**
 * Class RepositoryServiceProvider
 * @package App\Providers
 */
class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(BaseRepositoryInterface::class, BaseRepository::class);
        $this->app->bind(DeviceRepositoryInterface::class, DeviceRepository::class);
    }
}
