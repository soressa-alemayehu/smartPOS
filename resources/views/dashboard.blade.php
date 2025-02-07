@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="mb-3">
        <h3>Welcome, Admin/h3>
    </div>
    <div class="row g-3 mb-3">
        <div class="col-md-3">
            <div class="card bg-primary text-white h-100">
                <div class="p-3">
                    <div class="fw-bold">Total Sales</div>
                    <div class="h4">Br {{ number_format($totalSales, 2) }}</div>
                    <small>+22% vs Last Month</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-dark text-white h-100">
                <div class="p-3">
                    <div class="fw-bold">Total Sales Return</div>
                    <div class="h4">Br {{ number_format($totalSalesReturn, 2) }}</div>
                    <small>-22% vs Last Month</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white h-100">
                <div class="p-3">
                    <div class="fw-bold">Total Purchase</div>
                    <div class="h4">Br {{ number_format($totalPurchase, 2) }}</div>
                    <small>+22% vs Last Month</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-white h-100">
                <div class="p-3">
                    <div class="fw-bold">Total Purchase Return</div>
                    <div class="h4">Br {{ number_format($totalPurchaseReturn, 2) }}</div>
                    <small>+22% vs Last Month</small>
                </div>
            </div>
        </div>
    </div>
    <div class="row g-3 mb-3">
        <div class="col-md-2">
            <div class="card h-100">
                <div class="p-3">
                    <div class="fw-bold">Profit</div>
                    <div class="h5">Br {{ number_format($profit, 2) }}</div>
                    <small class="text-success">+35% vs Last Month</small>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card h-100">
                <div class="p-3">
                    <div class="fw-bold">Invoice Due</div>
                    <div class="h5">Br {{ number_format($invoiceDue, 2) }}</div>
                    <small class="text-danger">-19% vs Last Month</small>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card h-100">
                <div class="p-3">
                    <div class="fw-bold">Total Expenses</div>
                    <div class="h5">Br {{ number_format($totalExpenses, 2) }}</div>
                    <small class="text-success">+41% vs Last Month</small>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card h-100">
                <div class="p-3">
                    <div class="fw-bold">Total Payment Returns</div>
                    <div class="h5">Br {{ number_format($totalPaymentReturns, 2) }}</div>
                    <small class="text-danger">-20% vs Last Month</small>
                </div>
            </div>
        </div>
    </div>
    <!-- Sales Last 30 day -->
    <div class="card mb-3">
        <div class="card-header bg-white d-flex justify-content-between">
            <div><b>Sales Last 30 day</b></div>
            <span>2025</span>
        </div>
        <div class="card-body">
            <canvas id="sales30Chart" height="60"></canvas>
        </div>
    </div>
    <!-- Sales Year -->
    <div class="card mb-3">
        <div class="card-header bg-white d-flex justify-content-between">
            <div><b>Sales current year</b></div>
            <span>2025</span>
        </div>
        <div class="card-body">
            <canvas id="salesYearChart" height="60"></canvas>
        </div>
    </div>
    <!-- Sales Payment Due -->
    <div class="card mb-5">
        <div class="card-header bg-white fw-bold">
            <span class="text-danger">Sales Payment Due</span>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Customers</th>
                        <th>Invoice No</th>
                        <th>Due Amount</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($duePayments as $person)
                    <tr>
                        <td>
                            <img src="{{ $person['avatar'] }}" class="rounded-circle" style="width:32px;height:32px;" alt="" />
                            {{ $person['name'] }}
                        </td>
                        <td>{{ $person['invoice'] }}</td>
                        <td><b>{{ $person['amount'] }}</b></td>
                        <td>
                            <button class="btn btn-sm btn-secondary"><i class="bi bi-eye"></i></button>
                            <button class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></button>
                            <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Line chart (Sales Last 30 day)
    new Chart(document.getElementById('sales30Chart').getContext('2d'), {
        type: 'line',
        data: {
            labels: [...Array(30).keys()].map(x => (x+1)+'-Sep'),
            datasets: [{
                label: 'Sales',
                data: @json($sales30),
                backgroundColor: 'rgba(253, 160, 0, 0.1)',
                borderColor: '#fd8800',
                fill: true,
                tension: 0.4
            }]
        },
        options: { responsive:true, plugins:{legend:{display:false}}, scales:{ y: {beginAtZero:true} } }
    });

    // Line chart (Sales this year)
    new Chart(document.getElementById('salesYearChart').getContext('2d'), {
        type: 'line',
        data: {
            labels: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
            datasets: [{
                label: 'Sales',
                data: @json($salesYear),
                backgroundColor: 'rgba(253, 160, 0, 0.1)',
                borderColor: '#fd8800',
                fill: true,
                tension: 0.4
            }]
        },
        options: { responsive:true, plugins:{legend:{display:false}}, scales:{ y: {beginAtZero:true} } }
    });
</script>
@endpush