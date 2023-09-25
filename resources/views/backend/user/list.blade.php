@extends('backend.layout.app')

@section('style')
@endsection


@section('content')
    <div class="pagetitle" style="margin-bottom: 20px;">
        <h1>Users List</h1>

    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">



                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Users List
                                <a href="" class="btn btn-primary" style="float: right; margin-top: -12px;">Add New
                                    User</a>
                            </h5>

                            <!-- Table with stripped rows -->
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Email Verified</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Date Created</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @forelse ($getRecord as $value)
                                        <tr>
                                            <th scope="row">{{ $value->id }}</th>
                                            <td>{{ $value->name }}</td>
                                            <td>{{ $value->email }}</td>
                                            <td>{{ $value->email_verified_at ? 'Yes' : 'No'}} </td>
                                            <td>{{ $value->status ? 'Verified' : 'Not Verified'}} </td>
                                            {{-- <td>{{ $value->created_at }}</td> --}}
                                            <td>{{ date('d-m-Y H:i A', strtotime($value->created_at)) }}</td>
                                            <td>
                                                <a href="" class="btn btn-primary btn-sm">Edit</a>
                                                <a href="" class="btn btn-danger btn-sm">Delete</a>
                                            </td>

                                        </tr>
                                        @empty
                                            <tr>
                                                <td colspan="100%">Record not found</td>
                                            </tr>
                                        @endforelse



                                    </tbody>
                                </table>


                                {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}

                            </div>
                        </div>







                    </div>
                </div>
        </section>
    @endsection


@section('script')
@endsection
