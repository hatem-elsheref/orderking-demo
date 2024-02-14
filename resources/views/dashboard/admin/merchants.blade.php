@extends('dashboard.merchant.layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Merchants') }}</div>
                    <div class="card-body">
                        <table class="table table-borders">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Store/Domain</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{$user->id}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->store->name}} / {{sprintf('%s.%s', $user->store->domain->domain, config('app.central_domain'))}}</td>
                                    <td>
                                        <a href="{{route('admin.merchant.users', $user->store->id)}}" class="btn btn-sm btn-primary">Show Users</a>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                        {!! $users->render('vendor.pagination.bootstrap-4') !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
