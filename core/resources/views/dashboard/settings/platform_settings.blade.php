@extends('dashboard.layouts.master')
@section('title',  __('backend.generalSettings'))
@section('content')
	<div class="padding">
        <div class="box">
            <div class="box-header dker">
                <h3><i class="material-icons">&#xe02e;</i> Platform Download</h3>
                <small>
                    <a href="{{ route('adminHome') }}">{{ __('backend.home') }}</a>
                </small>
            </div>
			
			<div class="box-body p-a-2">
				{{ Form::open(['route'=>'mt5configstore', 'method'=>'POST', 'files' => true ]) }}
					@csrf
				<div class="row">
					<div class="col-sm-12 col-md-10">
						<div class="p-b-1">
							<label class="form-label">Windows</label>
                            <input type="text" class="form-control" name="mt5_windows_platform" value="{{ $settings['mt5_windows_platform'] }}" />
						</div>
					</div>
					<div class="col-sm-12 col-md-10">
						<div class="p-b-1">
							<label class="form-label">Android</label>
                            <input type="text" class="form-control" name="mt5_android_platform" value="{{ $settings['mt5_android_platform'] }}" />
						</div>
					</div>
					<div class="col-sm-12 col-md-10">
						<div class="p-b-1">
							<label class="form-label">Apple / iOS</label>
                            <input type="text" class="form-control" name="mt5_ios_platform" value="{{ $settings['mt5_ios_platform'] }}" />
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
