@extends('dashboard.merchant.layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header">{{ __('My Account') }}</div>
                    <div class="card-body">
                        <table class="table table-borders">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Joined Since</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{$me->id}}</td>
                                <td>{{$me->name}}</td>
                                <td>{{$me->email}}</td>
                                <td>{{$me->created_at->diffForHumans()}}</td>
                                <td>
                                    @if($me->status)
                                        <span class="badge bg-success">Approved</span>
                                    @else
                                        <span class="badge bg-danger">Not Approved</span>
                                    @endif
                                </td>
                            </tr>


                            </tbody>
                        </table>

                    </div>
                </div>
                <div class="card">
                    <div class="card-header">{{ __('My Orders') }}</div>
                    <div class="card-body">
                        <table class="table table-borders">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Customer</th>
                                <th>Merchant</th>
                                <th>Description</th>
                                <th>At</th>
                                <th>Amount</th>
                                <th>Tax</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td>{{$order->id}}</td>
                                    <td>{{$order->customer->name}} | {{$order->customer->email}}</td>
                                    <td>{{$order->merchant->name}}</td>
                                    <td>{{$order->description}}</td>
                                    <td>{{$order->created_at->diffForHumans()}}</td>
                                    <td>{{$order->amount}}</td>
                                    <td>{{$order->tax}}</td>
                                    <td>
                                    @if($order->status === 'new')
                                            <span class="badge bg-primary">New</span>
                                        @elseif($order->status === 'processing')
                                            <span class="badge bg-warning">Processing</span>
                                        @elseif($order->status === 'ready')
                                            <span class="badge bg-danger">Ready</span>
                                        @else
                                            <span class="badge bg-success">Finished</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                        {!! $orders->render('vendor.pagination.bootstrap-4') !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
