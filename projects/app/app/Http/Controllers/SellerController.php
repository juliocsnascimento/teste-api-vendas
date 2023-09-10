<?php

namespace App\Http\Controllers;

use App\Repositories\SellerRepository;
use Illuminate\Http\Request;

class SellerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sellers = ((new SellerRepository)->get('/sellers'))->object();
        return view('sellers', ['results' => $sellers]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if ($request->method() === 'POST') {
            $body = $request->all();

            $response = ((new SellerRepository)->post('/sellers', $body))->object();

            if (isset($response->data)) {
                return redirect()->route('sellers.index')->with(['success' => 'Cadastro realizado com sucesso!']);
            }
        }

        return view('sellers/create', ['body' => $body ?? [], 'response' => $response ?? []]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        dd($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
