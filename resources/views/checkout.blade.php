@extends('layouts.index')

@section('content')
        </div>
    </div>
</section>
<!-- Hero Section End -->
<div class="container">
	<div class="page-top-info">
		<div class="breadcrumb"> &nbsp;<a href="{{route('home')}}">Home&nbsp;</a> » &nbsp;Checkout&nbsp; </div>
	</div>
</div>
<div class="container" style="margin-top: 50px;">
    <div class="text-center mb-3"> 
        <h3>CHECKOUT</h3> 
    </div>

    <form action="{{route('checkout.create')}}" method="POST" id="checkForm" style="margin-bottom: 75px;">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-md-6" style="margin: 0 auto !important;">
                <div class="checkout-box shipping-div" style="">
                    <h2 style="background-color: #111; color: #fff;">Delivery Information</h2>
                    <div class="checkout-info">
                        <span>Email</span>
                        <input type="email" class="form-control mb-2" id="s_email" name="s_email" placeholder=""/>
                        <span>Phone Number</span>
                        <input type="text" class="form-control mb-2" id="s_phone" name="s_phone" placeholder=""/>
                        <span>Name</span>
                        <input type="text" class="form-control mb-2" id="s_name" name="s_name" placeholder=""/>
                        <span class="">Address</span>
                        <textarea rows="4" class="form-control mb-2" id="s_address" name="s_address"> </textarea>
                        <span class="">Special Note or Message</span>
                        <textarea rows="4" class="form-control mb-2" id="s_note" name="s_note" placeholder="If you have any special instruction or any message you describe it here..."></textarea>
                    </div>
                </div>
                <div style="margin: 50px auto;text-align: center;">
                    <button class="btn btn-success btn-lg next" style="">CLICK TO CONTINUE</button>
                </div>
            </div>
            
            <div class="col-md-6 other-half" style="display:none">
                <div class="checkout-box shipandpay" style="display: none;">
                    <h2 style="background-color: #111; color: #fff;">Shipping and Payment</h2>
                    <div class="checkout-info">
                        <span class="">Shipping Method</span>
                        <div class="form-group m-2">
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" id="ShipMethod1" name="smethod" value="Inside City">
                                <label for="ShipMethod1" class="custom-control-label">Home Delivery Within City</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" id="ShipMethod2" name="smethod" value="Outside City">
                                <label for="ShipMethod2" class="custom-control-label">Transport Delivery (Country Wide)</label>
                            </div>
                        </div>
                        <span class="">Payment Method</span>
                        <div class="form-group m-2">
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" id="PayMethod1" name="pmethod" value="Cash On Delivery">
                                <label for="PayMethod1" class="custom-control-label">Cash On Delivery</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" id="PayMethod2" name="pmethod" value="PayPal">
                                <label for="PayMethod2" class="custom-control-label">PayPal</label>
                            </div>
                            <div class="Box m-0 pt-3" style="display: none;">
                                <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</span>
                            </div>
                        </div>                
                    </div>
                </div>
                <div class="checkout-box shopping_cart_div" style="display: none;     border-bottom-right-radius: 10px;border-bottom-left-radius: 10px;">
                    <h2 style="background-color: #111; color: #fff;">Shopping Cart Summary</h2>
                    <div class="cart-table" style="padding-top: 15px;">
						<div class="cart-table-warp table-responsive" tabindex="1">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th class="product-th">Product</th>
									<th class="quy-th">Qty.</th>
									<th class="size-th">Price</th>
									<th class="total-th">Total</th>
								</tr>
							</thead>
							<tbody>
							@foreach($userCart as $cart)
								<tr>
									<td class="product-col" style="display: revert">
										<div class="pc-title" style="padding-left: 0;">
											<h4>{{$cart->product_name}}</h4>
											<p>{{$cart->product_code}} | {{$cart->weight}}</p>
										</div>
									</td>
									<td class="quy-col">
										<div class="quantity">
                                            <span>{{$cart->quantity}}</span>
                    					</div>
									</td>
									<td class="size-col"><span style="font-size:14px;">£ {{$cart->price}}</span></td>
									<td class="total-col"><span style="font-size:14px;">£ {{$cart->price*$cart->quantity}}</span></td>
								</tr>
							@endforeach
                            <?php $total_amount = 0; 
								foreach($userCart as $item){
									$total_amount = $total_amount + ($item->price * $item->quantity);
								}
							?>
                                <tr><td colspan="3"><b>Sub Total</b></td><td style="width:140px;text-align: right; font-size:14px;"><b>£ <?= $total_amount ?></b></td></tr>
                                @if(!empty(Session::get('CouponAmount')))
                                <tr><td colspan="3"><b>Discount</b></td><td style="width:140px;text-align: right; font-size:14px;"><b>£ <?= Session::get('CouponAmount') ?></b></td></tr>
                                @endif
							</tbody>
						</table>
						</div>
                        @if(!empty(Session::get('CouponAmount')))
						<div class="total-cost"><h6>Grand Total <span>£ <?= $total_amount - Session::get('CouponAmount') ?></span></h6></div>
                        @else
                        <div class="total-cost"><h6>Grand Total <span>£ <?= $total_amount ?></span></h6></div>
                        @endif
					</div>
                </div>
                <input type="hidden" name="discount" id="discount" value="<?= Session::get('CouponAmount') ?>">
                <div class="save_div" style="margin: 0 auto; display: none;">
                    <div class="row">
                        <div class="col-6"><a href="{{route('cart')}}" class="btn btn-warning float-right">Update Cart</a></div>
                        <div class="col-6">
                            <input type="submit" name="save" id="save" class="btn btn-success" style="background-color: #f8ea7f; color: #000;" value="PLACE ORDER">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script type="text/javascript">

