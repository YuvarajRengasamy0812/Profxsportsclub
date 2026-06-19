@extends('dashboard.layouts.master')
@section('title', 'League - Add New')
@section('content')
<div class="padding">
    <div class="box">
        <div class="box-header dker">
            <h2><i class="material-icons">&#xe02e;</i> Add New League</h2>
            <small>
                <a href="{{ route('adminHome') }}">{{ __('backend.home') }}</a> /
                <a href="{{ route('leaguelist') }}">League list</a>
            </small>
        </div>
        
        <div class="box-body p-a-2">
            {{ Form::open(['route'=>['leaguesave'],'method'=>'POST', 'files' => true ]) }}
            
            {{-- General Information --}}
            <div class="row">
                <h6>General Information</h6>
                <hr />
                
                <div class="col-sm-12 col-md-3">
                    <div class="p-b-1">
                        <label class="form-label">Category</label>
                        <select name="categoryid" id="categoryid" class="form-control" required>
                            <option value="" selected disabled>Select Category</option>
                            @foreach($catgorylist as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->catname }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-sm-12 col-md-3">
                    <div class="p-b-1">
                        <label class="form-label">Sub Category</label>
                        <select name="subcategoryid" id="subcategoryid" class="form-control" required>
                            <option value="" selected disabled>Select Sub Category</option>
                        </select> 
                    </div>
                </div>

                <div class="col-sm-12 col-md-3 mb-3">
                    <div class="p-b-1">
                        <label class="form-label">Title</label>
                        <input type="text" class="form-control" name="leagurTitle" required />
                    </div>
                </div>

                <div class="col-sm-12 col-md-3 mb-3">
                    <div class="p-b-1">
                        <label class="form-label">Entry Fees</label>
                        <input type="number" class="form-control" name="leagurEntryfees" required />
                    </div>
                </div>

                <div class="col-sm-12 col-md-3 mb-3">
                    <div class="p-b-1">
                        <label class="form-label">Start Date</label>
                        <input type="date" class="form-control" name="leagurStartdate" required />
                    </div>
                </div>

                <div class="col-sm-12 col-md-3 mb-3">
                    <div class="p-b-1">
                        <label class="form-label">End Date</label>
                        <input type="date" class="form-control" name="leagurEnddate" required />
                    </div>
                </div>

                <div class="col-sm-12 col-md-3 mb-3">
                    <div class="p-b-1">
                        <label class="form-label">Total Participants</label>
                        <input type="number" class="form-control" name="leagurtotPartic" required />
                    </div>
                </div>

                <div class="col-sm-12 col-md-3 mb-3">
                    <div class="p-b-1">
                        <label class="form-label">Image</label>
                        <input type="file" class="form-control" name="leagurImage" required />
                    </div>
                </div>

                <div class="col-sm-12 col-md-4 mb-3">
                    <div class="p-b-1">
                        <label class="form-label">Description</label>
						<textarea ui-jp="summernote" placeholder="" dir="ltr" ui-options="{height: 300,callbacks: {
								onImageUpload: function(files, editor, welEditable) {
									sendFile(files[0], editor, welEditable,en);
								}
							}}" name="description" cols="50" rows="10" class="form-control summernote_en">
						</textarea>
                    </div>
                </div>

                <div class="col-sm-12 col-md-4 mb-3">
                    <div class="p-b-1">
                        <label class="form-label">Privacy Description</label>
						<textarea ui-jp="summernote" placeholder="" dir="ltr" ui-options="{height: 300,callbacks: {
								onImageUpload: function(files, editor, welEditable) {
									sendFile(files[0], editor, welEditable,en);
								}
							}}" name="privacydescription" cols="50" rows="10" class="form-control summernote_en">
						</textarea>
                    </div>
                </div>

                <div class="col-sm-12 col-md-4 mb-3">
                    <div class="p-b-1">
                        <label class="form-label">Rules Description</label>
						<textarea ui-jp="summernote" placeholder="" dir="ltr" ui-options="{height: 300,callbacks: {
								onImageUpload: function(files, editor, welEditable) {
									sendFile(files[0], editor, welEditable,en);
								}
							}}" name="rulesdescription" cols="50" rows="10" class="form-control summernote_en">
						</textarea>
                    </div>
                </div>
                
                <div class="col-sm-12 col-md-3 mb-3">
                    <div class="p-b-1">
                        <label class="form-label">League Status</label>
                        <select name="status" class="form-control" required>
                            <option value="1" selected>Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-12 col-md-3 mb-3">
                    <div class="p-b-1">
                        <label class="form-label">League Leaderboard</label>
                        <select name="leaderboard_option" class="form-control" required >
                            <option value="automatic" selected>Auto Update</option>
                            <option value="manual">Manual Update</option>
                        </select>
                    </div>
                </div>
             <div class="col-sm-12 col-md-3 mb-3">
                <div class="p-b-1">
                    <label class="form-label">League Certificate (PDF only)</label>
                    <input type="file" name="league_certificate" class="form-control" accept="application/pdf" required>
                    <small class="text-muted">Upload PDF file only</small>
                </div>
            </div>
            </div>

            <hr/>
           
            {{-- MT5 Server Details --}}
            <div class="row">
                <h6>MT5 Server Details</h6>
                <hr />
                <div class="col-sm-12 col-md-3 mb-3">
                    <div class="p-b-1">
                        <label class="form-label">Choose Server</label>
                        <select name="mt5_server_id" id="mt5_server_id" class="form-control" required>
                            <option value="" selected disabled>Select MT5 Server</option>
                            @foreach($mt5server as $server)
                                <option value="{{ $server->id }}"
                                    data-title="{{ $server->company_title }}"
                                    data-ip="{{ $server->mt5_server_ip }}"
                                    data-port="{{ $server->mt5_server_port }}"
                                    data-web-login="{{ $server->mt5_server_web_login }}"
                                    data-web-pass="{{ $server->mt5_server_web_password }}"
                                    data-company="{{ $server->mt5_company_name }}">
                                    {{ $server->company_title ?? $server->mt5_company_name }}
                                </option>
                            @endforeach
                            <!--<option value="new">Other / New</option>-->
                        </select>
                    </div>
                </div>

                <div class="col-sm-12 col-md-4 mb-3">
                    <div class="p-b-1">
                        <label class="form-label">Company Title</label>
                        <input type="text" class="form-control" name="company_title" id="company_title" readonly />
                    </div>
                </div>

                <div class="col-sm-12 col-md-4 mb-3">
                    <div class="p-b-1">
                        <label class="form-label">MT5 Company Name</label>
                        <input type="text" class="form-control" name="mt5_company_name" id="mt5_company_name" readonly />
                    </div>
                </div>

                <div class="col-sm-12 col-md-4 mb-3">
                    <div class="p-b-1">
                        <label class="form-label">MT5 Server IP</label>
                        <input type="text" class="form-control" name="mt5_server_ip" id="mt5_server_ip" readonly />
                    </div>
                </div>

                <div class="col-sm-12 col-md-4 mb-3">
                    <div class="p-b-1">
                        <label class="form-label">MT5 Server Port</label>
                        <input type="text" class="form-control" name="mt5_server_port" id="mt5_server_port" readonly />
                    </div>
                </div>

                <div class="col-sm-12 col-md-4 mb-3">
                    <div class="p-b-1">
                        <label class="form-label">MT5 Server Web Login</label>
                        <input type="text" class="form-control" name="mt5_server_web_login" id="mt5_server_web_login" readonly />
                    </div>
                </div>

                <div class="col-sm-12 col-md-4 mb-3">
                    <div class="p-b-1">
                        <label class="form-label">MT5 Server Web Password</label>
                        <input type="text" class="form-control" name="mt5_server_web_password" id="mt5_server_web_password" readonly />
                    </div>
                </div>
            </div>

            <hr/>
             {{-- MT5 Groups --}}
            <div class="row">
                <h6>MT5 Groups</h6>
                <hr />
                <div class="col-sm-12 col-md-3">
                    <div class="p-b-1">
                        <label class="form-label">MT5 Group Details</label>
                        <select name="Mt5groupid" id="Mt5groupid" class="form-control" required>
                            <option value="0" selected>testgroup</option>                                
                        </select>  
                    </div>
                </div>
            </div>
            
            {{-- Submit Button --}}
            <hr/>
            <div class="form-group row m-t-md">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-lg btn-primary m-t">
                        <i class="material-icons">&#xe31b;</i> {!! __('backend.add') !!}
                    </button>
                    <a href="{{route('leaguelist')}}" class="btn btn-lg btn-default m-t">
                        <i class="material-icons">&#xe5cd;</i> {!! __('backend.cancel') !!}
                    </a>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
