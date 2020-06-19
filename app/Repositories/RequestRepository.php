<?php

namespace App\Repositories;

use App\Models\Request;
use App\Repositories\Interfaces\NewRequestRepositoryInterface;
use Illuminate\Support\Facades\Storage;

class RequestRepository implements NewRequestRepositoryInterface
{
    private $seen = 2;
    private $notSeen = 3;

    public function createDirectory($request)
    {
        $storage = Storage::disk('public');
        $authId = auth()->user()->id;

        if ($storage->exists($authId)) {
            $storage->makeDirectory($authId);
        }
    }

    public function all()
    {
        if (!auth()->user()->hasRole(['manager'])) {
            return [];
        }

        return Request::with(['user' => function ($query) {
            $query->select('id', 'name', 'email');
        }])
            ->with('status')
            ->select('id', 'title', 'body', 'image_path', 'user_id','status_id','created_at')
            ->cursor();
    }

    public function storeImage($request)
    {
        if (!$request->image) {
            return null;
        }

        return Storage::disk('public')->putFileAs(
            auth()->user()->id, $request->file('image'), $this->imageName($request)
        );
    }

    public function save($request, $path)
    {
        return auth()->user()->requests()->create([
            'title' => $request->title,
            'body' => $request->body,
            'image_path' => $path,
        ]);
    }

    private function imageName($request)
    {
        return time() . '.' . $request->file('image')->extension();
    }

    public function toggleSeen($request)
    {
        if (isset($request->requests['seen'])) {
            Request::whereIn('id', array_values($request->requests['seen']))->update(['status_id' => $this->seen]);
        }
        if (isset($request->requests['not_seen'])) {
            Request::whereIn('id', array_values($request->requests['not_seen']))->update(['status_id' => $this->notSeen]);
        }

        return true;

    }

}