$(document).ready(function(){
    
    $('#s_email').on('blur', function(e){
        var email = $(this).val();
        var formData = new FormData();
        formData.append('email', email);
        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ URL::route('get_details') }}",
            method: 'post',
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            success: function (response) {
                var str = JSON.stringify(response, null, 4)
                var obj = JSON.parse(str);
                
                $('#s_name').val(obj.name);
                $('#s_phone').val(obj.phone);
                $('#s_address').html(obj.address);
            },
            error: function (jqXHR) {
                // alert(jqXHR.responseText);
            }
        });
    });

    $('input[type="radio"]').click(function(){
        if($(this).attr("value")=="Cash On Delivery"){
            $(".Box").hide('slow');
        }
        if($(this).attr("value")=="PayPal"){
            $(".Box").show('slow');

        }        
    });

    $('input[type="radio"]').trigger('click');

    $('.next').click(function(e){
       
       e.preventDefault();
       
       if($('#s_name').val() == '' || $('#s_phone').val() == '' || $('#s_email').val() == '' || $('#s_address').val() == ''){
           alert("Delivery information fields can't be empty! Please give delivery informatiion to continue.");
           return false;
       }
       $('.other-half').show();
       $(this).hide();
       $('.shipandpay').show();
       $('.shopping_cart_div').show();
       $('.save_div').show();
       
        var s_email = $("#s_email").val();
        var s_name = $("#s_name").val();
	    var s_phone = $("#s_phone").val();
	    var s_address = $("#s_address").val();
	    var s_note = $("#s_note").val();
	    var discount = $("#discount").val();
        var smethod = $('input[name=smethod]:checked').val();
        var pmethod = $('input[name=pmethod]:checked').val();
        
		$.ajax({
			url: "{{ URL::route('checkout.create') }}",
			data:'s_email=' + s_email + '&s_name=' + s_name + '&s_phone=' + s_phone + '&s_name=' + s_name + '&s_address=' + s_address + '&s_note=' + s_note + '&discount=' + discount + '&smethod=' + smethod + '&pmethod=' + pmethod,
			type:'post',
			success:function(response){
				console.log(response);
			},
			error: function(ts) {         
                alert(ts.responseText);
            }
		});

    }); 
});
</script>

<style>
.checkout-box {
    width: 100%;
    border: 1px solid #6666;
    margin-bottom: 12px;
}
.checkout-box > h2 {
    font-size: 20px;
    font-weight: 500;
    text-align: center;
    border-bottom: 1px solid #6666;
    padding: 5px;
}
.checkout-info {
    padding: 22px;
}
</style>

@endsection