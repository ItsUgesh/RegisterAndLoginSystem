@extends("layouts.default")
@section("title","Registration")
@section("content")

<main class="mt-5">
    <div class="comtainer">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <!--passing from registerPost to show the error or success message -->
                @if(session()->has("success"))
                <div class="alert alert-success">
                    {{session()->get("success")}}
                </div>
                @endif
                @if(session()->has("error"))
                <div class="alert alert-danger">
                    {{session()->get("error")}}
                </div>
                @endif
                <div class="card">
                    <h3 class="card-header text-center">Registration</h3>
                    <div class="card-body">
                        <form action="{{route('register.post')}}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <input type="text" placeholder="Enter your fullname" id="fullname" class="form-control" name="fullname" autofocus>
                                @if($errors->has('fullname'))
                                <span class="text-danger">
                                    {{$errors->first('fullname')}}
                                </span>
                                @endif
                            </div>
                            <div class="form-group mb-3">
                                <input type="text" placeholder="Enter your email" id="email" class="form-control" name="email" autofocus>
                                @if($errors->has('email'))
                                <span class="text-danger">
                                    {{$errors->first('email')}}
                                </span>
                                @endif
                            </div>
                            <div class="form-group mb-3">
                                <input type="password" placeholder="Enter Your password" id="password" class="form-control" name="password" required>
                                @if($errors->has('password'))
                                <span class="text-danger">
                                    {{$errors->first('password')}}
                                </span>
                                @endif
                            </div>
                            <div class="d-grid mx-auto">
                                <button type="submit" class="btn btn-class btn-dark btn-block">Sing up</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


@endsection