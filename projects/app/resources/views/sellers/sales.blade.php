@extends('layout')

@section('content')
<div class="container-xxl">
    <div class="border-botton">
        <div class="row align-items-center justify-content-between ">
            <div class="col col-auto">
                <div class="search-box">
                    <h1 class="mb-4">Alterar de Vendedor</h1>
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
        @if (isset($response->errors))
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

        <div class="card mb-3">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h5 class="mb-0">Detalhes</h5>
                    </div>
                    <div class="col-auto"></div>
                </div>
            </div>

            <div class="card-body bg-body-tertiary border-top">
                <div class="row">
                    <div class="col-lg col-xxl-5">
                        <h6 class="fw-semi-bold ls mb-3 text-uppercase">Dados do Vendedor</h6>
                        <div class="row">
                            <div class="col-5 col-sm-4">
                                <p class="fw-semi-bold mb-1">ID</p>
                            </div>
                            <div class="col">{{ $response->data->id}}</div>
                        </div>
                        <div class="row">
                            <div class="col-5 col-sm-4">
                                <p class="fw-semi-bold mb-1">Nome</p>
                            </div>
                            <div class="col">{{ $response->data->name }}</div>
                        </div>
                        <div class="row">
                            <div class="col-5 col-sm-4">
                                <p class="fw-semi-bold mb-1">Email</p>
                            </div>
                            <div class="col"><a href="mailto:{{ $response->data->email }}">{{ $response->data->email}}</a></div>
                        </div>
                        <div class="row">
                            <div class="col-5 col-sm-4">
                                <p class="fw-semi-bold mb-1">Comissão (%)</p>
                            </div>
                            <div class="col">
                                <p class="fst-italic text-400 mb-1">@money($response->data->sales_commission)</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg col-xxl-5 mt-4 mt-lg-0 offset-xxl-1">
                        <h6 class="fw-semi-bold ls mb-3 text-uppercase">Nova Venda</h6>

                        <form method="post" action="{{ route('sellers.salescreate', [ 'id' => $response->data->id ]) }}">
                            <div class="row mb-3">
                                <label for="value" class="col-sm-2 col-form-label">Valor</label>
                                <div class="col-sm-5">
                                    <input type="number" step="0.01" class="form-control" id="value" name="value" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="date" class="col-sm-2 col-form-label">Data</label>
                                <div class="col-sm-5">
                                    <input type="date" class="form-control" id="date" name="date" value="{{ (new \DateTime())->format('Y-m-d') }}" required>
                                </div>
                            </div>
                            <input type="hidden" name="id" value="{{ $response->data->id }}">
                            <input type="hidden" name="name" value="{{ $response->data->id }}">
                            <input type="hidden" name="email" value="{{ $response->data->id }}">
                            <input type="hidden" name="sales_commission" value="{{ $response->data->id }}">
                            <input type="hidden" name="seller" value="{{ $response->data->id }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </form>

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
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Venda(s)</h5>
            </div>
            <div class="card-body border-top p-0">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th class="text-center">Comissão (%)</th>
                            <th class="text-center">Valor da comissão (R$)</th>
                            <th class="text-center">Valor da venda (R$)</th>
                            <th class="text-center">Data da venda</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($sales->data))
                        @foreach($sales->data as $sale)
                        <tr>
                            <td>{{ $sale->id }}</td>
                            <td class="text-center">@money($sale->saller_commission_percent)</td>
                            <td class="text-center">@money($sale->saller_commission_value)</td>
                            <td class="text-center">@money($sale->value)</td>
                            <td class="text-center">{{ (new \DateTime($sale->date))->format('d/m/Y') }}</td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="5">
                                <p class="text-center">Nenhum Dado Encontrado.</p>
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="card-footer bg-body-tertiary p-0"></div>
        </div>
    </div>
</div>
@endsection