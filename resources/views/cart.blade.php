@extends('layouts.index')

@section('content')
<script>
$(document).ready(function(){
	$("#CartMsg").hide();
	@foreach($userCart as $cart)
	$("#upCart{{$cart->id}}").on('change keyup', function(){
		var newQTY = $("#upCart{{$cart->id}}").val();
		var rowID = $("#rowID{{$cart->id}}").val();
		$.ajax({
			url:'{{url('/cart/update-cart')}}',
			data:'rowID=' + rowID + '&newQTY=' + newQTY,
			type:'get',
			success:function(response){
				$("#CartMsg").show();
				console.log(response);
				$("#CartMsg").html(response);
				window.setTimeout(function(){ 
                            location.reload();
                } ,2000);
			},
			error: function(ts) {         
                alert(ts.responseText);
            }
		});
	});
	@endforeach
});
</script>

                </div>
            </div>
    </section>
    <!-- Hero Section End -->

    <div class="container">
		<div class="page-top-info">
			<div class="breadcrumb"> &nbsp;<a href="index.html">Home&nbsp;</a> » &nbsp;<a href="#">Shoping Cart&nbsp;</a> </div>
		</div>
    </div>
    <section class="cart-section mb-5">
		<div class="container">
		@if ($success = Session::get('flash_message_success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $success }}</strong>
            </div>
        @endif
		@if ($error = Session::get('flash_message_error'))
            <div class="alert alert-danger alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $error }}</strong>
            </div>
        @endif
		<div class="alert alert-success alert-block" id="CartMsg"></div>
			<div class="row">
				<div class="col-lg-8">
					<div class="cart-table">
						<div class="cart-table-warp" tabindex="1" style="overflow: hidden; outline: none;">
						<table class="table-responsive">
							<thead>
								<tr>
									<th class="product-th">Product</th>
									<th class="quy-th">Quantity</th>
									<th class="size-th">Price</th>
									<th class="total-th">Total</th>
								</tr>
							</thead>
							<tbody>
							@foreach($userCart as $cart)
								<tr>
									<td class="product-col">
										<img src="public/images/products/{{$cart->image}}" alt="">
										<div class="pc-title">
											<h4>{{$cart->product_name}}</h4>
											<p>{{$cart->product_code}} | {{$cart->weight}}</p>
										</div>
									</td>
									<td class="quy-col">
										<input type="hidden" value="{{$cart->id}}" id="rowID{{$cart->id}}">
										<div class="quantity">
                                            <input name="" type="number" value="{{$cart->quantity}}" id="upCart{{$cart->id}}" class="form-control text-center" style="max-width:70px;">
                    					</div>
									</td>
									<td class="size-col"><h4>£ {{$cart->price}}</h4></td>
									<td class="total-col"><h4>£ {{$cart->price*$cart->quantity}}</h4></td>
									<td class="shoping__cart__item__close">
                                        <a class="icon_close text-danger" href="{{ url('/cart/delete-product/'.$cart->id) }}" title="Delete Item"></a>
                                    </td>
								</tr>
							@endforeach
							</tbody>
						</table>
						</div>
						<div class="total-cost">
							<?php $total_amount = 0; 
								foreach($userCart as $item){
									$total_amount = $total_amount + ($item->price * $item->quantity);
								}
								echo '<h6>Total <span>TK. '.$total_amount.'</span></h6>';
							?>
						</div>
					</div>
				</div>
				<div class="col-lg-4 card-right">
					<form action="{{url('cart/apply-coupon')}}" method="POST" class="promo-code-form">
						@csrf
						<input type="text" name="inputCoupon" placeholder="Enter promo code">
						<button type="submit">Submit</button>
					</form>
					<div class="checkout__order">
                        <h4>Order Summary</h4>
						<?php $total_amount = 0;
							foreach($userCart as $item){
								$total_amount = $total_amount + ($item->price * $item->quantity);
							}
						?>
						@if(!empty(Session::get('CouponAmount')))
						<div class="checkout__order__subtotal" style="padding:0;border:none;">Subtotal <span>£ <?= $total_amount ?></span></div>
						<div class="checkout__order__subtotal" style="padding:0;border:none;">Coupon Discount <span>£ <?= Session::get('CouponAmount') ?></span></div>
						<div class="checkout__order__subtotal">Grand Total <span>£ <?= $total_amount - Session::get('CouponAmount') ?></span></div>
						@else
						<div class="checkout__order__total">Grand Total <span>£ <?= $total_amount ?></span></div>
						@endif
                        <p>Lorem ipsum dolor sit amet, consectetur adip elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
					</div>
					<a href="{{ url('/checkout') }}" class="site-btn">Proceed to checkout</a>
					<a href="{{ route('shop') }}" class="site-btn sb-dark">Continue shopping</a>
				</div>
			</div>
		</div>
	</section>

@endsection