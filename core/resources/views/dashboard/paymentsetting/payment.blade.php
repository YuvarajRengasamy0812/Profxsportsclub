@extends('dashboard.layouts.master')
@section('title', 'Payment Settings')
@section('content')
    <div class="padding">
        <div class="row-col">
            <div class="col-sm-3 col-lg-2">
                <div class="p-y">
                    <div class="nav-active-border left b-primary">
                        <ul class="nav nav-sm">

                            <li class="nav-item">
                                <a class="nav-link block {{  ( Session::get('active_tab') == 'nowpayment' || Session::get('active_tab') =="") ? 'active' : '' }}"
                                   href="#"
                                   data-toggle="tab" data-target="#nowpayment"
                                   onclick="document.getElementById('active_tab').value='nowpayment'"><i
                                        class="material-icons">&#xe41d;</i>
                                    &nbsp; NowPayment</a>
                            </li>
							<li class="nav-item">
                                <a class="nav-link block {{ ( Session::get('active_tab') == 'stripepayment') ? 'active' : '' }}"
                                   href="#"
                                   data-toggle="tab" data-target="#stripepayment"
                                   onclick="document.getElementById('active_tab').value='stripepayment'"><i
                                        class="material-icons">&#xe30c;</i>
                                    &nbsp; Stripe</a>
                            </li>							
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-sm-7 col-lg-10 light lt">
			
                {{Form::open(['route'=>['paymentsettingsUpdate'],'method'=>'POST', 'files' => true ])}}
                <input type="hidden" id="active_tab" name="active_tab" value="{{ Session::get('active_tab') }}"/>
                <div class="tab-content">
                    <button type="submit" class="btn primary m-a pull-right"><i class="material-icons">&#xe31b;</i> {{ __('backend.update') }}</button>

                    @include('dashboard.paymentsetting.nowpayment')
                    @include('dashboard.paymentsetting.stripepayment')
                    
                </div>
                {{Form::close()}}
            </div>
        </div>
    </div>
@endsection
@push("after-scripts")
<script>
document.getElementById('nowpayment_logo').addEventListener('change', function(e) {
    const [file] = e.target.files;
    const previewContainer = document.getElementById('logo-preview');
    previewContainer.innerHTML = ''; // Clear old preview

    if (file) {
        const preview = document.createElement('img');
        preview.src = URL.createObjectURL(file);
        preview.style.maxHeight = '80px';
        previewContainer.appendChild(preview);
    }
});
</script>
@endpush
