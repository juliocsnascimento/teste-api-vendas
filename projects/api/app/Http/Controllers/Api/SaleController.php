<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateSalesRequest;
use App\Http\Resources\SaleResource;
use App\Models\Sale;
use Illuminate\Http\Response;

class SaleController extends Controller
{
    public function __construct(protected Sale $repository)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sales = $this->repository->paginate();

        return SaleResource::collection($sales);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUpdateSalesRequest $request)
    {
        $data = $request->validated();

        $sale = $this->repository->create($data);

        return new SaleResource($sale);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $sale = $this->repository->findOrFail($id);

        return new SaleResource($sale);
    }

    /**
     * Display the specified resource.
     */
    public function bySeller(string $seller)
    {
        $sales = $this->repository->where('seller', $seller)->orderBy('date', 'desc')->orderBy('id', 'desc')->get();

        return SaleResource::collection($sales);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUpdateSalesRequest $request, string $id)
    {
        $data = $request->validated();

        $sale = $this->repository->findOrFail($id);
        $sale->update($data);

        return new SaleResource($sale);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $sale = $this->repository->findOrFail($id);
        $sale->delete();

        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
