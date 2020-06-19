<?php

namespace App\Repositories\Interfaces;

interface NewRequestRepositoryInterface
{
    public function all();

    public function save($request, $path);

    public function storeImage($request);

    public function createDirectory($request);

    public function toggleSeen($request);

}
