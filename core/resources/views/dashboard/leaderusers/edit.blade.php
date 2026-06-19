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
			<div class="box-body p-a-2">
				{{Form::open(['route'=>['leaderuserupdate',$Users->id],'method'=>'POST', 'files' => true ])}}
				<div class="row">
					<div class="col-sm-12 col-md-4">
						<div class="p-b-1">
							<label class="form-label">Full Name</label>
							<input type="text" class="form-control" name="firstname" value="{{ $Users->name }}" required />
						</div>
					</div>
					<div class="col-sm-12 col-md-4 mb-3">
						<div class="p-b-1">
							<label class="form-label">Email</label>
							<input type="email" class="form-control" name="email" value="{{ $Users->email }}" required autocomplete="off" readonly />
						</div>
					</div>
					<div class="col-sm-12 col-md-2 mb-3">
						<div class="p-b-1">
							<label class="form-label">Profile Image</label>
							<input type="file" class="form-control" name="profile_image" />
							<input type="hidden" class="form-control" name="profile_image_hidden" value="{{ $Users->profile_image }}"  />
						</div>
					</div>
					
					@if($Users->profile_image!="")
					<div class="col-sm-12 col-md-1 mb-3">
						<div class="p-b-1">
							<a target="_blank" href="{{ asset($Users->profile_image) }}">
								<img src="{{ asset($Users->profile_image) }}" class="img-responsive" />
							</a>
							
						</div>
					</div>
					@endif
					
					<div class="col-sm-12 col-md-4 mb-3">
						<div class="p-b-1">
							<label class="form-label">Country</label>
							<select name="nationalities" id="nationalities" class="form-control" required>
								<option value="" selected disabled>Nationality</option>
								@foreach($nationalities as $national)
									<option value="{{ $national['id'] }}" data-code="{{ $national['tel'] }}" {{ $Users->nationalities == $national['id'] ? 'selected' : '' }}>
										{{ $national['title_en'] }}
									</option>
								@endforeach
							</select>							
						</div>
					</div>
					<div class="col-sm-12 col-md-1 mb-3">
						<div class="p-b-1">
							<label class="form-label">Phone Code</label>
							<select name="country_code" id="country_code" class="form-control border select2" required>
								<option value="" selected disabled>Country Code</option>
								@foreach($nationalities as $national)
									<option value="{{ $national['tel'] }}" {{ $Users->country_code == $national['tel'] ? 'selected' : '' }}>
										+{{ $national['tel'] }} - {{ $national['title_en'] }}
									</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="col-sm-12 col-md-3 mb-3">
						<div class="p-b-1">
							<label class="form-label">Phone Number</label>
							<input autocomplete="new-phone" type="text" name="contact_phone" class="form-control border" placeholder="Mobile Number" value="{{ $Users->phone }}" required >
						</div>
					</div>
				</div>
				<hr/>
				<div class="form-group row m-t-md">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-lg btn-primary m-t"><i class="material-icons">
                                &#xe31b;</i> Update </button>
                        <a href="{{route("leaderuserlist")}}"
                           class="btn btn-lg btn-default m-t"><i class="material-icons">
                                &#xe5cd;</i> Cancel</a>
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


