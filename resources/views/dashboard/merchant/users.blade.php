@extends('dashboard.merchant.layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Users') }}</div>
                    <div class="card-body">
                        <table class="table table-borders" id="ajax-table">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        new DataTable('#ajax-table', {
            columnDefs: [ { orderable: false, targets: [3,4] }],
            ajax: '{{route('merchant.users.ajax')}}',
            processing: true,
            serverSide: true,
            'columns': [
                { data: 'id' },
                { data: 'name' },
                { data: 'email' },
                { data: 'status' },
                { data: 'action' }
            ]
        });
    </script>
@endsection
