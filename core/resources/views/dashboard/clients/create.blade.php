@extends('dashboard.layouts.master')
@section('title', 'Clients - Add New')
@section('content')
    <div class="padding">
        <div class="box">
            <div class="box-header dker">
                <h2><i class="material-icons">&#xe02e;</i> Add New Client</h2>
                <small>
                    <a href="{{ route('adminHome') }}">{{ __('backend.home') }}</a> /
                    <a href="{{ route('clientlist') }}">Client List</a>
                </small>
            </div>
			
			<div class="box-body p-a-2">
				{{Form::open(['route'=>['clientregister'],'method'=>'POST', 'files' => true ])}}
				<div class="row">
					<div class="col-sm-12 col-md-4">
						<div class="p-b-1">
							<label class="form-label">Full Name</label>
							<input type="text" class="form-control" name="firstname" value="" required />
						</div>
					</div>
					<div class="col-sm-12 col-md-4 mb-3">
						<div class="p-b-1">
							<label class="form-label">Email</label>
							<input type="email" class="form-control" name="email" value="" required autocomplete="off" />
						</div>
					</div>
					<div class="col-sm-12 col-md-4 mb-3">
						<div class="p-b-1">
							<label class="form-label">Password</label>
							<div class="input-group">
								<input type="text" class="form-control" name="password" required autocomplete="off" />
							</div>
						</div>
					</div>
					<div class="col-sm-12 col-md-4 mb-3">
						<div class="p-b-1">
							<label class="form-label">Country</label>
							<select name="nationalities" id="nationalities" class="form-control" required>
								<option value="" selected disabled>Nationality</option>
								@foreach($nationalities as $national)
									<option value="{{ $national['id'] }}" data-code="{{ $national['tel'] }}" {{ old('nationalities') == $national['id'] ? 'selected' : '' }}>
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
									<option value="{{ $national['tel'] }}" {{ old('country_code') == $national['tel'] ? 'selected' : '' }}>
										+{{ $national['tel'] }} - {{ $national['title_en'] }}
									</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="col-sm-12 col-md-3 mb-3">
						<div class="p-b-1">
							<label class="form-label">Phone Number</label>
							<input autocomplete="new-phone" type="text" name="contact_phone" class="form-control border" placeholder="Mobile Number" value="{{ old('contact_phone') }}" required>
						</div>
					</div>
					<div class="col-sm-12 col-md-4 mb-3">
						<div class="p-b-1">
							<label class="form-label">Referral Code</label>
							<input name="referral_code" value="" class="form-control" type="text" />
						</div>
					</div>
				</div>
				<hr/>
				<div class="form-group row m-t-md">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-lg btn-primary m-t"><i class="material-icons">
                                &#xe31b;</i> {!! __('backend.add') !!}</button>
                        <a href="{{route("clientlist")}}"
                           class="btn btn-lg btn-default m-t"><i class="material-icons">
                                &#xe5cd;</i> {!! __('backend.cancel') !!}</a>
                    </div>
                </div>
                {{Form::close()}}
			</div>
		</div>
	</div>
@endsection
