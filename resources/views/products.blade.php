@extends('layouts.index')

@section('content')

                </div>
            </div>
    </section>
    <!-- Hero Section End -->
    <section class="product-details pt-4">
        <div class="container">
        @if ($error = Session::get('flash_message_error'))
            <div class="alert alert-danger alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $error }}</strong>
            </div>
        @endif
        @if ($success = Session::get('flash_message_success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $success }}</strong>
            </div>
        @endif
            <div class="row">
                <div class="col-lg-5 col-md-5">
                    <div class="product__details__pic">
                        <div class="product__details__pic__item product-pic-zoom">
                            <img class="product__details__pic__item--large"
                                src="/images/products/{{$singleProduct->product_img}}" alt="">
                        </div>
                        <div class="">
                            @foreach($singleProduct->images as $image)
                                <img src="/images/products/{{ $image->images }}" alt="">
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 col-md-7">
                    <form action="{{url('add-cart')}}" method="post" name="addCartForm" id="addCartForm" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="inputId" value="{{$singleProduct->id}}">
                        <input type="hidden" name="inputName" value="{{$singleProduct->product_name}}">
                        <input type="hidden" name="inputCode" value="{{$singleProduct->product_code}}">
                        <input type="hidden" name="inputColor" value="{{$singleProduct->product_color}}">
                        <input type="hidden" name="inputPrice" id="inputPrice" value="{{ $singleProduct->after_pprice }}">
                        <input type="hidden" name="inputImage" id="inputImage" value="{{ $singleProduct->product_img }}">
                        <div class="product__details__text">
                            <h3>{{$singleProduct->product_name}}</h3>
                            <div class="product__details__rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-half-o"></i>
                                <span>(18 reviews)</span>
                            </div>
                            <div id="getPrice" class="product__details__price">£ {{$singleProduct->after_pprice}} <small style="text-decoration:line-through; color:#ccc;">£ {{$singleProduct->before_price}}</small></div>
                            <div class="main-feature mb-3"><?php echo $singleProduct->main_feature ?></div>
                            <div class="product-options row">
                                <div class="weight-title col-md-2 col-3 mt-2 pt-1"><h5>Weight</h5></div>
                                <select name="inputSize" id="inputWeight" style="width: 150px;">
                                    @foreach($singleProduct->attributes as $weight)
                                        <option value="{{$singleProduct->id}}-{{$weight->weight}}">{{$weight->weight}}</option>
                                    @endforeach
                                </select>
                            </div> <br>
                            <div class="product__details__quantity">
                                <div class="quantity">
                                    <div class="pro-qty">
                                        <input type="text" name="inputQTY" value="1">
                                    </div>
                                </div>
                            </div>
                            @if($totalStock>0)
                            <button type="submit" id="cartButton" class="primary-btn">ADD TO CART</button> @else <a id="oStock" class="text-danger">Out of Stock</a>
                            @endif
                            <ul>
                                <li><b>Availability</b> @if($totalStock>0) <span id="stock">In Stock</span> @else <span class="text-danger">Out of Stock</span> @endif</li>
                                <li><b>Product Code</b> <span>{{$singleProduct->product_code}} </span></li>
                                <li><b>Share on</b>
                                    <div class="share">
                                        <a href="#"><i class="fa fa-facebook"></i></a>
                                        <a href="#"><i class="fa fa-twitter"></i></a>
                                        <a href="#"><i class="fa fa-instagram"></i></a>
                                        <a href="#"><i class="fa fa-pinterest"></i></a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </form>
                </div>
                <div class="col-lg-12">
                    <div class="product__details__tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab" aria-selected="true">Description</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab" aria-selected="false">Information</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab" aria-selected="false">Reviews <span>(1)</span></a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Products Description</h6>
                                    <div class="main-feature mb-3"><?php echo $singleProduct->product_desc ?></div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-2" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Products Infomation</h6>
                                    <div class="main-feature mb-3"><?php echo $singleProduct->product_specs ?></div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-3" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Products Infomation</h6>
                                    <p>Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui.
                                        Pellentesque in ipsum id orci porta dapibus. Proin eget tortor risus.
                                        Vivamus suscipit tortor eget felis porttitor volutpat. Vestibulum ac diam
                                        sit amet quam vehicula elementum sed sit amet dui. Donec rutrum congue leo
                                        eget malesuada. Vivamus suscipit tortor eget felis porttitor volutpat.
                                        Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Praesent
                                        sapien massa, convallis a pellentesque nec, egestas non nisi. Vestibulum ac
                                        diam sit amet quam vehicula elementum sed sit amet dui. Vestibulum ante
                                        ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;
                                        Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula.
                                        Proin eget tortor risus.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="container"><hr></div>
    <section class="related mt-5 mb-5">
        <div class="container">
            <h2 class="mb-3">Related Products</h2>
            <div class="col-12">
                <div id="carousel" class="owl-carousel">
                    @foreach($relatedProducts->chunk(4) as $chunk)
                        @foreach($chunk as $item)
                    <div class="item">
                        <div class="single-product">
                            <div class="product-img">
                                <a href="#"><img src="/images/products/{{$item->product_img}}" alt=""></a>
                                <div class="product-action clearfix">
                                    <a href="#" data-toggle="tooltip" data-placement="top" title="Wishlist"><i class="fa fa-heart"></i></a>
                                    <a href="#" data-toggle="tooltip" data-placement="top" title="Quick View"><i class="fa fa-search-plus"></i></a>
                                    <a href="#" data-toggle="tooltip" data-placement="top" title="Add To Cart"><i class="fa fa-cart-plus"></i></a>
                                </div>
                            </div>
                            <div class="product-info clearfix">
                                <div class="fix">
                                    <p class="floatright hidden-sm">{{$item->catname}}</p>
                                    <h4 class="post-title text-left"><a href="{{ url('products/'.$item->id) }}">{{$item->product_name}}</a></h4>
                                </div>
                                <div class="fix">
                                    <span class="pro-price text-left">£ {{$item->after_pprice}} <span>£ {{$item->before_price}}</span></span>
                                    <span class="pro-rating float-right">
                                        <a href="#"><i class="fa fa-star"></i></a>
                                        <a href="#"><i class="fa fa-star"></i></a>
                                        <a href="#"><i class="fa fa-star"></i></a>
                                        <a href="#"><i class="fa fa-star-half-o"></i></a>
                                        <a href="#"><i class="fa fa-star-half-o"></i></a>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                        @endforeach
                    @endforeach
                </div>
                
            </div>
        </div>
    </section>


<style>

</style>

<script>
    $(document).ready(function(){
        $('#carousel').owlCarousel({
            loop:true,
            margin:20,
            responsiveClass:true,
            responsive:{
                0:{
                    items:2,
                    nav:true
                },
                600:{
                    items:3,
                    nav:false
                },
                1000:{
                    items:4,
                    nav:true,
                    loop:false
                }
            }
        })
        $("#inputWeight").change(function(){
            var idWeight = $(this).val();
            $.ajax({
                type:'get',
                url:'/get-product-price',
                data:{idWeight:idWeight},
                success:function(resp){
                    // alert(resp);
                    var arr = resp.split('#');
                    $("#getPrice").html("£ "+arr[0]);
                    $("#inputPrice").val(arr[0]);
                    if(arr[1]==0){
                        $("#cartButton").hide();
                        $("#oStock").show();
                        $("#stock").text("Out of Stock");
                    }else{
                        $("#cartButton").show();
                        $("#stock").text("In Stock");
                    }
                },
                error:function(ts){
                    alert(ts.responseText);
                }
            });
        });
    });
    
</script>

@endsection