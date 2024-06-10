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
                    <h4 class="mt-4">Extracurricular Activities</h4>
                    @if($extracurriculars->isEmpty())
                        <div class="alert alert-info">
                            You are not enrolled in any extracurricular activities.
                        </div>
                    @else
                        <p>You are enrolled in <a href="#" data-bs-toggle="modal" data-bs-target="#extracurricularModal">{{ $extracurriculars->count() }} extracurricular activities</a>.</p>

                        <!-- Modal -->
                        <div class="modal fade" id="extracurricularModal" tabindex="-1" aria-labelledby="extracurricularModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="extracurricularModalLabel">Extracurricular Activities</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <ul class="list-group">
                                            @foreach($extracurriculars as $extracurricular)
                                                <li class="list-group-item">
                                                    <div class="d-flex w-100 justify-content-between">
                                                        <h5 class="mb-1">{{ $extracurricular->extracurricular_name }}</h5>
                                                        <small class="text-muted">ID: {{ $extracurricular->id }}</small>
                                                    </div>
                                                    <p class="mb-1">{{ $extracurricular->extracurricular_description }}</p>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
