<div class="tab-pane {{ ( Session::get('active_tab') == 'nowpayment' || Session::get('active_tab') =="") ? 'active' : '' }}" id="nowpayment">
    <div class="p-a-md"><h5><i class="material-icons">&#xe30c;</i>&nbsp; Now Payment Details</h5></div>
    <div class="p-a-md col-md-12">
        <input type="hidden" name="payment_type" class="form-control" value="nowpay" />
		<div class="form-group">
			<label>Payment LOGO</label>
			<div id="logo-preview" class="mb-2">
				@if(!empty($paygateway->nowpayment_logo))
					<img src="{{ asset('uploads/payment/'.$paygateway->nowpayment_logo) }}" alt="" style="max-height: 80px;">
				@endif
			</div>
			<input type="file" name="nowpayment_logo" id="nowpayment_logo" class="form-control"
           {{ empty($paygateway->nowpayment_logo) ? 'required' : '' }}>
		</div>
		
		<div class="form-group">
			<label>Payment API</label>
			<input type="text" name="nowpayment_api" class="form-control" required value="{{ !empty($paygateway->nowpayment_api) ? $paygateway->nowpayment_api : '' }}" />
		</div>
		
		<div class="form-group">
			<label>Payment Security</label>
			<input type="text" name="nowpayment_security" class="form-control" required value= "{{ !empty($paygateway->nowpayment_security) ? $paygateway->nowpayment_security : '' }}" />
		</div>
		
		<div class="form-group">
			<label>Status</label>
			<select name="nowpayment_status" class="form-control" >
				<option value="1" {{ isset($paygateway->nowpayment_status) && $paygateway->nowpayment_status == 1 ? 'selected' : '' }}>Enabled</option>
				<option value="0" {{ isset($paygateway->nowpayment_status) && $paygateway->nowpayment_status == 0 ? 'selected' : '' }}>Disabled</option>
			</select>
		</div>		
    </div>
</div>