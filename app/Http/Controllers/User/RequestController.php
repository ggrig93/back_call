<?php

namespace App\Http\Controllers\User;

use App\Helpers\Util;
use App\Http\Controllers\Controller;
use App\Http\Requests\NewRequest;
use App\Models\Request as ModelRequest;
use App\Repositories\Interfaces\NewRequestRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RequestController extends Controller
{
    private $requestInterface;

    public function __construct(NewRequestRepositoryInterface $newRequestInterface)
    {
        $this->requestInterface = $newRequestInterface;
    }

    public function show(ModelRequest $request)
    {
        return response()->json($request, Response::HTTP_OK);
    }

    public function store(NewRequest $request)
    {
        if (!auth()->user()->hasLimit()) {
            return redirect('/requests')->with('limit_expired', 'Sorry, you can send a request only once in a day.');
        }

        $this->requestInterface->createDirectory($request);

        $path = $this->requestInterface->storeImage($request);

        $newRequest = $this->requestInterface->save($request, $path);

        return redirect('/requests/' . $newRequest->id);

    }

    public function toggleSeen(Request $request)
    {
        if ($this->requestInterface->toggleSeen($request)) {

            $message = Util::updatedMessage();

            return response()->json([
                'status' => 'ok',
                'message' => $message

            ], Response::HTTP_OK);
        }
    }
}
