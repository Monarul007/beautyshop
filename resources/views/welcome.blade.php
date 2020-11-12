@extends('layouts.index')

@section('content')

                    <div id="homeslider" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                          <li data-target="#homeslider" data-slide-to="0" class="active"></li>
                          <li data-target="#homeslider" data-slide-to="1"></li>
                          <li data-target="#homeslider" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                          <div class="carousel-item active">
                            <img class="d-block w-100" src="images/banners/php1AB1.tmp1599720307webp" alt="First slide">
                          </div>
                          <div class="carousel-item">
                            <img class="d-block w-100" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22800%22%20height%3D%22400%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20800%20400%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_173bcfa1ad4%20text%20%7B%20fill%3A%23555%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A40pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_173bcfa1ad4%22%3E%3Crect%20width%3D%22800%22%20height%3D%22400%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22285.9140625%22%20y%3D%22217.7%22%3EFirst%20slide%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" alt="Second slide">
                          </div>
                          <div class="carousel-item">
                            <img class="d-block w-100" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22800%22%20height%3D%22400%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20800%20400%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_173bcfa1ad7%20text%20%7B%20fill%3A%23333%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A40pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_173bcfa1ad7%22%3E%3Crect%20width%3D%22800%22%20height%3D%22400%22%20fill%3D%22%23555%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22276.9921875%22%20y%3D%22217.7%22%3EThird%20slide%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" alt="Third slide">
                          </div>
                        </div>
                        <a class="carousel-control-prev" href="#homeslider" role="button" data-slide="prev">
                          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                          <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#homeslider" role="button" data-slide="next">
                          <span class="carousel-control-next-icon" aria-hidden="true"></span>
                          <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
    </section>
    <!-- Hero Section End -->

    <!-- Categories Section Begin -->
    <section class="categories mt-5">
        <div class="container">
            <div class="section-title">
                <h2>Featured Categories</h2>
            </div>
            <div class="row">
                <div class="col-md-2 col-6 mb-3">
                    <div class="categories__item set-bg" style="background-image: url(images/categories/makeup.jpg);">
                        <h5><a href="category/makeup">Makeup</a></h5>
                    </div>
                </div>
                <div class="col-md-2 col-6 mb-3">
                    <div class="categories__item set-bg" style="background-image: url(images/categories/body-care.jpg);">
                        <h5><a href="category/care">Care</a></h5>
                    </div>
                </div>
                <div class="col-md-2 col-6 mb-3">
                    <div class="categories__item set-bg" style="background-image: url(images/categories/fragrance.jpg);">
                        <h5><a href="category/fragnance">Fragnance</a></h5>
                    </div>
                </div>
                <div class="col-md-2 col-6 mb-3">
                    <div class="categories__item set-bg" style="background-image: url(images/categories/tools-brushes.jpg);">
                        <h5><a href="category/tools-and-accessories">Tools & Brushes</a></h5>
                    </div>
                </div>
                <div class="col-md-2 col-6 mb-3">
                    <div class="categories__item set-bg" style="background-image: url(images/categories/Hair-Rebonding_1024x400.webp);">
                        <h5><a href="category/hair-tools">Hair</a></h5>
                    </div>
                </div>
                <div class="col-md-2 col-6 mb-3">
                    <div class="categories__item set-bg" style="background-image: url(images/categories/beauty-treatments.jpg);">
                        <h5><a href="category/manicure-and-pedicuree">Treatments</a></h5>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Categories Section End -->

    <!---Featured Products Section Starts-->
    <section id="featured-products">
        <div class="container">
            <div class="section-pad"></div>
            <div class="section-title">
                <h2>Most Popular Products</h2>
            </div>
            <div class="row">
                @foreach($products as $product)
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <div class="single-product">
                        <div class="product-img">
                            <span class="pro-label new-label">new</span>
                            <a href="{{ url('products/'.$product->id) }}"><img src="images/products/{{$product->product_img}}" alt=""></a>
                            <div class="product-action clearfix">
                                <a href="#" data-toggle="tooltip" data-placement="top" title="Wishlist"><i class="fa fa-heart"></i></a>
                                <a href="#" data-toggle="tooltip" data-placement="top" title="Quick View"><i class="fa fa-search-plus"></i></a>
                                <a href="#" data-toggle="tooltip" data-placement="top" title="Add To Cart"><i class="fa fa-cart-plus"></i></a>
                            </div>
                        </div>
                        <div class="product-info clearfix">
                            <div class="fix">
                                <p class="floatright hidden-sm">{{$product->catname}}</p>
                                <h4 class="post-title text-left"><a href="{{ url('products/'.$product->id) }}">{{$product->product_name}}</a></h4>
                            </div>
                            <div class="fix">
                                <span class="pro-price text-left">£ {{$product->after_pprice}} <span>£ {{$product->before_price}}</span></span>
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
            </div>
        </div>
    </section>


    <!---All Products Section Starts-->
    <section id="featured-products">
        <div class="container">
            <div class="section-pad"></div>
            <div class="section-title">
                <h2>View All Products</h2>
            </div>
            <div class="loadMoreDiv row" style=""></div>
            <div class="text-center" style="padding: 20px 0;">
                    <button id="loadMore" class="btn btn-info">Load More</button>
            </div>
                <div id="wait" class="mb-3 d-none"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin: auto; background: rgb(255, 255, 255); display: block; shape-rendering: auto;" width="80px" height="80px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
                <g transform="translate(50,50)"><circle cx="0" cy="0" r="8.333333333333334" fill="none" stroke="#e15b64" stroke-width="4" stroke-dasharray="26.179938779914945 26.179938779914945">
                <animateTransform attributeName="transform" type="rotate" values="0 0 0;360 0 0" times="0;1" dur="1s" calcMode="spline" keySplines="0.2 0 0.8 1" begin="0" repeatCount="indefinite"></animateTransform>
                </circle><circle cx="0" cy="0" r="16.666666666666668" fill="none" stroke="#f47e60" stroke-width="4" stroke-dasharray="52.35987755982989 52.35987755982989">
                <animateTransform attributeName="transform" type="rotate" values="0 0 0;360 0 0" times="0;1" dur="1s" calcMode="spline" keySplines="0.2 0 0.8 1" begin="-0.2" repeatCount="indefinite"></animateTransform>
                </circle><circle cx="0" cy="0" r="25" fill="none" stroke="#f8b26a" stroke-width="4" stroke-dasharray="78.53981633974483 78.53981633974483">
                <animateTransform attributeName="transform" type="rotate" values="0 0 0;360 0 0" times="0;1" dur="1s" calcMode="spline" keySplines="0.2 0 0.8 1" begin="-0.4" repeatCount="indefinite"></animateTransform>
                </circle><circle cx="0" cy="0" r="33.333333333333336" fill="none" stroke="#abbd81" stroke-width="4" stroke-dasharray="104.71975511965978 104.71975511965978">
                <animateTransform attributeName="transform" type="rotate" values="0 0 0;360 0 0" times="0;1" dur="1s" calcMode="spline" keySplines="0.2 0 0.8 1" begin="-0.6" repeatCount="indefinite"></animateTransform>
                </circle><circle cx="0" cy="0" r="41.666666666666664" fill="none" stroke="#849b87" stroke-width="4" stroke-dasharray="130.89969389957471 130.89969389957471">
                <animateTransform attributeName="transform" type="rotate" values="0 0 0;360 0 0" times="0;1" dur="1s" calcMode="spline" keySplines="0.2 0 0.8 1" begin="-0.8" repeatCount="indefinite"></animateTransform>
                </circle></g></svg></div>
            </div>
        </div>
    </section>

<script>
    $(document).ready(function(){

        ///// Load More Section  
        var formData = new FormData();
        var loadmore_data = [];
        	
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
            
        $.ajax({
            url: "{{ URL::route('loadmore') }}",
            method: 'get',
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            dataType: "JSON",
            error: function(ts) {         
                alert(ts.responseText);
            },
            success: function(data){    
                loadmore_data = data;
                for(i =1; i <= 8; i++){
                    var pdiv = data[i];
                    $('.loadMoreDiv').append(pdiv); 
                }
            }
            		   
        });
            
        var iterate = 5;
        var limit = 8;
        $('#loadMore').click(function(){
                
            jQuery.ajax({
                beforeSend: function() {
                    $("div").removeClass("d-none");
                    $("#wait").show();
                    $("#loadMore").hide();
                },
                success: function(data) {
                    $("#wait").hide();
                    for(i = iterate; i <= limit; i++){
                        var pdiv = loadmore_data[i];
                        $('.loadMoreDiv').append(pdiv);
                    }
                    $("#loadMore").show();
                }
            });
            iterate = (iterate + 4);
            limit = (limit + 4);
    
        });
    });
</script>
@endsection