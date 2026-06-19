@extends('dashboard.layouts.master')
@section('title',  __('backend.generalSettings'))
@section('content')
	<div class="padding">
        <div class="box">
            <div class="box-header dker">
                <h3><i class="material-icons">&#xe02e;</i> MT5 Server Details</h3>
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
							<label class="form-label">MT5 Company Name</label>
							<input type="text" class="form-control" name="mt5_company_name" value="{{ $settings['mt5_company_name'] }}" required />
						</div>
					</div>
					<div class="col-sm-12 col-md-4 mb-3">
						<div class="p-b-1">
							<label class="form-label">MT5 Server IP</label>
							<input type="text" class="form-control" name="mt5_server_ip" value="{{ $settings['mt5_server_ip'] }}" required />
						</div>
					</div>
					<div class="col-sm-12 col-md-4 mb-3">
						<div class="p-b-1">
							<label class="form-label">MT5 Server Port</label>
							<input type="text" class="form-control" name="mt5_server_port" value="{{ $settings['mt5_server_port'] }}" required />
						</div>
					</div>
					
					<div class="col-sm-12 col-md-4 mb-3">
						<div class="p-b-1">
							<label class="form-label">MT5 Server Web Login</label>
							<input type="text" class="form-control" name="mt5_server_web_login" value="{{ $settings['mt5_server_web_login'] }}" required />
						</div>
					</div>
					<div class="col-sm-12 col-md-4">
						<div class="p-b-1">
							<label class="form-label">MT5 Server Web Password</label>
							<input type="text" class="form-control" name="mt5_server_web_password" value="{{ $settings['mt5_server_web_password'] }}" required />
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
