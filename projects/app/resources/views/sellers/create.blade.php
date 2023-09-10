@extends('layout')

@section('content')
<div class="container-xxl">
    <div class="border-botton">
        <div class="row align-items-center justify-content-between ">
            <div class="col col-auto">
                <div class="search-box">
                    <h1 class="mb-4">Cadastrar de Vendedor</h1>
                </div>
            </div>
            <div class="col-auto">
                <div class="d-flex align-items-center">
                    <a class="btn btn-secondary rounded-pill btn-sm" href="{{ route('sellers.index') }}">
                        <i class="bi bi-back me-1"></i>
                        Voltar
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div>

        @if ($response)
        <div class="pt-2">
            <div class="alert alert-danger alert-dismissible">
                <ul>
                    @foreach ($response->errors as $messages)
                    @foreach ($messages as $message)
                    <li>{{ $message }}</li>
                    @endforeach
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
        @endif

        <form method="post" action="{{ route('sellers.store') }}">
            <div class="row mb-3">
                <label for="name" class="col-sm-2 col-form-label">Nome</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="name" name="name" value="{{$body['name'] ?? ''}}" required>
                </div>
            </div>
            <div class="row mb-3">
                <label for="email" class="col-sm-2 col-form-label">E-Mail</label>
                <div class="col-sm-5">
                    <input type="email" class="form-control" id="email" name="email" value="{{$body['email'] ?? ''}}" required>
                </div>
            </div>
            <div class="row mb-3">
                <label for="sales_commission" class="col-sm-2 col-form-label">Comissão (%)</label>
                <div class="col-sm-2">
                    <input type="number" step="0.5" class="form-control" id="sales_commission" name="sales_commission" value="{{$body['sales_commission'] ?? ''}}" required>
                </div>
            </div>

            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
    </div>
</div>
@endsection