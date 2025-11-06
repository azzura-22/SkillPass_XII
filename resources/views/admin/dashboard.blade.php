@extends('admin.template')
@section('content')
<div class="container mt-4">
    <div class="col-md-3 mb-4">
            <div class="card text-white bg-primary shadow">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title mb-0">Users</h5>
                            <h2 class="mt-2">{{ $userCount ?? 120 }}</h2>
                        </div>
                        <i class="fa-solid fa-users fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
</div>
@endsection
