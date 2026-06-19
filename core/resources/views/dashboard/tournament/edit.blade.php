@extends('dashboard.layouts.master')
@section('title', 'League - Edit')
@section('content')
<div class="padding">
    <div class="box">
        <div class="box-header dker">
            <h2><i class="material-icons">&#xe02e;</i> Edit League</h2>
            <small>
                <a href="{{ route('adminHome') }}">{{ __('backend.home') }}</a> /
                <a href="{{ route('leaguelist') }}">League List</a>
            </small>
        </div>

        <div class="box-body p-a-2">
            {{ Form::model($league, ['route'=>['leagueupdate', $league->id],'method'=>'POST', 'files'=>true]) }}

            {{-- General Information --}}
            <div class="row">
                <h6>General Information</h6>
                <hr />

                <div class="col-sm-12 col-md-3">
                    <label class="form-label">Category</label>
                    <select name="categoryid" id="categoryid" class="form-control" required>
                        <option value="" disabled>Select Category</option>
                        @foreach($catgorylist as $cat)
                            <option value="{{ $cat->id }}" {{ $league->categoryid == $cat->id ? 'selected' : '' }}>
                                {{ $cat->catname }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-sm-12 col-md-3">
                    <label class="form-label">Sub Category</label>
                    <select name="subcategoryid" id="subcategoryid" class="form-control" required>
                        <option value="" disabled>Select Sub Category</option>
                        @foreach($subcategorylist as $subcat)
                            <option value="{{ $subcat->id }}" {{ $league->subcategoryid == $subcat->id ? 'selected' : '' }}>
                                {{ $subcat->catname }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-sm-12 col-md-3">
                    <label class="form-label">Title</label>
                    <input type="text" class="form-control" name="leagurTitle" value="{{ $league->leagurTitle }}" required />
                </div>

                <div class="col-sm-12 col-md-3">
                    <label class="form-label">Entry Fees</label>
                    <input type="number" class="form-control" name="leagurEntryfees" value="{{ $league->leagurEntryfees }}" required />
                </div>

                <div class="col-sm-12 col-md-3">
                    <label class="form-label">Start Date</label>
                    <input type="date" class="form-control" name="leagurStartdate" 
       value="{{ \Carbon\Carbon::parse($league->leagurStartdate)->format('Y-m-d') }}" required />
                </div>

                <div class="col-sm-12 col-md-3">
                    <label class="form-label">End Date</label>
                  <input type="date" class="form-control" name="leagurEnddate" 
       value="{{ \Carbon\Carbon::parse($league->leagurEnddate)->format('Y-m-d') }}" required />
                </div>

                <div class="col-sm-12 col-md-3">
                    <label class="form-label">Total Participants</label>
                    <input type="number" class="form-control" name="leagurtotPartic" value="{{ $league->leagurtotPartic }}" required />
                </div>

                <div class="col-sm-12 col-md-3">
                    <label class="form-label">Image</label>
                    <input type="file" class="form-control" name="leagurImage" />
                    @if($league->leagurImage)
                        <img src="{{ asset($league->leagurImage) }}" width="60" class="mt-1"/>
                    @endif
                </div>

                <div class="col-sm-12 col-md-4 mb-3">
                    <label class="form-label">Description</label>
                    	<textarea ui-jp="summernote" placeholder="" dir="ltr" ui-options="{height: 300,callbacks: {
								onImageUpload: function(files, editor, welEditable) {
									sendFile(files[0], editor, welEditable,en);
								}
							}}" name="description" cols="50" rows="10" class="form-control summernote_en">{{ $league->description }}</textarea>
                </div>

                <div class="col-sm-12 col-md-4 mb-3">
                    <label class="form-label">Privacy Description</label>
                    	<textarea ui-jp="summernote" placeholder="" dir="ltr" ui-options="{height: 300,callbacks: {
								onImageUpload: function(files, editor, welEditable) {
									sendFile(files[0], editor, welEditable,en);
								}
							}}" name="privacydescription" cols="50" rows="10" class="form-control summernote_en">{{ $league->privacydescription }}</textarea>
                </div>

                <div class="col-sm-12 col-md-4 mb-3">
                    <label class="form-label">Rules Description</label>
                    <textarea ui-jp="summernote" placeholder="" dir="ltr" ui-options="{height: 300,callbacks: {
								onImageUpload: function(files, editor, welEditable) {
									sendFile(files[0], editor, welEditable,en);
								}
							}}" name="rulesdescription" cols="50" rows="10" class="form-control summernote_en">{{ $league->rulesdescription }}</textarea>
                </div>

                <div class="col-sm-12 col-md-3 mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-control" required>
                        <option value="1" {{ $league->status == 1 ? 'selected' : '' }} >Active </option>
                        <option value="0" {{ $league->status == 0 ? 'selected' : '' }} >Inactive </option>
                    </select>
                </div>
                
                <div class="col-sm-12 col-md-3 mb-3">
                    <div class="p-b-1">
                        <label class="form-label">League Leaderboard</label>
                        <select name="leaderboard_option" class="form-control" required >
                            <option value="automatic" {{ $league->leaderboard_option == 'automatic' ? 'selected' : '' }} >Auto Update</option>
                            <option value="manual" {{ $league->leaderboard_option == 'manual' ? 'selected' : '' }} >Manual Update</option>
                        </select>
                    </div>
                </div>
                
                <div class="col-sm-12 col-md-3 mb-3">
                <!--<div class="p-b-1">-->
                <!--    <label class="form-label">League Certificate</label>-->
                <!--    <input type="file" name="league_certificate" class="form-control" accept="image/*">-->
                <!--    <small class="text-muted">Upload image (jpg, png, jpeg only)</small>-->
            
                <!--    @if(!empty($league->league_certificate))-->
                <!--        <div class="mt-2">-->
                <!--            <img src="{{ asset($league->league_certificate) }}" alt="League Certificate" class="img-thumbnail" width="120">-->
                <!--        </div>-->
                <!--    @endif-->
                <!--</div>-->
                <div class="p-b-1">
                <label class="form-label">League Certificate (PDF only)</label>
                <input type="file" name="league_certificate" class="form-control" accept="application/pdf">
                <small class="text-muted">Upload PDF file only</small>
            
                @if(!empty($league->league_certificate))
                    <div class="mt-2">
                        <a href="{{ asset($league->league_certificate) }}" target="_blank" class="btn btn-sm btn-primary">
                            View Uploaded Certificate
                        </a>
                    </div>
                @endif
            </div>
            </div>
            </div>

            <hr/>
            
            {{-- MT5 Server Details --}}
            <div class="row" >
                <h6>MT5 Server Details</h6>
                <hr />
                <div class="col-sm-12 col-md-12" >
                    <label class="form-label">Choose Server</label>
                    <select name="mt5_server_id" id="mt5_server_id" class="form-control" style="max-width:300px;" required>
                        <option value="" disabled>Select MT5 Server</option>
                        @foreach($mt5server as $server)
                            <option value="{{ $server->id }}"
                                data-title="{{ $server->company_title }}"
                                data-ip="{{ $server->mt5_server_ip }}"
                                data-port="{{ $server->mt5_server_port }}"
                                data-web-login="{{ $server->mt5_server_web_login }}"
                                data-web-pass="{{ $server->mt5_server_web_password }}"
                                data-company="{{ $server->mt5_company_name }}"
                                {{ $league->mt5_server_id == $server->id ? 'selected' : '' }}>
                                {{ $server->company_title ?? $server->mt5_company_name }}
                            </option>
                        @endforeach
                        <!--<option value="new">Other / New</option>-->
                    </select>
                </div>

                <div class="col-sm-12 col-md-4">
                    <label class="form-label">Company Title</label>
                    <input type="text" class="form-control" name="company_title" id="company_title" value="{{ $league->company_title }}" />
                </div>

                <div class="col-sm-12 col-md-4">
                    <label class="form-label">MT5 Company Name</label>
                    <input type="text" class="form-control" name="mt5_company_name" id="mt5_company_name" value="{{ $league->mt5_company_name }}" />
                </div>

                <div class="col-sm-12 col-md-4">
                    <label class="form-label">MT5 Server IP</label>
                    <input type="text" class="form-control" name="mt5_server_ip" id="mt5_server_ip" value="{{ $league->mt5_server_ip }}" />
                </div>

                <div class="col-sm-12 col-md-4">
                    <label class="form-label">MT5 Server Port</label>
                    <input type="text" class="form-control" name="mt5_server_port" id="mt5_server_port" value="{{ $league->mt5_server_port }}" />
                </div>

                <div class="col-sm-12 col-md-4">
                    <label class="form-label">MT5 Server Web Login</label>
                    <input type="text" class="form-control" name="mt5_server_web_login" id="mt5_server_web_login" value="{{ $league->mt5_server_web_login }}" />
                </div>

                <div class="col-sm-12 col-md-4">
                    <label class="form-label">MT5 Server Web Password</label>
                    <input type="text" class="form-control" name="mt5_server_web_password" id="mt5_server_web_password" value="{{ $league->mt5_server_web_password }}" />
                </div>
            </div>

            <hr/>
            <div class="row">
                <h6>MT5 Groups</h6>
                <hr />
              <div class="col-sm-12 col-md-6">
                <label class="form-label">MT5 Group</label>
                <select name="Mt5groupid" id="Mt5groupid" class="form-control" required>
                    <option value="" disabled>Select MT5 Group</option>
                    @if(isset($mt5groups) && count($mt5groups) > 0)
                        @foreach($mt5groups as $group)
                            <option value="{{ $group->ac_index }}" {{ $league->Mt5groupid == $group->ac_index ? 'selected' : '' }}>
                                {{ $group->ac_group }}
                            </option>
                        @endforeach
                    @endif
                </select>
            </div>
            </div>
            <hr/>
            <div class="form-group row m-t-md">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-lg btn-primary m-t">
                        <i class="material-icons">&#xe31b;</i> {!! __('backend.update') !!}
                    </button>
                    <a href="{{ route('leaguelist') }}" class="btn btn-lg btn-default m-t">
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
    subcatSelect.innerHTML = '<option selected disabled>Loading...</option>';

    fetch("{{ route('getSubcat') }}", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
        body: JSON.stringify({ catid: categoryId })
    })
    .then(response => response.json())
    .then(data => {
        subcatSelect.innerHTML = '<option selected disabled>Select Sub Category</option>';
        data.forEach(subcat => {
            const option = document.createElement('option');
            option.value = subcat.id;
            option.textContent = subcat.catname;
            subcatSelect.appendChild(option);
        });
    });
});

