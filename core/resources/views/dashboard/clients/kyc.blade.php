@extends('dashboard.layouts.master')
@section('title', __('backend.usersPermissions'))
@section('content')
    <div class="padding">
        <div class="box">
            <div class="box-header dker">
                <h3><i class="material-icons">&#xe3c9;</i> KYC Documents</h3>
                {{-- <small>
                    <a href="{{ route('adminHome') }}">{{ __('backend.home') }}</a> /
                    <a href="">{{ __('backend.settings') }}</a> /
                    <a href="">{{ __('backend.usersPermissions') }}</a>
                </small> --}}
            </div>
            <div class="box-tool">
                <ul class="nav">
                    <li class="nav-item inline">
                        <a class="nav-link" href="{{route("users")}}">
                            <i class="material-icons md-18">×</i>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="box-body">
                <div class="col-sm-10 offset-sm-2 p-a-1" style="text-align: end;">
                   <div class="form-group row mt-3">
                        <div class="col-sm-10 offset-sm-2 m-a-1">

                            @if($Users->kyc_status == 0)


                                <button class="btn btn-sm success m-x" data-toggle="modal" data-target="#approve-{{ $Users->id }}">
                                    <small><i class="fa fa-check"></i> Approve</small>
                                </button>

                                <button class="btn btn-sm danger" data-toggle="modal" data-target="#reject-{{ $Users->id }}">
                                    <small><i class="fa fa-times"></i> Reject</small>
                                </button>

                            @else
                                @php
                                    $badgeClass = $Users->kyc_status == 1 ? 'bg-success' : 'bg-danger';
                                    $badgeText = $Users->kyc_status == 1 ? 'Approved' : 'Rejected';
                                @endphp
                                <button class="btn btn-sm {{ $badgeClass }}">{{ $badgeText }}</button>
                                 <!-- View KYC Button -->

                            @endif
                        </div>
                    </div>

                </div>

            </div>
        </div>
        <div class="col-sm-12 offset-sm-2 p-a-1 col-lg-5 ">
                @php
                    $files = [
                        'Front ID' => $Users->kyc_document_path,
                        'Back ID' => $Users->id_second,
                        'Address Proof' => $Users->address_proof,
                    ];
                @endphp

                @if(count(array_filter($files)) > 0)
                     {{-- <h5>KYC Documents</h5> --}}
                    <div class="d-flex justify-content-center flex-wrap gap-3" style="display:flex; justify-content:center;">
                        @foreach($files as $label => $path)
                            @if($path)
                                @php
                                    $extension = pathinfo($path, PATHINFO_EXTENSION);
                                @endphp

                                <div class="text-center" style="max-width: 200px;">
                                    <p><strong>{{ $label }}</strong></p>

                                    @if(in_array(strtolower($extension), ['jpg','jpeg','png']))
                                        <a href="{{ URL::to($path) }}" target="_blank">
                                            <img src="{{ URL::to($path) }}" alt="{{ $label }}" class="img-thumbnail" style="max-width: 180px; height: auto;">
                                        </a>
                                    @elseif(strtolower($extension) === 'pdf')
                                        <a href="{{ URL::to($path) }}" target="_blank" class="btn btn-info btn-sm">
                                            View PDF
                                        </a>
                                    @endif
                                    <p class="mt-1"><small>{{ strtoupper($extension) }} File</small></p>
                                </div>

                            @endif
                        @endforeach
                    </div>
                @else
                    <p>No KYC documents uploaded.</p>
                @endif
        </div>

    </div>


    <div id="reject-{{ $Users->id }}" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content text-center">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Reject</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to reject this KYC?</p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>

                <form action="{{ route('kyc.reject', $Users->id) }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-danger">Reject</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div id="approve-{{ $Users->id }}" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content text-center">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Approve</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to approve this KYC?</p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>

                <form action="{{ route('kyc.approve', $Users->id) }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-success">Approve</button>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection


