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
  // For example trigger on button clicked, or any time you need
  var payButton = document.getElementById('pay-button');
  payButton.addEventListener('click', function () {
    // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token


    window.snap.pay('{{$snapToken}}', {
      onSuccess: function(result){
        /* You may add your own implementation here */
        alert("Pembayaran Sukses!"); 
        const url = '{{ URL::to("/invoice/{$tuition->id}") }}';

        // const url = '<?= URL::to('/tuition/payOffSuccess'); ?>';
        window.open(url,  '_self');        
      },
      onPending: function(result){
        /* You may add your own implementation here */
        alert("Sedang menunggu pembayaran anda!"); console.log(result);
      },
      onError: function(result){
        /* You may add your own implementation here */
        alert("Pembayaran Gagal!"); console.log(result);
      },
      onClose: function(){
        /* You may add your own implementation here */
        alert('Anda menutup pop up tanpa melakukan pembayaran');
      }
    })
  });
</script>

@endsection
