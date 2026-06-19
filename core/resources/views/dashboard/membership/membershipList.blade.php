@extends('dashboard.layouts.master') 
@section('title','membership  Details')
@section('content')

<style>
/* ===== Card ===== */
.card-box{
    background:#fff;
    border-radius:14px;
    padding:22px;
    box-shadow:0 12px 30px rgba(0,0,0,.08);
    transition:.3s;
}
.card-box:hover{
    transform:translateY(-3px);
    box-shadow:0 18px 45px rgba(0,0,0,.12);
}

/* ===== Inputs & Buttons ===== */
.form-control-lg{
    border-radius:10px;
    height:48px;
}
.btn-lg{
    border-radius:10px;
    height:48px;
}

/* ===== Table ===== */
.table thead th{
    background:#f8f9fa;
    font-weight:600;
    border:none;
}
.table tbody tr{
    position:relative;
    transition:.25s;
}
.table tbody tr:hover{
    background:#f4f8ff;
    transform:scale(1.01);
}
.table tbody tr::after{
    content:'';
    position:absolute;
    inset:0;
    background:linear-gradient(90deg,rgba(0,123,255,.06),transparent);
    opacity:0;
    transition:.3s;
    pointer-events:none;
}
.table tbody tr:hover::after{
    opacity:1;
}

/* ===== Action Button ===== */
.btn-view{
    border-radius:20px;
    padding:4px 16px;
}

/* ===== Pagination ===== */
.pagination{
    justify-content:center;
}
</style>

<div class="padding">

    <!-- 🔍 SEARCH + EXPORT -->
    <div class="card-box mb-4">
        <form method="GET" class="row align-items-center">

            <!-- Big Email Search -->
            <div class="col-md-4 mb-2">
                <input type="text"
                       name="email"
                       class="form-control form-control-lg"
                       placeholder=" Search by Email"
                       value="{{ request('email') }}">
            </div>

            <!-- Big Game Search -->
            <div class="col-md-4 mb-2">
                <input type="text"
                       name="location"
                       class="form-control form-control-lg"
                       placeholder=" Search by location"
                       value="{{ request('location') }}">
            </div>

            <!-- Search Button -->
            <div class="col-md-2 mb-2">
                <button class="btn btn-primary btn-lg w-100">
                    <i class="material-icons">search</i> Search
                </button>
            </div>

            <!-- Export Button Right -->
            <!-- <div class="col-md-2 mb-2 text-right">
                <a href="{{ route('corporateList', array_merge(request()->all(), ['export'=>'csv'])) }}"
                   class="btn btn-success btn-lg w-100">
                    <i class="material-icons">download</i> Export
                </a>
            </div> -->

        </form>
    </div>

    <!-- 📋 TABLE -->
    <div class="card-box">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>S.NO</th>
                        <th>Name</th>
                       <th>Email</th>
                        <th>Location</th>
                        <th>Company_Name</th>
                          <th>Designation</th>
                        <th>Phone</th>
                        <th>Date</th>
                        
                        <th class="text-right">Action</th>
                    </tr>
                </thead>

                <tbody>
                @forelse($memberships as $membership)
                    <tr>
                        <td>{{ $membership->id }}</td>
                        
                        <td class="fw-bold">{{ $membership->name }}</td>
                        <td>{{ $membership->email }}</td>
                        <td>
                            <span class="badge badge-info">
                                {{ $membership->location}}
                            </span>
                        </td>
                     <td class="font-semibold">
    {{ $membership->company ?? 'Guest' }}
</td>
<td>{{ $membership->role }}</td>
<td>{{ $membership->phone }}</td>
                        <td>{{ date('d M Y', strtotime($membership->created_at)) }}</td>
                        <td class="text-right">
                            <a href="{{ route('membershipView',$membership->id) }}"
                               class="btn btn-outline-primary btn-sm btn-view">
                                View
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">
                            No membership records found
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {!! $memberships->links() !!}
        </div>
    </div>

</div>
@endsection
