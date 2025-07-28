<!-- resources/views/reports/seat-report.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h2 class="mb-0"><i class="fas fa-chair me-2"></i>Flight Seats Report</h2>
        </div>
        
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>Seat Type</th>
                            <th>Total Seats</th>
                            <th>Booked Seats</th>
                            <th>Available Seats</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reportData as $data)
                        <tr>
                            <td class="fw-bold">{{ $data['name'] }}</td>
                            <td>{{ $data['total'] }}</td>
                            <td>
                                <span class="badge bg-danger">{{ $data['booked'] }}</span>
                            </td>
                            <td>
                                <span class="badge bg-success">{{ $data['available'] }}</span>
                            </td>
                            <td>
                                <div class="progress" style="height: 20px;">
                                    <div class="progress-bar 
                                        {{ $data['percentage'] > 90 ? 'bg-danger' : 
                                           ($data['percentage'] > 70 ? 'bg-warning' : 'bg-success') }}"
                                        role="progressbar" 
                                        style="width: {{ $data['percentage'] }}%"
                                        aria-valuenow="{{ $data['percentage'] }}" 
                                        aria-valuemin="0" 
                                        aria-valuemax="100">
                                        {{ round($data['percentage']) }}%
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="mt-4 p-3 bg-light rounded">
                <h4><i class="fas fa-chart-pie me-2"></i>Summary</h4>
                <div class="row mt-3">
                    @foreach($reportData as $data)
                    <div class="col-md-3 mb-3">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body text-center">
                                <h5 class="card-title">{{ $data['name'] }}</h5>
                                <div class="d-flex justify-content-around mt-3">
                                    <div>
                                        <span class="text-danger"><i class="fas fa-user-check"></i> {{ $data['booked'] }}</span>
                                        <div class="small">Booked</div>
                                    </div>
                                    <div>
                                        <span class="text-success"><i class="fas fa-user-clock"></i> {{ $data['available'] }}</span>
                                        <div class="small">Available</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        
        <div class="card-footer text-muted">
            <small>Report generated on {{ now()->format('M d, Y h:i A') }}</small>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .progress-bar {
        font-weight: 600;
        text-shadow: 1px 1px 1px rgba(0,0,0,0.3);
    }
    .card {
        border-radius: 10px;
        overflow: hidden;
    }
    .table th {
        background: #2c3e50;
        color: white;
    }
    .table-hover tbody tr:hover {
        background-color: rgba(41, 128, 185, 0.1);
    }
</style>
@endpush