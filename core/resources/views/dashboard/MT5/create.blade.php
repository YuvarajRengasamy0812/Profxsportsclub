@extends('dashboard.layouts.master')
@section('title', 'Add MT5 Server')
@section('content')
<div class="padding">
    <div class="box">
        <div class="box-header dker">
            <h2><i class="material-icons">&#xe02e;</i> Add New MT5 Server</h2>
            <small>
                <a href="{{ route('adminHome') }}">Home</a> /
                <a href="{{ route('mt5serverlist') }}">MT5 Server</a>
            </small>
        </div>

        <div class="box-body p-a-2">
            <form action="{{ route('mt5accounts.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Company Title</label>
                        <input type="text" name="company_title" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>MT5 Company Name</label>
                        <input type="text" name="mt5_company_name" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Server IP</label>
                        <input type="text" name="mt5_server_ip" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Server Port</label>
                        <input type="number" name="mt5_server_port" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Web Login</label>
                        <input type="text" name="mt5_server_web_login" class="form-control" required>
                    </div>
                     <div class="col-md-6 mb-3">
                        <label>Web Password</label>
                        <input type="password" name="mt5_server_web_password" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Status</label>
                        <select name="status" class="form-control" required>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div>

                <div class="form-group" style="margin-top:1rem!important; display:flex; justify-content:end; gap:2px;">
                    <button type="submit" class="btn btn-primary">Add MT5 Server</button>
                    <a href="{{ route('mt5serverlist') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
