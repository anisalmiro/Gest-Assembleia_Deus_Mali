@extends('layouts.app')

@section('title', 'Dashboard - Assembleia')
@section('page-title', 'Dashboard')

@section('content')
<div class="row">
    <!-- Cards de Estatísticas -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total de Membros
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalMembers }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Contribuicoes da Sede
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><p class="text-success">
                                Total: MZN {{ number_format(
                                    $monthlyTithes +
                                    $monthlyDonations +
                                    $monthlyCollections +
                                    $monthlyMissionCollections +
                                    $monthlySocialActions +
                                    $monthlyThanksgivings +
                                    $monthlyYouth +
                                    $monthlyCentralCell +
                                    $monthlyCell2 +
                                    $monthlyCell3 +
                                    $monthlyCell4 +
                                    $monthlyCell5 +
                                    $monthlyCell6 +
                                    $monthlyCell7 +
                                    $monthlyCell8 +
                                    $monthlyTitheOfTithes +
                                    $monthlyXicotelas, 2, ',', '.') }}
                            </p></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-hand-holding-usd fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Doações do Mês
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">Meticais {{ number_format($monthlyDonations, 2, ',', '.') }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-heart fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Despesas do Mês
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">Meticais {{ number_format($monthlyExpenses, 2, ',', '.') }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-money-bill-wave fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Resumo Financeiro -->
    <div class="col-lg-6 mb-4">
        <div class="card shadow">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-chart-pie me-2"></i>
                    Resumo Financeiro do Mês
                </h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="text-success">Entradas</h6>
                        <p class="mb-1">Dízimos: <strong>MZN {{ number_format($monthlyTithes, 2, ',', '.') }}</strong></p>
                        <p class="mb-1">Doações: <strong>MZN {{ number_format($monthlyDonations, 2, ',', '.') }}</strong></p>
                        <p class="mb-1">Coletas: <strong>MZN {{ number_format($monthlyCollections, 2, ',', '.') }}</strong></p>
                        <p class="mb-1">Coletas Missões: <strong>MZN {{ number_format($monthlyMissionCollections, 2, ',', '.') }}</strong></p>
                        <p class="mb-1">Ação Social: <strong>MZN {{ number_format($monthlySocialActions, 2, ',', '.') }}</strong></p>
                        <p class="mb-1">Agradecimentos: <strong>MZN {{ number_format($monthlyThanksgivings, 2, ',', '.') }}</strong></p>
                        <p class="mb-1">Jovens: <strong>MZN {{ number_format($monthlyYouth, 2, ',', '.') }}</strong></p>
                        <p class="mb-1">Célula Central: <strong>MZN {{ number_format($monthlyCentralCell, 2, ',', '.') }}</strong></p>
                        <p class="mb-1">Célula 2: <strong>MZN {{ number_format($monthlyCell2, 2, ',', '.') }}</strong></p>
                        <p class="mb-1">Célula 3: <strong>MZN {{ number_format($monthlyCell3, 2, ',', '.') }}</strong></p>
                        <p class="mb-1">Célula 4: <strong>MZN {{ number_format($monthlyCell4, 2, ',', '.') }}</strong></p>
                        <p class="mb-1">Célula 5: <strong>MZN {{ number_format($monthlyCell5, 2, ',', '.') }}</strong></p>
                        <p class="mb-1">Célula 6: <strong>MZN {{ number_format($monthlyCell6, 2, ',', '.') }}</strong></p>
                        <p class="mb-1">Célula 7: <strong>MZN {{ number_format($monthlyCell7, 2, ',', '.') }}</strong></p>
                        <p class="mb-1">Célula 8: <strong>MZN {{ number_format($monthlyCell8, 2, ',', '.') }}</strong></p>
                        <p class="mb-1">Dízimos dos Dízimos: <strong>MZN {{ number_format($monthlyTitheOfTithes, 2, ',', '.') }}</strong></p>
                        <p class="mb-1">Xicotelas: <strong>MZN {{ number_format($monthlyXicotelas, 2, ',', '.') }}</strong></p>
                        <hr>
                        <p class="text-success">
                            <strong>Total: MZN {{ number_format(
                                $monthlyTithes +
                                $monthlyDonations +
                                $monthlyCollections +
                                $monthlyMissionCollections +
                                $monthlySocialActions +
                                $monthlyThanksgivings +
                                $monthlyYouth +
                                $monthlyCentralCell +
                                $monthlyCell2 +
                                $monthlyCell3 +
                                $monthlyCell4 +
                                $monthlyCell5 +
                                $monthlyCell6 +
                                $monthlyCell7 +
                                $monthlyCell8 +
                                $monthlyTitheOfTithes +
                                $monthlyXicotelas, 2, ',', '.') }}</strong>
                        </p>
                    </div>


                    <div class="col-md-6">
                        <h6 class="text-danger">Saídas</h6>
                        <p class="mb-1">Despesas: <strong>MZN {{ number_format($monthlyExpenses, 2, ',', '.') }}</strong></p>
                        <hr>
                        <p class="text-{{ ($monthlyTithes + $monthlyDonations + $monthlyCollections - $monthlyExpenses) >= 0 ? 'success' : 'danger' }}">
                            <strong>Saldo: MZN {{ number_format($monthlyTithes + $monthlyDonations + $monthlyCollections - $monthlyExpenses, 2, ',', '.') }}</strong>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Patrimônio -->
    <div class="col-lg-6 mb-4">
        <div class="card shadow">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-boxes me-2"></i>
                    Patrimônio da Igreja
                </h6>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-md-6">
                        <h4 class="text-primary">{{ $totalAssets }}</h4>
                        <p class="mb-0">Total de Itens</p>
                    </div>
                    <div class="col-md-6">
                        <h4 class="text-success">MZN {{ number_format($totalAssetsValue, 2, ',', '.') }}</h4>
                        <p class="mb-0">Valor Total</p>
                    </div>
                </div>
                <div class="mt-3">
                    <a href="{{ route('assets.index') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-eye me-1"></i>
                        Ver Patrimônio
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Últimas Transações -->
    <div class="col-lg-6 mb-4">
        <div class="card shadow">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-list me-2"></i>
                    Últimas Transações
                </h6>
                <a href="{{ route('financial-transactions.index') }}" class="btn btn-primary btn-sm">Ver Todas</a>
            </div>
            <div class="card-body">
                @if($recentTransactions->count() > 0)
                @foreach($recentTransactions as $transaction)
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <div>
                        <strong>{{ $transaction->member ? $transaction->member->full_name : 'Anônimo' }}</strong>
                        <br>
                        <small class="text-muted">
                            {{ ucfirst($transaction->type) }} - {{ $transaction->transaction_date->format('d/m/Y') }}
                        </small>
                    </div>
                    <span class="badge bg-success">MZN {{ number_format($transaction->amount, 2, ',', '.') }}</span>
                </div>
                @if(!$loop->last)<hr>@endif
                @endforeach
                @else
                <p class="text-muted">Nenhuma transação registrada.</p>
                @endif
            </div>
        </div>
    </div>

    <!-- Últimas Despesas -->
    <div class="col-lg-6 mb-4">
        <div class="card shadow">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-receipt me-2"></i>
                    Últimas Despesas
                </h6>
                <a href="{{ route('expenses.index') }}" class="btn btn-primary btn-sm">Ver Todas</a>
            </div>
            <div class="card-body">
                @if($recentExpenses->count() > 0)
                @foreach($recentExpenses as $expense)
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <div>
                        <strong>{{ Str::limit($expense->description, 30) }}</strong>
                        <br>
                        <small class="text-muted">
                            {{ $expense->category }} - {{ $expense->expense_date->format('d/m/Y') }}
                        </small>
                    </div>
                    <span class="badge bg-danger">MZN {{ number_format($expense->amount, 2, ',', '.') }}</span>
                </div>
                @if(!$loop->last)<hr>@endif
                @endforeach
                @else
                <p class="text-muted">Nenhuma despesa registrada.</p>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
    .border-left-primary {
        border-left: 0.25rem solid #4e73df !important;
    }
    .border-left-success {
        border-left: 0.25rem solid #1cc88a !important;
    }
    .border-left-info {
        border-left: 0.25rem solid #36b9cc !important;
    }
    .border-left-warning {
        border-left: 0.25rem solid #f6c23e !important;
    }
</style>
@endsection

