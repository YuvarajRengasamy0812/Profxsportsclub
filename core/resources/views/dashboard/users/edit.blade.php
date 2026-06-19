@extends('dashboard.layouts.master')
@section('title', __('backend.usersPermissions'))
@section('content')
    <div class="padding">
        <div class="box">
            <div class="box-header dker">
                <h3><i class="material-icons">&#xe3c9;</i> {{ __('backend.editUser') }}</h3>
                <small>
                    <a href="{{ route('adminHome') }}">{{ __('backend.home') }}</a> /
                    <a href="">{{ __('backend.settings') }}</a> /
                    <a href="">{{ __('backend.usersPermissions') }}</a>
                </small>
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
                        <div class="col-sm-10 offset-sm-2">
                            @if($Users->kyc_document_path)
                                        {{-- <a href="{{ URL::to($Users->kyc_document_path) }}" target="_blank" class="btn btn-info btn-sm ms-2"> --}}
                                        <a href="{{ route('kyc.show', $Users->id)  }}"  class="btn btn-info btn-sm ms-2">

                                            View KYC
                                        </a>
                                    @endif
                            @if($Users->kyc_status == 0)
                               <!-- Approve Button -->
                                {{-- <form action="{{ route('kyc.approve', $Users->id) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Are you sure you want to approve this KYC?');">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm">Approve KYC</button>
                                </form>

                                <!-- Reject Button -->
                                <form action="{{ route('kyc.reject', $Users->id) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Are you sure you want to reject this KYC?');">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">Reject KYC</button>
                                </form> --}}



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
                {{Form::open(['route'=>['usersUpdate',$Users->id],'method'=>'POST', 'files' => true])}}

                <div class="form-group row">
                    <label for="name"
                           class="col-sm-2 form-control-label">{!!  __('backend.fullName') !!}
                    </label>
                    <div class="col-sm-10">
                        {!! Form::text('name',$Users->name, array('placeholder' => '','class' => 'form-control','id'=>'name','required'=>'')) !!}
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email"
                           class="col-sm-2 form-control-label">{!!  __('backend.loginEmail') !!}
                    </label>
                    <div class="col-sm-10">
                        {!! Form::email('email',$Users->email, array('placeholder' => '','class' => 'form-control','id'=>'email','required'=>'')) !!}
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password"
                           class="col-sm-2 form-control-label">{!!  __('backend.loginPassword') !!}
                    </label>
                    <div class="col-sm-10">
                        <input type="password" name="password" minlength="6" class="form-control">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="photo_file"
                           class="col-sm-2 form-control-label">{!!  __('backend.topicPhoto') !!}</label>
                    <div class="col-sm-10">
                        @if($Users->photo!="")
                            <div class="row">
                                <div class="col-sm-12">
                                    <div id="user_photo" class="col-sm-4 box p-a-xs">
                                        <a target="_blank"
                                           href="{{ asset('uploads/users/'.$Users->photo) }}"><img
                                                src="{{ asset('uploads/users/'.$Users->photo) }}"
                                                class="img-responsive">
                                            {{ $Users->photo }}
                                        </a>
                                        <br>
                                        <a onclick="document.getElementById('user_photo').style.display='none';document.getElementById('photo_delete').value='1';document.getElementById('undo').style.display='block';"
                                           class="btn btn-sm btn-default">{!!  __('backend.delete') !!}</a>
                                    </div>
                                    <div id="undo" class="col-sm-4 p-a-xs" style="display: none">
                                        <a onclick="document.getElementById('user_photo').style.display='block';document.getElementById('photo_delete').value='0';document.getElementById('undo').style.display='none';">
                                            <i class="material-icons">&#xe166;</i> {!!  __('backend.undoDelete') !!}
                                        </a>
                                    </div>

                                    {!! Form::hidden('photo_delete','0', array('id'=>'photo_delete')) !!}
                                </div>
                            </div>
                        @endif

                        {!! Form::file('photo', array('class' => 'form-control','id'=>'photo','accept'=>'image/*')) !!}
                        <small>
                            <i class="material-icons">&#xe8fd;</i>
                            {!!  __('backend.imagesTypes') !!}
                        </small>
                    </div>
                </div>

                @if(@Auth::user()->permissionsGroup->webmaster_status)
                    <div class="form-group row">
                        <label for="permissions1"
                               class="col-sm-2 form-control-label">{!!  __('backend.Permission') !!}</label>
                        <div class="col-sm-10">
                            <div class="radio">
                                <select name="permissions_id" id="permissions_id" required
                                        class="form-control c-select">
                                    <option value="">- - {!!  __('backend.selectPermissionsType') !!} - -</option>
                                    @foreach ($Permissions as $Permission)
                                        <option value="{{ $Permission->id  }}" {!! ($Users->permissions_id==$Permission->id) ? "selected='selected'":"" !!}>{{ $Permission->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="link_status"
                               class="col-sm-2 form-control-label">{!!  __('backend.status') !!}</label>
                        <div class="col-sm-10">
                            <div class="radio">
                                <label class="ui-check ui-check-md">
                                    {!! Form::radio('status','1',($Users->status==1) ? true : false, array('id' => 'status1','class'=>'has-value')) !!}
                                    <i class="dark-white"></i>
                                    {{ __('backend.active') }}
                                </label>
                                &nbsp; &nbsp;
                                <label class="ui-check ui-check-md">
                                    {!! Form::radio('status','0',($Users->status==0) ? true : false, array('id' => 'status2','class'=>'has-value')) !!}
                                    <i class="dark-white"></i>
                                    {{ __('backend.notActive') }}
                                </label>
                            </div>
                        </div>
                    </div>
                @else
                    {!! Form::hidden('permissions_id',$Users->permissions_id) !!}
                    {!! Form::hidden('status',$Users->status) !!}

                @endif


                <div class="form-group row m-t-md">
                    <div class="offset-sm-2 col-sm-10">
                        <button type="submit" class="btn btn-lg btn-primary m-t"><i class="material-icons">
                                &#xe31b;</i> {!! __('backend.update') !!}</button>
                        <a href="{{route("users")}}"
                           class="btn btn-lg btn-default m-t"><i class="material-icons">
                                &#xe5cd;</i> {!! __('backend.cancel') !!}</a>
                    </div>
                </div>

                {{Form::close()}}
            </div>
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


