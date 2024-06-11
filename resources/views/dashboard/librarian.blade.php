@extends('layouts.main')

@section('title', 'Librarian Dashboard')

@section('container')
<div class="container">
    <h1>Welcome {{ Auth::user()->name }}!</h1>
    <div class="row mb-4 mt-5">
        <div class="col-lg-4 col-sm-6">
            <div class="card text-white mb-3" style="background-color: #3D5EE1">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <strong class="card-title">Total Books</strong>
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
                            <strong class="card-title">Total Categories</strong>
                            <h3 class="card-text text-white">{{ $categoryCount }}</h3>
                        </div>
                        <div>
                            <i class="fas fa-list-alt fa-2x"></i>
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
                            <strong class="card-title">Patron Borrow</strong>
                            <h3 class="card-text text-white">{{ $studenBorrowCount }}</h3>
                        </div>
                        <div>
                            <i class="fas fa-user fa-2x"></i>
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
            <div class="card mb-3">
                <div class="card-header">Overview</div>
                <div class="card-body">
                    <canvas id="overviewChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card mb-3">
                <div class="card-header">Number of Borrows</div>
                <div class="card-body">
                    <canvas id="borrowsChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

