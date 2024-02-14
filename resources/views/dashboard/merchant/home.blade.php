@extends('dashboard.merchant.layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="float-end">{{$users}}</div>
                        <div>{{ __('Users') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
