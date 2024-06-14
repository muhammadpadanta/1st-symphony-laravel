<!DOCTYPE html>
<html>
<head>
    <title>Orders List</title>
</head>
<body>
<table>
    <thead>
    <tr>
        <th>Order ID</th>
        <th>Total Amount</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($orders as $order)
        <tr>
            <td>{{ $order->order_id }}</td>
            <td>{{ $order->total_amount }}</td>
            <td>{{ $order->purchase_status }}</td>
            <td>
                @if($order->purchase_status == 'Pending')
                    <button id="pay-button" >Pay</button>
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>


<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY')  }}"></script>

<script type="text/javascript">
    document.getElementById('pay-button').onclick = function(){
        // SnapToken acquired from previous step
        snap.pay('{{ $order->snap_token  }}', {
            // Optional
            onSuccess: function(result){
                /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
            },
            // Optional
            onPending: function(result){
                /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
            },
            // Optional
            onError: function(result){
                /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
            }
        });
    };
</script>

</body>
</html>
