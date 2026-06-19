<div class="tab-pane {{ ( Session::get('active_tab') == 'stripepayment') ? 'active' : '' }}" id="stripepayment">
    <div class="p-a-md"><h5><i class="material-icons">&#xe30c;</i>&nbsp; Stripe Details</h5></div>
    <div class="p-a-md col-md-12">
        <input type="hidden" name="payment_type" class="form-control" value="stripe" />
		<div class="form-group">
			<label>LOGO</label>
			<div id="logo-preview" class="mb-2">
				@if(!empty($paygateway->stripe_logo) && file_exists(asset('uploads/payment/'.$paygateway->stripe_logo)))
					<img src="{{ asset('uploads/payment/'.$paygateway->stripe_logo) }}" alt="" style="max-height: 80px;">
				@endif
			</div>
			<input type="file" name="stripe_logo" id="stripe_logo" class="form-control"
           {{ empty($paygateway->stripe_logo) ? 'required' : '' }}>
		</div>
		
		<div class="form-group">
			<label>Select Use Type</label>
			<select name="stripe_type" class="form-control" required>
				<option value="test" {{ $paygateway->stripe_logo == 'test' ? 'selected' : '' }}>Test</option>
				<option value="live" {{ $paygateway->stripe_logo == 'live' ? 'selected' : '' }}>Live</option>
			</select>
		</div>
		
		<div class="form-group">
			<label>Payment API</label>
			<input type="text" name="stripe_apikey" class="form-control" required value="{{ !empty($paygateway->stripe_apikey) ? $paygateway->stripe_apikey : '' }}" />
		</div>
		
		<div class="form-group">
			<label>Payment Published</label>
			<input type="text" name="stripe_publishedkey" class="form-control" required value= "{{ !empty($paygateway->stripe_publishedkey) ? $paygateway->stripe_publishedkey : '' }}" />
		</div>
		
		<div class="form-group">
			<label>Status</label>
			<select name="stripe_status" class="form-control" >
				<option value="1" {{ isset($paygateway->stripe_status) && $paygateway->stripe_status == 1 ? 'selected' : '' }}>Enabled</option>
				<option value="0" {{ isset($paygateway->stripe_status) && $paygateway->stripe_status == 0 ? 'selected' : '' }}>Disabled</option>
			</select>
		</div>		
    </div>
</div>