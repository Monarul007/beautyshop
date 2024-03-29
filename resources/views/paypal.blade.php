
@extends('layouts.index')

@section('content')

                </div>
            </div>
    </section>
    <!-- Hero Section End -->
    <div class="container">
		<div class="page-top-info">
			<div class="breadcrumb"> &nbsp;<a href="{{route('home')}}">Home&nbsp;</a> » &nbsp;Pay With PayPal</div>
		</div>
    </div>
    <section class="cart-section mb-5">
      <div class="container">
          <div class="alert alert-success alert-block">
              <button type="button" class="close" data-dismiss="alert">×</button>
              <strong><?= $order->order_number ?></strong>
          </div>
          <span>{{$order_details->order_id}}</span>
          <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
            <input type="hidden" name="cmd" value="_s-xclick">
            <input type="hidden" name="business" value="seller@designerfotos.com">
            <input type="hidden" name="item_name" value="hat">
            <input type="hidden" name="item_number" value="123">
            <input type="hidden" name="amount" value="15.00">
            <input type="image" src="https://www.paypalobjects.com/webstatic/en_US/i/btn/png/btn_buynow_107x26.png" alt="Buy Now">
            <img alt="" src="https://paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
          </form>
      </div>
	  </section>
@endsection

<?php 

Session::forget('order_number');
Session::forget('session_id');

?>
