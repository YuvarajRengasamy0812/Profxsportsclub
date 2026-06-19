@extends('dashboard.layouts.master')
@section('title', 'Edit MT5 Server')
@section('content')
<div class="padding">
    <div class="box">

        <div class="box-header dker">
            <h3><i class="material-icons">&#xe3c9;</i> Edit MT5 Server</h3>
            <small>
                <a href="{{ route('adminHome') }}">Home</a> /
                <a href="{{ route('mt5serverlist') }}">MT5 Server</a>
            </small>
        </div>

        <!--<div class="box-body">-->
        <!--    {{ Form::model($account, ['route' => ['mt5Update', $account->id], 'method' => 'PUT']) }}-->

        <!--    <div class="form-group row">-->
        <!--        <label class="col-sm-2 form-control-label">Company Title</label>-->
        <!--        <div class="col-sm-10">-->
        <!--            {!! Form::text('company_title', $account->company_title, ['class' => 'form-control', 'required']) !!}-->
        <!--        </div>-->
        <!--    </div>-->

        <!--    <div class="form-group row">-->
        <!--        <label class="col-sm-2 form-control-label">MT5 Company Name</label>-->
        <!--        <div class="col-sm-10">-->
        <!--            {!! Form::text('mt5_company_name', $account->mt5_company_name, ['class' => 'form-control', 'required']) !!}-->
        <!--        </div>-->
        <!--    </div>-->

        <!--    <div class="form-group row">-->
        <!--        <label class="col-sm-2 form-control-label">Server IP</label>-->
        <!--        <div class="col-sm-10">-->
        <!--            {!! Form::text('mt5_server_ip', $account->mt5_server_ip, ['class' => 'form-control', 'required']) !!}-->
        <!--        </div>-->
        <!--    </div>-->

        <!--    <div class="form-group row">-->
        <!--        <label class="col-sm-2 form-control-label">Server Port</label>-->
        <!--        <div class="col-sm-10">-->
        <!--            {!! Form::text('mt5_server_port', $account->mt5_server_port, ['class' => 'form-control', 'required']) !!}-->
        <!--        </div>-->
        <!--    </div>-->

        <!--    <div class="form-group row">-->
        <!--        <label class="col-sm-2 form-control-label">Web Login</label>-->
        <!--        <div class="col-sm-10">-->
        <!--            {!! Form::text('mt5_server_web_login', $account->mt5_server_web_login, ['class' => 'form-control', 'required']) !!}-->
        <!--        </div>-->
        <!--    </div>-->

        <!--    <div class="form-group row">-->
        <!--        <label class="col-sm-2 form-control-label">Web Password</label>-->
        <!--        <div class="col-sm-10">-->
        <!--            {!! Form::text('mt5_server_web_password', $account->mt5_server_web_password, ['class' => 'form-control', 'required']) !!}-->
        <!--        </div>-->
        <!--    </div>-->

        <!--    <div class="form-group row">-->
        <!--        <label class="col-sm-2 form-control-label">Status</label>-->
        <!--        <div class="col-sm-10">-->
        <!--            <select name="status" class="form-control">-->
        <!--                <option value="1" {{ $account->status == 1 ? 'selected' : '' }}>Active</option>-->
        <!--                <option value="0" {{ $account->status == 0 ? 'selected' : '' }}>Inactive</option>-->
        <!--            </select>-->
        <!--        </div>-->
        <!--    </div>-->

        <!--    <div class="form-group row m-t-md">-->
        <!--        <div class="offset-sm-2 col-sm-10">-->
        <!--            <button type="submit" class="btn btn-lg btn-primary">-->
        <!--                <i class="material-icons">&#xe31b;</i> Update-->
        <!--            </button>-->
        <!--            <a href="{{ route('mt5serverlist') }}" class="btn btn-lg btn-default">-->
        <!--                <i class="material-icons">&#xe5cd;</i> Cancel-->
        <!--            </a>-->
        <!--        </div>-->
        <!--    </div>-->

        <!--    {{ Form::close() }}-->
        <!--</div>-->
        
        <div class="box-body p-a-2">
    {{ Form::model($account, ['route' => ['mt5Update', $account->id], 'method' => 'PUT']) }}
    <div class="row">
        <div class="col-md-6 mb-3">
            <label>Company Title</label>
            {!! Form::text('company_title', $account->company_title, ['class' => 'form-control', 'required']) !!}
        </div>
        <div class="col-md-6 mb-3">
            <label>MT5 Company Name</label>
            {!! Form::text('mt5_company_name', $account->mt5_company_name, ['class' => 'form-control', 'required']) !!}
        </div>
        <div class="col-md-6 mb-3">
            <label>Server IP</label>
            {!! Form::text('mt5_server_ip', $account->mt5_server_ip, ['class' => 'form-control', 'required']) !!}
        </div>
        <div class="col-md-6 mb-3">
            <label>Server Port</label>
            {!! Form::number('mt5_server_port', $account->mt5_server_port, ['class' => 'form-control', 'required']) !!}
        </div>
        <div class="col-md-6 mb-3">
            <label>Web Login</label>
            {!! Form::text('mt5_server_web_login', $account->mt5_server_web_login, ['class' => 'form-control', 'required']) !!}
        </div>
        <!--<div class="col-md-6 mb-3">-->
        <!--    <label>Web Password</label>-->
        <!--    {!! Form::text('mt5_server_web_password', $account->mt5_server_web_password, ['class' => 'form-control', 'required']) !!}-->
        <!--</div>-->
        
        <div class="col-md-6 mb-3 position-relative">
            <label>Web Password</label>
            {!! Form::input('password', 'mt5_server_web_password', $account->mt5_server_web_password, [
                'class' => 'form-control',
                'id' => 'mt5Password',
                'required',
                'style' => 'padding-right:2.5rem;'
            ]) !!}
            <span onclick="togglePassword()" 
                style="position:absolute; top:75%; right:16px; transform:translateY(-50%); cursor:pointer;">
                <i id="passwordIcon" class="material-icons">visibility</i>
            </span>
        </div>
    
        <div class="col-md-6 mb-3">
            <label>Status</label>
            <select name="status" class="form-control" required>
                <option value="1" {{ $account->status == 1 ? 'selected' : '' }}>Active</option>
                <option value="0" {{ $account->status == 0 ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>
    </div>

    <div class="form-group" style="margin-top:1rem!important; display:flex; justify-content:end; gap:2px;">
        <button type="submit" class="btn btn-primary">Update MT5 Server</button>
        <a href="{{ route('mt5serverlist') }}" class="btn btn-secondary">Cancel</a>
    </div>
    {{ Form::close() }}
</div>

        
        
    </div>
</div>
@endsection

<script>
function togglePassword() {
    const passwordInput = document.getElementById('mt5Password');
    const icon = document.getElementById('passwordIcon');
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        icon.textContent = 'visibility_off';
    } else {
        passwordInput.type = 'password';
        icon.textContent = 'visibility';
    }
}
</script>
