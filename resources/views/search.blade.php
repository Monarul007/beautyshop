@extends('layouts.index')

@section('content')

                </div>
            </div>
    </section>
    <!-- Hero Section End -->

    <section class="category-section">
		<div class="container">
			<!-- Page info -->
			<div class="page-top-info">
				<div class="breadcrumb"> &nbsp;<a href="index.php">Home&nbsp;</a> » &nbsp;Search&nbsp</div>
			</div>
			<!-- Page info end -->
			<div class="row">
				<div class="col-lg-3 order-2 order-lg-1">
					<div class="filter-widget">
						<h2 class="fw-title">Categories</h2>
						<div class="accordion" id="showCat">
							<div class="card">
								@foreach($categories as $cat)
								<div class="card-header bg-light p-0" id="heading{{$cat->id}}">
									<h2 class="mb-0" style="line-height: 1;">
										<a href="category/{{$cat->url}}" class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse{{$cat->id}}" aria-expanded="true" aria-controls="collapse{{$cat->id}}">{{$cat->name}}</a>
									</h2>
								</div>
								<div id="collapse{{$cat->id}}" class="collapse" aria-labelledby="heading{{$cat->id}}" data-parent="#showCat">
									<div class="card-body">
										<ul class="list-group list-group-flush">
										@foreach($cat->categories as $subcat)
											<li class="list-group-item"><a href="category/{{$subcat->url}}">{{$subcat->name}}</a></li>
										@endforeach
										</ul>
									</div>
								</div>
								@endforeach
							</div>
						</div>
					</div>
					<div class="filter-widget">
						<h2 class="fw-title">Latest Products</h2>
						<ul class="category-menu">
							<li>
								@foreach($latests as $latest)
								<div class="lp-item">
									<div class="lp-thumb">
										<a href=""><img src="images/products/{{$latest->product_img}}" alt=""></a> 
									</div>
									<div class="lp-content">
										<a href="http://localhost:8000/products/{{$latest->id}}" class="title">{{$latest->product_name}}</a>
										<span>{{$latest->after_pprice}} <span class="old-price">{{$latest->before_price}}</span>
											<a href="http://localhost:8000/products/{{$latest->id}}" class="readmore">Read More</a>
										</span>
									</div>
								</div>
								@endforeach
							</li>
						</ul>
					</div>
				</div>

				<div class="col-lg-9  order-1 order-lg-2 mb-5 mb-lg-0">
					<div class="filter__item">
						<div class="row">
							<div class="col-lg-4 col-md-5 col-7">
								<div class="filter__sort">
									<span>Sort By</span>
									<select id="sortBy" style="display: none;">
										<option value="0">Default</option>
										<option value="0">Default</option>
									</select>
									<div class="nice-select" tabindex="0">
										<span class="current">Default</span>
										<ul class="list">
											<li data-value="0" class="option selected focus">Default</li>
											<li data-value="0" class="option">Default</li>
										</ul>
									</div>
								</div>
							</div>
							<div class="col-lg-4 col-md-4 hide-m">
								<div class="filter__found">
									<h6><span>16</span> Products found</h6>
								</div>
							</div>
							<div class="col-lg-4 col-md-3 col-5">
								<div class="filter__option">
									<span class="icon_grid-2x2"></span>
									<span class="icon_ul"></span>
								</div>
							</div>
						</div>
					</div>
					<div class="row display mb-5">
						@foreach($products as $product)
						<div class="col-lg-4 col-sm-4 col-6">
							<div class="single-product">
								<div class="product-img">
									<span class="pro-label new-label">new</span>
									<a href="http://localhost:8000/products/{{$product->id}}"><img src="images/products/{{$product->product_img}}" alt=""></a>
									<div class="product-action clearfix">
										<a href="#" data-toggle="tooltip" data-placement="top" title="Wishlist"><i class="fa fa-heart"></i></a>
										<a href="#" data-toggle="tooltip" data-placement="top" title="Quick View"><i class="fa fa-search-plus"></i></a>
										<a href="#" data-toggle="tooltip" data-placement="top" title="Add To Cart"><i class="fa fa-cart-plus"></i></a>
									</div>
								</div>
								<div class="product-info clearfix">
									<div class="fix">
										<p class="floatright hidden-sm">{{$product->catname}}</p>
										<h4 class="post-title text-left"><a href="http://localhost:8000/products/{{$product->id}}">{{$product->name}}</a></h4>
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
						<div class="m-auto paginator">{{$products->links()}}</div>
					</div>
				</div>
			</div>
		</div>
	</section>

@endsection