@extends('layouts.main')

@section('container')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h3 class="mb-0">Welcome to your Student Dashboard, {{ Auth::user()->name }}!</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-3 col-6">
                                <div class="box border p-2">
                                    <div class="inner">
                                        <h3>{{ $extracurricularCount }}</h3>
                                        <p>Extracurriculars</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-card"></i>
                                    </div>
                                    @if (auth()->user()->role == 'Student')
                                        <a href="#" class="small-box-footer" data-toggle="modal" data-target="#extracurricularModal">More
                                            info <i class="fas fa-arrow-circle-right"></i></a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="extracurricularModal" tabindex="-1" role="dialog" aria-labelledby="extracurricularModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="extracurricularModalLabel">Your Extracurricular Activities</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ul class="list-group">
                        @forelse($extracurriculars as $extra)
                            <li class="list-group-item">
                                <h5>{{ $extra->extracurricular_name }}</h5>
                                <p>{{ $extra->extracurricular_description }}</p>
                            </li>
                        @empty
                            <li class="list-group-item">You are not enrolled in any extracurricular activities.</li>
                        @endforelse
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
