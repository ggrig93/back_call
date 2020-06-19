<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\NewRequestRepositoryInterface;

class HomeController extends Controller
{
    private $requestInterface;

    public function __construct(NewRequestRepositoryInterface $newRequestInterface)
    {
        $this->requestInterface = $newRequestInterface;
    }

    public function index()
    {
        $requests = $this->requestInterface->all();

        return view('home', compact('requests'));
    }
}
