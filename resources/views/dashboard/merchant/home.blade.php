@extends('dashboard.merchant.layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="float-end">
                            <a href="{{route('merchant.users')}}">
                                {{$users}}
                            </a>
                        </div>
                        <div>{{ __('Users') }}</div>
                    </div>
                </div>

                <div class="card mt-2">
                    <div class="card-header">
                        <div class="float-end">
                            <a href="{{route('merchant.orders')}}">
                                {{$orders}}
                            </a>
                        </div>
                        <div>{{ __('Orders') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
