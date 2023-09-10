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
     * Update the specified resource in storage.
     */
    public function edit(Request $request, string $id = null)
    {
        if ($request->method() === 'GET') {
            $response = ((new SellerRepository)->get("/sellers/{$id}"))->object();
            if (!isset($response->data)) {
                return redirect()->back()->with('error', 'Falha ao localizar o cadastro!');
            }
        }

        if ($request->method() === 'POST') {
            $body = $request->all();

            $response = ((new SellerRepository)->put('/sellers/' . $body['id'], $body))->object();
            if (isset($response->data)) {
                return redirect()->route('sellers.index')->with(['success' => 'Cadastro alterado com sucesso!']);
            }
            $response->data = (object)$body;
        }

        //dd($response);
        return view('sellers/edit', ['response' => $response ?? []]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
