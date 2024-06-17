@extends("layouts.main")
@section('container')
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>

  <div class="card mb-4">
    <div class="card-header">
        Detail Tagihan
    </div>

    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tuition Type</th>
                    <th>Description</th>
                    <th>Bill (Rp.)</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @foreach($tuition->tuitionDetails as $index => $tuitionDetail)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $tuitionDetail->tuitionType->name }}</td>
                    <td>{{ $tuitionDetail->description }}</td>
                    <td class="text-end">{{ NumberFormat($tuitionDetail->value, 0, ',', '.') }}</td>
                </tr>
                @php $total += $tuitionDetail->value; @endphp
                @endforeach
                <tr>
                    <td colspan="3"><strong>Total</strong></td>
                    <td class="text-end"><strong>{{ NumberFormat($totalBill, 0, ',', '.') }}</strong></td>
                </tr>
            </tbody>
        </table>
    </div>
    <button id="pay-button" class="btn btn-primary">Pay Now</button>
</div>



<script type="text/javascript">
    document.getElementById('pay-button').onclick = function () {
        snap.pay('{{ $snapToken }}');
    };
</script>

<script type="text/javascript">
    var payButton = document.getElementById('pay-button');
    payButton.addEventListener('click', function () {
        // Trigger snap popup
        window.snap.embed('{{ $snapToken }}', {
            embedId: 'snap-container',
            onSuccess: function (result) {
                // alert("Pembayaran sukses!");
                const url = "<?= URL::to('/invoice/$tuition->id') ?>";
                // window.location.href = "<?= URL::to('/invoice/$tuition->id') ?>";
                window.open(url,  '_self');  
                console.log(result);
                // const tuitionId = '{{ $tuition->id }}'; // Mengambil nilai ID dari Blade template
                // const url = "/invoice/" + tuitionId; // Membuat URL berdasarkan ID tuition

                // // Buka halaman invoice dengan ID tuition setelah pembayaran sukses
                // window.open(url, '_self');  
                // console.log(result);
                
            },
            onPending: function (result) {
                alert("Pembayaran sedang diproses!");
                console.log(result);
            },
            onError: function (result) {
                alert("Pembayaran gagal!");
                console.log(result);
            },
            onClose: function () {
                alert('Anda menutup popup tanpa menyelesaikan pembayaran');
            }
        });
    });
</script>

@endsection
