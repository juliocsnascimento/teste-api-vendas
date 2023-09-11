@extends('layout')

@section('content')
<div class="container-xxl">
    <div class="border-botton">
        <div class="row align-items-center justify-content-between ">
            <div class="col col-auto">
                <div class="search-box">
                    <h1 class="mb-4">Lista de Vendedores</h1>
                </div>
            </div>
            <div class="col-auto">
                <div class="d-flex align-items-center">
                    <a class="btn btn-primary rounded-pill btn-sm" href="{{ route('sellers.create') }}">
                        <i class="bi bi-person-plus-fill me-1"></i>
                        Incluir Vendedor
                    </a>
                </div>
            </div>
        </div>
    </div>
    @if (session()->has('success'))
    <div class="pt-2">
        <div class="alert alert-success alert-dismissible">
            @if(is_array(session('success')))
            <ul>
                @foreach (session('success') as $message)
                <li>{{ $message }}</li>
                @endforeach
            </ul>
            @else
            {{ session('success') }}
            @endif
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    @endif
    @if (session()->has('error'))
    <div class="pt-2">
        <div class="alert alert-danger alert-dismissible">
            @if(is_array(session('error')))
            <ul>
                @foreach (session('error') as $message)
                <li>{{ $message }}</li>
                @endforeach
            </ul>
            @else
            {{ session('error') }}
            @endif
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    @endif
    <div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th class="text-center">Comissão (%)</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                @forelse($results->data as $result)
                <tr>

                    <td>{{ $result->id }}</td>
                    <td>{{ $result->name }}</td>
                    <td>{{ $result->email }}</td>
                    <td class="text-center">@money($result->sales_commission)</td>
                    <td class="text-center">
                        <a class="btn btn-outline-primary btn-sm" href="{{ route('sellers.show', [ 'id' => $result->id ]) }}" title="Editar">
                            <span class="bi bi-pencil-square"></span>
                        </a>
                        <a class="btn btn-outline-danger btn-sm" href="{{ route('sellers.sales', [ 'id' => $result->id ]) }}" title="Vendas">
                            <span class="bi bi-currency-dollar"></span>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4">
                        <p class="text-center">Nenhum Dado Encontrado.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection