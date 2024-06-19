@extends('layouts.main')

@section('container')

<div class="container mt-5">
    <!-- Breadcrumbs -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="background-color: transparent; border: none;">
            @if (Auth::user()->role == 'Super Admin')
                <li class="breadcrumb-item"><a href="{{ route('superAdmin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Super Admin Dashboard</li>
            @endif
        </ol>
    </nav>
    <div class="card shadow-sm">
        <div class="card-header">
            @if (Auth::user()->role == 'superAdmin')
                <h3 class="mb-0">Super Admin Dashboard</h3>
            @else
                <h2 class="mb-0">Welcome, {{ Auth::user()->name }}!</h2>
            @endif
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6 col-sm-6">
                    <div class="card text-white mb-3" style="background-color: #3D5EE1">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <strong class="card-title">Teachers</strong>
                                    <h3 class="card-text text-white">{{ $teacherCount }}</h3>
                                </div>
                                <div>
                                    <i class="fas fa-chalkboard-teacher fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-6">
                    <div class="card text-white mb-3" style="background-color: #3D5EE1">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <strong class="card-title">Students</strong>
                                    <h3 class="card-text text-white">{{ $studentCount }}</h3>
                                </div>
                                <div>
                                    <i class="fas fa-user-graduate fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-6">
                    <div class="card text-white mb-3" style="background-color: #3D5EE1">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <strong class="card-title">Admins</strong>
                                    <h3 class="card-text text-white">{{ $adminCount }}</h3>
                                </div>
                                <div>
                                    <i class="fas fa-user-shield fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-6">
                    <div class="card text-white mb-3" style="background-color: #3D5EE1">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <strong class="card-title">Parents</strong>
                                    <h3 class="card-text text-white">{{ $parentCount }}</h3>
                                </div>
                                <div>
                                    <i class="fas fa-users fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-6">
                    <div class="card text-white mb-3" style="background-color: #3D5EE1">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <strong class="card-title">Librarians</strong>
                                    <h3 class="card-text text-white">{{ $librarianCount }}</h3>
                                </div>
                                <div>
                                    <i class="fas fa-book-reader fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
