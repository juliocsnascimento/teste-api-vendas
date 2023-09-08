<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateSellerRequest;
use App\Http\Resources\SellerResource;
use App\Models\Seller;
use Illuminate\Http\Response;

class SellerController extends Controller
{
    public function __construct(protected Seller $repository)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sellers = $this->repository->paginate();

        return SellerResource::collection($sellers);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUpdateSellerRequest $request)
    {
        $data = $request->validated();

        $seller = $this->repository->create($data);

        return new SellerResource($seller);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $seller = $this->repository->findOrFail($id);

        return new SellerResource($seller);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUpdateSellerRequest $request, string $id)
    {
        $data = $request->validated();

        $seller = $this->repository->findOrFail($id);
        $seller->update($data);

        return new SellerResource($seller);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $seller = $this->repository->findOrFail($id);
        $seller->delete();

        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
