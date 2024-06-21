@extends('layouts.main')
@section('container')

        <!-- Breadcrumbs -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb" style="background-color: transparent; border: none;">
                @if (auth()->user()->role == 'Admin')
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                @elseif (auth()->user()->role == 'Super Admin')
                    <li class="breadcrumb-item"><a href="{{ route('superAdmin.dashboard') }}">Dashboard</a></li>
                @elseif (auth()->user()->role == 'Student')
                    <li class="breadcrumb-item"><a href="{{ route('student.dashboard') }}">Dashboard</a></li>
                @elseif (auth()->user()->role == 'Teacher')
                    <li class="breadcrumb-item"><a href="{{ route('teacher.dashboard') }}">Dashboard</a></li>
                @elseif (auth()->user()->role == 'Librarian')
                    <li class="breadcrumb-item"><a href="{{ route('librarian.dashboard') }}">Dashboard</a></li>
                @endif
                <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
            </ol>
        </nav>

    <div class="page-header">
        <div class="row align-items-center">
            <div class="col mb-5">
                <h3 class="page-title">{{ $title }}</h3>
                <div class="col-auto text-end float-end ms-auto download-grp">
                    <a href="{{ URL::to('book-return/download?startDate=' . $startDate . '&endDate=' . $endDate . '&status=' . $status) }}"
                        class="btn btn-outline-primary me-2"><i class="fas fa-download"></i> Download</a>
                </div>
            </div>


            @if (session()->has('successMessage'))
                <div class="alert alert-success">
                    {{ session('successMessage') }}
                </div>
            @endif

            @if (session()->has('errorMessage'))
                <div class="alert alert-danger">
                    {{ session('errorMessage') }}
                </div>
            @endif

            <form id="filterForm" action="{{ URL::to('book-return') }}" method="GET">
                <div class="row">
                    <div class="col-md-3 col-sm-12">
                        <div class="form-group">
                            <label for="startDate">From:</label>
                            <input type="date" id="startDate" name="startDate" class="form-control"
                                value="{{ request('startDate', \Carbon\Carbon::now()->startOfMonth()->toDateString()) }}"
                                onchange="this.form.submit()">
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-12">
                        <div class="form-group">
                            <label for="endDate">To:</label>
                            <input type="date" id="endDate" name="endDate" class="form-control"
                                value="{{ request('endDate', \Carbon\Carbon::now()->toDateString()) }}"
                                onchange="this.form.submit()">
                        </div>
                    </div>

                    <div class="col-md-2 col-sm-12">
                        <div class="form-group">
                            <label for="status">Status:</label>
                            <select id="status" name="status" class="form-control" onchange="this.form.submit()">
                                <option value="">All</option>
                                <option value="returned" {{ request('status') == 'returned' ? 'selected' : '' }}>Returned
                                </option>
                                <option value="borrowing" {{ request('status') == 'borrowing' ? 'selected' : '' }}>
                                    Borrowing</option>
                            </select>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="table-responsive">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead class="student-thread">
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Patron</th>
                    <th class="text-center">Description</th>
                    <th class="text-center">Date</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Penalty</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($filters as $index => $filter)
                    @if (request('status') && $filter->status != request('status'))
                        @continue
                    @endif
                    <tr class="align-middle">
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td>{{ $filter->classroom_name }} - ({{ $filter->identity_number }}) - {{ $filter->name }}</td>
                        <td>{{ $filter->description }}</td>
                        <td>{{ DateFormat($filter->checkout_date, 'DD MMMM Y') }} s/d <br />
                            {{ DateFormat($filter->due_date, 'DD MMMM Y') }}</td>
                        <td class="text-center">
                            @if ($filter->status == 'borrowing')
                                <span class="badge bg-warning">{{ $filter->status }}</span>
                            @elseif($filter->status == 'returned')
                                <span class="badge bg-success">{{ $filter->status }}</span>
                            @endif
                        </td>
                        <td class="text-end">
                            @if($filter->status == 'borrowing')
                                @php
                                    $dueDate = \Carbon\Carbon::parse($filter->due_date);
                                    $today = \Carbon\Carbon::now();
                                    $penalty = $today->diffInDays($dueDate); 
                                    $penaltyRate = 2000;
                                    $penaltyAmount = $penalty * $penaltyRate; 
                                @endphp
                                @if ($penalty > 0)
                                    {{ NumberFormat($penaltyAmount) }} 
                                @else
                                    0
                                @endif
                            @else
                                0
                            @endif
                            {{-- @if ($filter->status == 'borrowing')
                                @php
                                    $dueDate = \Carbon\Carbon::parse($filter->due_date);
                                    $today = \Carbon\Carbon::now();
                                    $penaltyRate = $configuration->book_penalty; // Ambil nilai dari controller
                                    $penaltyAmount = $today->greaterThan($dueDate)
                                        ? $today->diffInDays($dueDate) * $penaltyRate
                                        : 0;
                                @endphp
                                @if ($penaltyAmount > 0)
                                    {{ NumberFormat($penaltyAmount) }}
                                @else
                                    0
                                @endif
                            @else
                                0
                            @endif --}}
                        </td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center align-items-center">
                                <form method="POST" action="{{ URL::to('book-return/' . $filter->id) }}">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete"
                                        onclick="return confirm('Anda yakin mau menghapus peminjaman buku oleh {{ $filter->name }} ?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        window.onload = function() {
            const urlParams = new URLSearchParams(window.location.search);
            const startDate = urlParams.get('startDate');
            const endDate = urlParams.get('endDate');
            const status = urlParams.get('status');

            // Check if all required parameters are present
            if (!startDate || !endDate || status === null) {
                const form = document.getElementById('filterForm');
                if (!startDate) {
                    form.startDate.value = '{{ \Carbon\Carbon::now()->startOfMonth()->toDateString() }}';
                }
                if (!endDate) {
                    form.endDate.value = '{{ \Carbon\Carbon::now()->toDateString() }}';
                }
                if (status === null) {
                    form.status.value = '';
                }
                form.submit();
            }
        }
    </script>

@endsection
