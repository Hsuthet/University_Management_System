@extends('index')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 fw-bold">User Profile</h5>
                </div>

                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <tbody>
                            <tr>
                                <th>Name</th>
                                <td>{{ $user['name'] }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ $user['email'] }}</td>
                            </tr>
                            <tr>
                                <th>Role</th>
                                <td>{{ $user['role'] }}</td>
                            </tr>
                            <tr>
                                <th>Department</th>
                                <td>{{ $user['department'] }}</td>
                            </tr>
                            <tr>
                                <th>Academic Year</th>
                                <td>{{ $user['academic_year'] }}</td>
                            </tr>
                            <tr>
                                <th>Phone</th>
                                <td>{{ $user['phone'] }}</td>
                            </tr>
                            <tr>
                                <th>Age</th>
                                <td>{{ $user['age'] }}</td>
                            </tr>
                            <tr>
                                <th>Father Name</th>
                                <td>{{ $user['father_name'] }}</td>
                            </tr>
                            <tr>
                                <th>Gender</th>
                                <td>{{ $user['gender'] }}</td>
                            </tr>
                            <tr>
                                <th>NRC</th>
                                <td>{{ $user['nrc'] }}</td>
                            </tr>
                        </tbody>
                    </table>

                    {{-- Optional back button --}}
                    <a href="{{ url()->previous() }}" class="btn btn-secondary mt-3">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
