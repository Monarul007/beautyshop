@extends('layouts.index')

@section('content')

                </div>
            </div>
    </section>
    <!-- Hero Section End -->

    <div class="container">
		<div class="page-top-info">
			<div class="breadcrumb"> &nbsp;<a href="/">Home&nbsp;</a> » &nbsp;<a href="#">Login/Register&nbsp;</a> </div>
		</div>
    </div>
    <section id="form"><!--form-->
		<div class="container">
			<div class="col-md-7 col-12 p-0" style="margin: 50px auto;">
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
                <div class="form-wrapper">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">LOGIN</a>
                            <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">REGISTER</a>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                            <div class="login-form"><!--login form-->
                                <h4 class="mb-3">Login to your account</h4>
                                <form action="{{ url('/user_logoin') }}" method="POST" id="LoginForm" class="needs-validation mt-2" novalidate>
                                    @csrf
                                    <div class="form-group">
                                        <input type="email" name="logEmail" placeholder="Email Address" class="form-control">
                                    </div>
                                    <div class="form-group mb-3">
                                        <input type="password" name="logPass" placeholder="Enter Password" class="form-control">
                                    </div>
                                    <div class="form-check mb-4">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1">Keep Me Looged In</label>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div><!--/login form-->
                        </div>
                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                            <div class="signup-form"><!--sign up form-->
                                <h4 class="mb-4">New User? Signup!</h4>
                                <form action="{{ url('/user_register') }}" method="POST" id="RegisterForm" class="needs-validation mt-2" novalidate>
                                    @csrf
                                    <div class="form-group">
                                        <input type="text" name="inputName" id="inputName" placeholder="Name" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="email" name="inputEmail" id="inputEmail" placeholder="Email Address" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="phone" name="inputPhone" id="inputPhone" placeholder="Phone Number" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="inputAddress" id="inputAddress" placeholder="House No, Road No. or Name, Location Name, District Name-79658" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="inputPass" id="inputPass" placeholder="Password" class="form-control" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Signup</button>
                                </form>
                            </div><!--/sign up form-->
                        </div>
                    </div>
                </div>
            </div>
		</div>
	</section>

<style>
.tab-content>.tab-pane {
    background: #fff;
    padding: 30px;
    border: 1px solid #dadada;
    border-top: none;
}
.nav-tabs .nav-link {
    width: 50%;
    text-align: center;
    padding: 16px;
    color: #fff;
    background: #111111;
    border-top-left-radius: 0;
    border-top-right-radius: 0;
}
</style>
@endsection