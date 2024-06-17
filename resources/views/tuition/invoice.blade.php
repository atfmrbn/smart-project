@extends("layouts.main")
@section('container')
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>

  <div class="card mb-4">
    <div class="card-header">
        <h4>Detail Tagihan</h4>
    </div>

    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tuition Type</th>
                    {{-- <th>Description</th> --}}
                    <th>Bill (Rp.)</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @foreach($tuition->tuitionDetails as $index => $tuitionDetail)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $tuitionDetail->tuitionType->name }}</td>
                    {{-- <td>{{ $tuitionDetail->description }}</td> --}}
                    <td class="text-end">{{ NumberFormat($tuitionDetail->value, 0, ',', '.') }}</td>
                </tr>
                @php $total += $tuitionDetail->value; @endphp
                @endforeach
                <tr>
                    <td colspan="2"><strong>Total</strong></td>
                    <td class="text-end"><strong>{{ NumberFormat($totalBill, 0, ',', '.') }}</strong></td>
                </tr>
                <tr>
                    <td colspan="2"><strong>Status</strong></td>
                    <td class="text-end"><strong>{{ $tuition->status }}</strong></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@endsection
