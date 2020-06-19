<?php

namespace App\Providers;

use App\Repositories\Interfaces\NewRequestRepositoryInterface;
use App\Repositories\RequestRepository;
use Illuminate\Support\ServiceProvider;

class NewRequestProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            NewRequestRepositoryInterface::class,
            RequestRepository::class
        );
    }

}
