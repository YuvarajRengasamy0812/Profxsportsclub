@extends('dashboard.layouts.master')
@section('title',  __('backend.generalSettings'))
@section('content')
	<div class="padding">
        <div class="box">
            <div class="box-header dker">
                <h3><i class="material-icons">&#xe02e;</i> SMTP Configuration</h3>
                <small>
                    <a href="{{ route('adminHome') }}">{{ __('backend.home') }}</a>
                </small>
            </div>
			
			<div class="box-body p-a-2">
				{{ Form::open(['route'=>'mt5configstore', 'method'=>'POST', 'files' => true ]) }}
					@csrf
				<div class="row">
					<div class="col-sm-12 col-md-4">
						<div class="p-b-1">
							<label class="form-label">Sender Name</label>
                            <input type="text" class="form-control" name="sender_name" value="{{ $settings['sender_name'] }}" />
						</div>
					</div>
					<div class="col-sm-12 col-md-4 mb-3">
						<div class="p-b-1">
							<label class="form-label">Sender Email Address</label>
                            <input type="text" class="form-control" name="sender_email_address" value="{{ $settings['sender_email_address'] }}" />
						</div>
					</div>
					<div class="col-sm-12 col-md-10 mb-3">
						<div class="p-b-1">
							<label class="form-label">API Key</label>
                            <input type="text" class="form-control" name="api_key" value="{{ $settings['api_key'] }}" />
						</div>
					</div>
					
					<div class="col-sm-12 col-md-10 mb-3">
						<div class="p-b-1">
							<label class="form-label">Partner Key</label>
                            <input type="text" class="form-control" name="partner_key" value="{{ $settings['partner_key'] }}" />
						</div>
					</div>
				</div>
				<hr/>
				<div class="form-group row m-t-md">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-lg btn-primary m-t"><i class="material-icons">&#xe31b;</i> Update</button>
                    </div>
                </div>
                {{Form::close()}}
			</div>
		</div>
	</div>
@endsection
