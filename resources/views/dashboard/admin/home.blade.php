@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mt-2">
                    <div class="card-header">
                        <div class="float-end">
                            <a href="{{route('admin.users')}}">
                                {{$customers}}
                            </a>
                        </div>
                        <div>{{ __('Users') }}</div>
                    </div>
                </div>
                <div class="card mt-2">
                    <div class="card-header">
                        <div class="float-end">
                            <a href="{{route('admin.merchants')}}">
                                {{$merchants}}
                            </a>
                        </div>
                        <div>{{ __('Merchants') }}</div>
                    </div>
                </div>
                <div class="card mt-2">
                    <div class="card-header">
                        <div class="float-end">
                            <a href="{{route('admin.admins')}}">
                                {{$admins}}
                            </a>
                        </div>
                        <div>{{ __('Admins') }}</div>

                    </div>
                </div>

                <div class="card mt-2">
                    <div class="card-header">
                        <div class="float-end">
                            <a href="{{route('admin.orders')}}">
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
