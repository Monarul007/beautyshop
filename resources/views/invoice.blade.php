<?php 

$status = ''; 

?>
<?php $discount = ''; ?>

@foreach($order as $ord)
    <?php
        $orderno = $ord->order_number; 
        if($ord->is_paid == 0){
            $status = "Due";
        }else{
            $status = "Paid";
        }
        if($ord->discount == null){
            $discount = 0;
        }else{
            $discount = $ord->discount;
        }
        $order_date = $ord->created_at;
        $shipname = $ord->shipping_name;
        $shipphone= $ord->shipping_phone;
        $shipinfo= $ord->shipping_info;
        $name= $ord->name;
        $ptype= $ord->payment_method;
        $phone= $ord->phone_no;
        $scharge= $ord->delivery_charge;
    ?>
@endforeach

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BeautyShop | Inovice No. <?= $orderno ?></title>
  <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}" type="text/css">
  <script src="{{asset('js/bootstrap.min.js')}}"></script>
  <script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body p-0">
                    <div class="row p-5">
                        <div class="col-md-4">
                            <img src="http://via.placeholder.com/400x90?text=logo" width="100%">
                        </div>
                        <div class="col-md-4">
                            <form action="{{ route('create-payment') }}" method="post">
                                @csrf
                                <input type="submit" class="btn btn-info" value="Pay Now">
                            </form>
                            <div class="btn btn-danger"><?= $status; ?></div>
                        </div>
                        <div class="col-md-4 text-right p1">
                            <p class="font-weight-bold mb-1">ORDER NO: #<?= $orderno ?></p>
                            <p class="text-muted">ORDER DATE: <?= $order_date ?></p>
                        </div>
                    </div>

                    <hr class="my-5">

                    <div class="row pb-5 p-5">
                        <div class="col-md-6">
                            <p class="font-weight-bold mb-4">Shipping Information</p>
                            <p class="mb-1"><b>Name:</b> <?= $shipname ?></p>
                            <p><b>Phone:</b> <?= $shipphone ?></p>
                            <p class="mb-1"><b>Address:</b> <?= $shipinfo ?></p>
                        </div>

                        <div class="col-md-6 text-right p2">
                            <p class="font-weight-bold mb-4">Payment Details</p>
                            <p class="mb-1"><span class="text-muted">NAME: </span> <?= $name ?></p>
                            <p class="mb-1"><span class="text-muted">DISCOUNT: </span> <?= $discount ?></p>
                            <p class="mb-1"><span class="text-muted">Payment Type: </span> <?= $ptype ?></p>
                            <p class="mb-1"><span class="text-muted">PHONE: </span> <?= $phone ?></p>
                        </div>
                    </div>

                    <div class="row p-5">
                        <div class="col-md-12 table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="border-0 text-uppercase small font-weight-bold">#</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">Image</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">Product Name</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">Quantity</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">Unit Cost</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $i = 1; 
                                      $subtotal = 0;
                                      foreach($order_details as $ordD){
                                        $subtotal = $subtotal + ($ordD->price * $ordD->qnt);
                                      }
                                ?>
                                @foreach($order_details as $ordD)
                                  <?php $price = $ordD->price * $ordD->qnt; ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><img src="images/products/{{$ordD->image}}" alt="" width="70px" height="70px" style="border-radius: 100%;"></td>
                                        <td>{{$ordD->pname}} <br> <span>{{$ordD->filter}}: {{$ordD->filter_value}}</span></td>
                                        <td>{{$ordD->qnt}}</td>
                                        <td>{{$ordD->price}}</td>
                                        <td><?= $price ?></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="row flex-row-reverse bg-dark text-white p-2 m-0">
                        <div class="py-3 px-5 text-right">
                            <div class="mb-2">Grand Total <span class="small">(Including Shipping Charge: <?= $scharge ?>)</span></div>
                            <div class="h2 font-weight-light">£ <?php 
                                $gtotal = ($subtotal - $discount) + $scharge;
                                echo $gtotal;
                            ?></div>
                        </div>

                        <div class="py-3 px-5 text-right">
                            <div class="mb-2">Discount</div>
                            <div class="h2 font-weight-light"><?= $discount ?></div>
                        </div>

                        <div class="py-3 px-5 text-right">
                            <div class="mb-2">Sub - Total amount</div>
                            <div class="h2 font-weight-light">£ <?= $subtotal ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="mt-5 mb-5 text-center text-info small">by : <a class="" target="_blank" href="">BeautyShop</a></div>

</div>

<style>
@media only screen and (max-width: 767px) {
  .p1{
    text-align: center !important;
    margin-top: 20px;
  }
  .p2{
    text-align: left !important;
    margin-top: 30px;
  }
}
</style>

</body>
</html>

<?php 

// Session::forget('order_number');
Session::forget('CouponAmount');
Session::forget('session_id');

?>
