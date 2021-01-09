@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-2">
            @include('layouts.aside')
        </div>

        <div class="col-lg-10">
            <div class="card">
                <div class="card-header">@yield('title')</div>

                <div class="card-body">
                    @yield('card-body-content')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