function updateMT5Fields() {
    const mt5Select = document.getElementById('mt5_server_id');
    const selected = mt5Select.options[mt5Select.selectedIndex];
    const fields = ['company_title','mt5_company_name','mt5_server_ip','mt5_server_port','mt5_server_web_login','mt5_server_web_password'];
    const groupSelect = document.getElementById('Mt5groupid');

    if(mt5Select.value === 'new') {
        fields.forEach(id => {
            document.getElementById(id).readOnly = false;
            document.getElementById(id).value = '';
        });
        groupSelect.innerHTML = '<option value="" selected disabled>Select MT5 Group</option>';
    } else {
        // Fill MT5 server fields
        document.getElementById('company_title').value = selected.dataset.title || '';
        document.getElementById('mt5_company_name').value = selected.dataset.company || '';
        document.getElementById('mt5_server_ip').value = selected.dataset.ip || '';
        document.getElementById('mt5_server_port').value = selected.dataset.port || '';
        document.getElementById('mt5_server_web_login').value = selected.dataset.webLogin || '';
        document.getElementById('mt5_server_web_password').value = selected.dataset.webPass || '';
        fields.forEach(id => document.getElementById(id).readOnly = true);

        // Fetch MT5 groups for this server
        fetch("{{ route('getMt5Groups') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ server_id: mt5Select.value })
        })
        .then(res => res.json())
        .then(data => {
            groupSelect.innerHTML = '<option value="" selected disabled>Select MT5 Group</option>';
            if(data.length > 0){
                data.forEach(group => {
                    const option = document.createElement('option');
                    option.value = group.ac_index;
                    option.textContent = group.ac_group;
                    if(group.ac_index == "{{ $league->Mt5groupid }}") option.selected = true; // pre-select current group
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
    }
}

document.getElementById('mt5_server_id').addEventListener('change', updateMT5Fields);

// Auto-fill MT5 fields and groups on page load
window.addEventListener('DOMContentLoaded', () => {
    updateMT5Fields();
});
</script>
@endpush
