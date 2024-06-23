@extends('layouts.main')
@section('container')
{{-- <div class="container"> --}}
    <h1>Welcome {{ Auth::user()->name }}!</h1>
    <div class="row mb-4 mt-5">
        <div class="col-lg-4 col-sm-6">
            <div class="card text-white mb-3" style="background-color: #3D5EE1">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <strong class="card-title">Books</strong>
                            <h3 class="card-text text-white">{{ $bookCount }}</h3>
                        </div>
                        <div>
                            <i class="fas fa-book fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-6">
            <div class="card text-white mb-3" style="background-color: #3D5EE1">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <strong class="card-title">Book Categories</strong>
                            <h3 class="card-text text-white">{{ $categoryCount }}</h3>
                        </div>
                        <div>
                            <i class="fas fa-tags fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-6">
            <div class="card text-white mb-3" style="background-color: #3D5EE1">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <strong class="card-title">Book Borrowing</strong>
                            <h3 class="card-text text-white">{{ $bookBorrowedCount }}</h3>
                        </div>
                        <div>
                            <i class="fas fa-book-reader fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-6">
            <div class="card text-white mb-3" style="background-color: #3D5EE1">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <strong class="card-title">Book Returned</strong>
                            <h3 class="card-text text-white">{{ $bookReturnCount }}</h3>
                        </div>
                        <div>
                            <i class="fas fa-undo fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-6">
            <div class="card text-white mb-3" style="background-color: #3D5EE1">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <strong class="card-title">Patron Borrow</strong>
                            <h3 class="card-text text-white">{{ $studentBorrowCount }}</h3>
                        </div>
                        <div>
                            <i class="fas fa-user-check fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-6">
            <div class="card text-white mb-3" style="background-color: #3D5EE1">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <strong class="card-title">Patron Returned</strong>
                            <h3 class="card-text text-white">{{ $studentReturnedCount }}</h3>
                        </div>
                        <div>
                            <i class="fas fa-undo fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="card mb-3" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                <div class="card-header" style="background-color: #3d5ee1ee; color:white"><strong>Overview</strong></div>
                <div class="card-body" style="background-color: #f8f9fa;">
                    <canvas id="overviewChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card mb-3" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                <div class="card-header" style="background-color: #3d5ee1ee; color:white"><strong>Number of Borrowed Books</strong></div>
                <div class="card-body" style="background-color: #f8f9fa;">
                    <canvas id="borrowsChart"></canvas>
                </div>
            </div>
        </div>
    </div>
{{-- </div> --}}

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Overview Chart
        var overviewCtx = document.getElementById('overviewChart').getContext('2d');
        var overviewChart = new Chart(overviewCtx, {
            type: 'bar',
            data: {
                labels: @json($overviewData['labels']),
                datasets: [{
                    label: 'Overview Data',
                    data: @json($overviewData['data']),
                    backgroundColor: '#3D5EE1',
                    borderColor: '#3D5EE1',
                    borderWidth: 0,
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Borrows Chart
        var borrowsCtx = document.getElementById('borrowsChart').getContext('2d');
        var borrowsChart = new Chart(borrowsCtx, {
            type: 'line',
            data: {
                labels: @json($borrowsData['labels']),
                datasets: [{
                    label: 'Number of Borrowed Books',
                    data: @json($borrowsData['data']),
                    backgroundColor: '#3D5EE1',
                    borderColor: '#3D5EE1',
                    borderWidth: 2,
                    fill: false
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>
@endsection