@endsection

@push('after-scripts')
<style>
	.note-editor {border: 1px solid #00000032 !important; }
</style>
<script>
document.getElementById('categoryid').addEventListener('change', function() {
    const categoryId = this.value;
    const subcatSelect = document.getElementById('subcategoryid');
    subcatSelect.innerHTML = '<option value="" selected disabled>Loading...</option>';

    fetch("{{ route('getSubcat') }}", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json'
        },
        body: JSON.stringify({ catid: categoryId })
    })
    .then(response => response.json())
    .then(data => {
        subcatSelect.innerHTML = '<option value="" selected disabled>Select Sub Category</option>';
        data.forEach(subcat => {
            const option = document.createElement('option');
            option.value = subcat.id;
            option.textContent = subcat.catname;
            subcatSelect.appendChild(option);
        });
    })
    .catch(error => {
        subcatSelect.innerHTML = '<option value="" selected disabled>Error loading subcategories</option>';
        console.error('Error fetching subcategories:', error);
    });
});

document.getElementById('mt5_server_id').addEventListener('change', function() {
    const selected = this.options[this.selectedIndex];
    const fields = [
        'company_title',
        'mt5_company_name',
        'mt5_server_ip',
        'mt5_server_port',
        'mt5_server_web_login',
        'mt5_server_web_password'
    ];

    // Fill server fields
    document.getElementById('company_title').value = selected.dataset.title || '';
    document.getElementById('mt5_company_name').value = selected.dataset.company || '';
    document.getElementById('mt5_server_ip').value = selected.dataset.ip || '';
    document.getElementById('mt5_server_port').value = selected.dataset.port || '';
    document.getElementById('mt5_server_web_login').value = selected.dataset.webLogin || '';
    document.getElementById('mt5_server_web_password').value = selected.dataset.webPass || '';

    fields.forEach(id => document.getElementById(id).readOnly = true);

    // Load MT5 groups for this server
   const groupSelect = document.getElementById('Mt5groupid');
    groupSelect.innerHTML = '<option value=""  >Loading groups...</option>';

    fetch("{{ route('getMt5Groups') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ server_id: this.value })
    })
    .then(res => res.json())
    .then(data => {
        groupSelect.innerHTML = '<option value="" selected disabled>Select MT5 Group</option>';
        if(data.length > 0){
            data.forEach(group => {
                const option = document.createElement('option');
                 option.value = group.ac_index; // <-- this must be the primary key of your MT5 group
                 option.textContent = group.ac_group; // <-- the column you want to display
                groupSelect.appendChild(option);
            });
        } else {
            groupSelect.innerHTML = '<option value="" disabled>No groups found</option>';
        }
    })
    .catch(err => {
        groupSelect.innerHTML = '<option value="" disabled>Error loading groups</option>';
        console.error(err);
    });
});
</script>
@endpush
