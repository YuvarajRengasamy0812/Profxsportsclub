@extends('dashboard.layouts.master')
@section('title', __('backend.generalSettings'))
@section('content')
    <style>
        /* ===== Styles ===== */
        .card-style {
            background: #fff;
            border-radius: 10px;
            padding: 15px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
            margin-bottom: 20px;
            transition: all 0.2s;
        }

        .card-style:hover {
            transform: translateY(-2px);
        }

        .card-head {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .card-head h6 {
            margin: 0;
            font-size: 1rem;
        }

        .btn-dstyle {
            padding: 5px 12px;
            font-size: 0.85rem;
            border: 1px solid #333;
            border-radius: 5px;
            background: #fff;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-dstyle:hover {
            background: #f0f0f0;
        }

        .card-body-all {
            border: 1px solid #ddd;
            padding: 8px 12px;
            border-radius: 6px;
            margin-bottom: 8px;
        }

        .card-body-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            
        }

        .card-body-item-left {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .card-body-item-right {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .badge {
            background: #4caf50;
            color: #fff;
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 0.75rem;
        }

        .switch {
            position: relative;
            display: inline-block;
            width: 40px;
            height: 20px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: #ccc;
            transition: .2s;
            border-radius: 20px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 16px;
            width: 16px;
            left: 2px;
            bottom: 2px;
            background: white;
            transition: .2s;
            border-radius: 50%;
        }

        .switch input:checked+.slider {
            background: #4caf50;
        }

        .switch input:checked+.slider:before {
            transform: translateX(20px);
        }

        .show-all-btn {
            padding: 5px 12px;
            font-size: 0.85rem;
            border: 1px solid #333;
            border-radius: 5px;
            background: #fff;
            cursor: pointer;
            margin-top: 10px;
        }

        .show-all-btn:hover {
            background: #f0f0f0;
        }
    </style>

    <div class="padding">
        <div class="box">
            <div class="box-header dker">
                <h3><i class="material-icons">&#xe02e;</i> MT5 Group Details</h3>
                <small><a href="{{ route('adminHome') }}">{{ __('backend.home') }}</a></small>
            </div>
            {{-- ===== MT5 Server List Dropdown ===== --}}
            <div class="card-style" style="margin: 15px;">
                <div class="form-group">
                    <label for="mt5_server_id"><strong>MT5 Server</strong></label>
                    <select class="form-control" id="mt5_server_id" name="mt5_server_id" required
                        onchange="onServerChange(this.value)">
                        <option value="">-- Select MT5 Server --</option>
                        @foreach ($mt5Servers ?? [] as $server)
                            <option value="{{ $server->id }}">{{ $server->mt5_company_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="card-main">
                <div class="row" style="padding: 20px">
                    {{-- Left Column --}}
                    <div class="col-md-4">

                        {{-- Group Mains --}}
                        <div class="card-style">
                            <div class="card-head">
                                <h6>Group Mains</h6>
                                <button type="button" class="btn-dstyle" onclick="openGroupMainModal()">+ Add Main
                                    Group</button>
                            </div>
                            <hr>
                            @foreach ($groupMains ?? [] as $main)
                                <div class="card-body-all">

                                    <p class="text-center">
                                        <strong>{{ $main->server->mt5_company_name ?? 'No Server Found' }}</strong></p>
                                    <div class="card-body-item">
                                        <div class="card-body-item-left">
                                            <label class="switch">
                                                <input type="checkbox" {{ $main->is_active ? 'checked' : '' }}>
                                                <span class="slider round"></span>
                                            </label>
                                            <span style="min-width: 85px!important">{{ $main->mt5_group_name }}</span>

                                        </div>
                                        <div class="card-body-item-right">
                                            <span class="badge">{{ $main->mt5_group_type }}</span>
                                            <button class="btn btn-sm btn-warning"
                                                onclick="editGroupMain('{{ md5($main->mt5_group_id) }}')">Edit</button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <hr>
                            <div style="text-align:right"><button class="show-all-btn">show all</button></div>
                        </div>

                        {{-- Group Categories --}}
                        <div class="card-style">
                            <div class="card-head">
                                <h6>Group Categories</h6>
                                <button type="button" class="btn-dstyle" onclick="openGroupCategoryModal()">+ Add
                                    Category</button>
                            </div>
                            <hr>
                            @foreach ($groupCategories ?? [] as $cat)
                            <div class="card-body-all" >
                                
                            <p class="text-center"><strong>{{  $cat->server->mt5_company_name ?? 'No Server Found'  }}</strong></p>
                                <div class="card-body-item">
                                    <div class="card-body-item-left">
                                        <label class="switch">
                                            <input type="checkbox" {{ $cat->is_active ? 'checked' : '' }}>
                                            <span class="slider round"></span>
                                        </label>
                                        <span style="min-width: 85px!important">{{ $cat->mt5_grp_cat_name }}</span>
                                        
                                    </div>
                                    <div class="card-body-item-right">
                                        <span class="badge">{{ $cat->mt5_grp_cat_type }}</span>
                                        <button class="btn btn-sm btn-warning"
                                            onclick="editGroupCategory('{{ md5($cat->mt5_grp_cat_id) }}')">Edit</button>
                                    </div>
                                </div>

                          </div>                                
                            @endforeach
                            <hr>
                            <div style="text-align:right"><button class="show-all-btn">show all</button></div>
                        </div>

                        {{-- Group Types --}}
                        <div class="card-style">
                            <div class="card-head">
                                <h6>Group Types</h6>
                                <button type="button" class="btn-dstyle" onclick="openGroupTypeModal()">+ Add Group
                                    Type</button>
                            </div>
                            <hr>
                            @foreach ($groupTypes ?? [] as $type)
                             <div class="card-body-all" >
                                
                            <p class="text-center"><strong>{{ $type->server->mt5_company_name ?? 'No Server Found'  }}</strong></p>
                                <div class="card-body-item">
                                    <div class="card-body-item-left">
                                        <label class="switch">
                                            <input type="checkbox" {{ $type->is_active ? 'checked' : '' }}>
                                            <span class="slider round"></span>
                                        </label>
                                        <span style="min-width: 85px!important">{{ $type->mt5_grp_cat_name }}</span>
                                       
                                    </div>
                                    <div class="card-body-item-right">
                                        <span class="badge">{{ $type->is_active ? 'Active' : 'Inactive' }}</span>
                                        {{-- <span class="material-icons" onclick="editGroupType('{{ md5($type->mt5_grp_type_id) }}')">edit</span> --}}
                                        <button class="btn btn-sm btn-warning"
                                            onclick="editGroupType('{{ $type->mt5_grp_cat_id }}')">Edit</button>
                                    </div>
                                </div>
                                </div>
                                <hr>
                            @endforeach
                            <div style="text-align:right"><button class="show-all-btn">show all</button></div>
                        </div>
                    </div>

                    {{-- Right Column --}}
                    <div class="col-md-8">
                        <div class="card card-style">
                            <div class="card-head">
                                <h6 class="mb-0">Groups</h6>
                                <button type="button" class="btn-dstyle" onclick="GroupModaladd()">+ Add New Group</button>
                                {{-- <button type="button" class="btn-dstyle" data-toggle="modal" data-target="#groupCreationModal">Add New Group</button> --}}
                            </div>
                            <hr>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered vertical-middle">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>DP Name</th>
                                                <th>Server Name</th>
                                                <th>Order Pri.</th>
                                                <th>Group</th>
                                                <th>Min.Deposit</th>
                                                <th>Spread</th>
                                                <th>Status</th>
                                                <th>Client Shown</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                      <tbody>
                                            @foreach ($AddGroup ?? [] as $grp)
                                                <tr>
                                                    <td>{{ $grp->ac_name }}</td>
                                                    <td>{{ $grp->server->mt5_company_name }}</td>
                                                    <td>{{ $grp->display_priority }}</td>
                                                    <td>{{ $grp->ac_group }}</td>
                                                    <td>{{ $grp->ac_min_deposit }}</td>
                                                    <td>{{ $grp->ac_spread }}</td>

                                                    <td>
                                                        <span class="badge {{ $grp->status ? 'badge-success' : 'badge-danger' }}">
                                                            {{ $grp->status ? 'Active' : 'Inactive' }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-info">
                                                            {{ $grp->is_client_group ? 'Shown' : 'Hidden' }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <button type="button"
                                                                class="btn btn-sm btn-warning"
                                                                onclick='openEditModal(@json($grp))'>
                                                            Edit
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- ===== Modals ===== --}}

    {{-- Group Main Modal --}}
    <div class="modal fade" id="groupMainModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form method="POST" action="{{ route('mt5groupadd') }}" id="groupMainForm">
                    @csrf
                    <input type="hidden" name="groupMain_id" id="groupMain_id">
                    <input type="hidden" name="mt5_server_id" id="groupMain_server_id">
                    <div class="modal-header">
                        <h5 class="modal-title" id="groupMainModalLabel">Add Group Main</h5>

                    </div>

                    <div class="modal-body">
                        <div class="form-group">
                            <label for="mt5_group_name">Group Name</label>
                            <input type="text" class="form-control" name="mt5_group_name" id="mt5_group_name"
                                required>
                        </div>

                        <div class="form-group">
                            <label for="mt5_group_desc">Description</label>
                            <textarea class="form-control" name="mt5_group_desc" id="mt5_group_desc"></textarea>
                        </div>
                        
                        <div class="form-group">
                            <label for="mt5_group_type">Group Type</label>
                            <select class="form-control" name="mt5_group_type" id="mt5_group_type" required>
								<option value="contest">Contest</option>
                                <option value="demo">Demo</option>
                                <option value="live">Live</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="is_active_main">Status</label>
                            <select class="form-control" name="is_active" id="is_active_main">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="mt5_server_id"><strong>MT5 Server</strong></label>
                            <select class="form-control" id="mt5_server_id" name="mt5_server_id" required>
                                <option value="">-- Select MT5 Server --</option>
                                @foreach ($mt5Servers ?? [] as $server)
                                    <option value="{{ $server->id }}">{{ $server->mt5_company_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Group Category Modal --}}
    <div class="modal fade" id="groupCategoryModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form method="POST" action="{{ route('mt5groupadd') }}" id="groupCategoryForm">
                    @csrf
                    <input type="hidden" name="groupCategory_id" id="groupCategory_id">
                    <input type="hidden" name="mt5_server_id" id="groupCategory_server_id">
                    <div class="modal-header">
                        <h5 class="modal-title" id="groupCategoryModalLabel">Add Group Category</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <div class="modal-body">
                        <div class="form-group">
                            <label for="mt5_grp_cat_name">Category Name</label>
                            <input type="text" class="form-control" name="mt5_grp_cat_name" id="mt5_grp_cat_name"
                                required>
                        </div>

                        <div class="form-group">
                            <label for="mt5_grp_cat_desc">Description</label>
                            <textarea class="form-control" name="mt5_grp_cat_desc" id="mt5_grp_cat_desc"></textarea>
                        </div>

                        <div class="form-group">
                            <label>Category</label>
                            <select class="form-control" name="mt5_grp_cat_type" id="mt5_grp_cat_type">
                                <option value="type" selected>Category</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control" name="is_active" id="is_active">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="mt5_server_id"><strong>MT5 Server</strong></label>
                            <select class="form-control" id="mt5_server_id" name="mt5_server_id" required>
                                <option value="">-- Select MT5 Server --</option>
                                @foreach ($mt5Servers ?? [] as $server)
                                    <option value="{{ $server->id }}">{{ $server->mt5_company_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Group Type Modal --}}
    <div class="modal fade" id="groupTypeModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form method="POST" action="{{ route('mt5groupadd') }}" id="groupTypeForm">
                    @csrf
                    <input type="hidden" name="mt5_grp_type_id" id="mt5_grp_type_id">
                    <input type="hidden" name="mt5_server_id" id="groupType_server_id">
                    <div class="modal-header">
                        <h5 class="modal-title" id="groupTypeModalLabel">Add Group Type</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <div class="modal-body">
                        <div class="form-group">
                            <label>Name Of Category / Type</label>
                            <input type="text" class="form-control" name="group_type_name" id="group_type_name"
                                required>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" name="group_type_desc" id="group_type_desc"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="group_type_category">Category Type</label>
                            <select class="form-control" name="group_type_category" id="group_type_category" required>
                                <option value="book" selected>Type</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control" name="is_active" id="is_active">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="mt5_server_id1"><strong>MT5 Server</strong></label>
                            <select class="form-control" id="mt5_server_id" name="mt5_server_id" required>
                                <option value="">-- Select MT5 Server --</option>
                                @foreach ($mt5Servers ?? [] as $server)
                                    <option value="{{ $server->id }}">{{ $server->mt5_company_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Group Creation Modal -->
    <div class="modal fade" id="groupMgmt" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="groupMgmtLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('mt5Groupcreate') }}" id="groupMgmtCreation" method="POST"
                    enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    <input type="hidden" name="ac_index" id="ac_index" value="">
                    <input type="hidden" name="groupCreation" value="true">
                    <input type="hidden" name="mt5_server_id" id="groupMgmt_server_id">
                    <div class="modal-header">
                        <h5 class="modal-title" id="groupMgmtLabel">Group Creation Form</h5>
                        {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                    </div>
                    <div class="modal-body custom-card card mb-0">
                        <div class="row">
                            <!-- Group Type -->
                            <div class="form-group col-lg-3 mb-3">
                                <label for="ac_type" class="form-label">Group Type</label>
                                <select class="form-control" id="ac_type" name="ac_type" required>
                                    <option value="" selected disabled>Select Group Type</option>
                                    @foreach ($groupMains as $gp)
                                        <option value="{{ $gp->mt5_group_id }}" data-gname="{{ $gp->mt5_group_name }}"
                                            data-type="{{ $gp->mt5_group_type }}">
                                            {{ $gp->mt5_group_name }} - {{ ucfirst($gp->mt5_group_type) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Display Name -->
                            <div class="form-group col-lg-3 mb-3">
                                <label for="ac_name" class="form-label">Display Name</label>
                                <input type="text" class="form-control" name="ac_name" id="ac_name" required>
                            </div>

                            <!-- Group Category -->
                            <div class="form-group col-lg-3 mb-3">
                                <label for="ac_category" class="form-label">Group Category</label>
                                <select class="form-control" id="ac_category" name="ac_category" required>
                                    <option value="" selected disabled>Select Category</option>
                                    @foreach ($groupCategories as $res)
                                        <option value="{{ $res->mt5_grp_cat_id }}"
                                            {{ $res->is_active == 0 ? 'disabled' : '' }}>
                                            {{ $res->mt5_grp_cat_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Group Book Type -->
                            <div class="form-group col-lg-3 mb-3">
                                <label for="ac_book_type" class="form-label">Group Book Type</label>
                                <select class="form-control" id="ac_book_type" name="ac_book_type" required>
                                    <option value="" selected disabled>Select Book Type</option>
                                    @foreach ($groupTypes as $res)
                                        <option value="{{ $res->mt5_grp_cat_id }}"
                                            {{ $res->is_active == 0 ? 'disabled' : '' }}>
                                            {{ $res->mt5_grp_cat_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Auto-generated Group Name -->
                            <div class="form-group col-lg-6 mb-3">
                                <label for="ac_group" class="form-label">Group Name</label>
                                <input type="text" class="form-control" name="ac_group" id="ac_group" readonly
                                    required>
                            </div>

                            <!-- Minimum Deposit -->
                            <div class="form-group col-lg-3 mb-3">
                                <label for="ac_min_deposit" class="form-label">Minimum Deposit</label>
                                <input type="number" class="form-control" id="ac_min_deposit" name="ac_min_deposit"
                                    required>
                            </div>

                            <!-- Leverages -->
                            <div class="form-group col-lg-3 mb-3">
                                <label for="ac_max_leverage" class="form-label">Leverages(,)</label>
                                <input type="text" class="form-control" id="ac_max_leverage" name="ac_max_leverage"
                                    required>
                            </div>

                            <!-- Spread -->
                            <div class="form-group col-lg-4 mb-3">
                                <label for="ac_spread" class="form-label">Spread</label>
                                <input type="number" class="form-control" id="ac_spread" name="ac_spread"
                                    step="0.1" required>
                            </div>

                            <!-- Swap -->
                            <div class="form-group col-lg-4 mb-3">
                                <label for="ac_swap" class="form-label">Swap</label>
                                <select class="form-control" id="ac_swap" name="ac_swap" required>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                            </div>

                            <!-- Client Group -->
                            <div class="form-group col-lg-4 mb-3">
                                <label for="is_client_group" class="form-label">Client Group</label>
                                <select class="form-control" id="is_client_group" name="is_client_group" required>
                                    <option value="1">Shown</option>
                                    <option value="0">Hidden</option>
                                </select>
                            </div>

                            <!-- Inquiry Status -->
                            <div class="form-group col-lg-6 mb-3">
                                <label for="inquiry_status" class="form-label">Inquiry Status</label>
                                <select class="form-control" id="inquiry_status" name="inquiry_status" required>
                                    <option value="0">Account Creation</option>
                                    <option value="1">Enquiry</option>
                                    <option value="2">Tournament</option>
                                </select>
                            </div>

                            <!-- Status -->
                            <div class="form-group col-lg-6 mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-control" id="status" name="status" required>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>

                            <!-- IB Enabled -->
                            <div class="form-group col-lg-6 mb-3">
                                <label for="ib_enabled" class="form-label">IB Enabled</label>
                                <select class="form-control" id="ib_enabled" name="ib_enabled" required>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>

                            <!-- Display Priority -->
                            <div class="form-group col-lg-6 mb-3">
                                <label for="display_priority" class="form-label">Display Priority</label>
                                <input type="number" class="form-control" id="display_priority" name="display_priority"
                                    step="1" required>
                            </div>

                            <div class="form-group col-lg-6 mb-6">
                                <label for="mt5_server_id"><strong>MT5 Server</strong></label>
                               <select class="form-control" id="mt5_server_id1" name="mt5_server_id" required>
                                <option value="">-- Select MT5 Server --</option>
                                @foreach ($mt5Servers ?? [] as $server)
                                    <option value="{{ $server->id }}">{{ $server->mt5_company_name }}</option>
                                @endforeach
                            </select>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- ===== JS ===== --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function openGroupTypeModal() {
            // let serverId = document.getElementById("mt5_server_id").value;
            // if (!serverId) {
            //     Swal.fire('Error', 'Please select an MT5 Server first!', 'error');
            //     return;
            // }
            document.getElementById("groupTypeForm").reset();
            document.getElementById("mt5_grp_type_id").value = "";
            document.getElementById("groupTypeModalLabel").innerText = "Add Group Type";
            $('#groupTypeModal').modal('show');
        }

        function editGroupType(id) {
            //  let serverId = document.getElementById("mt5_server_id").value;
            // if (!serverId) {
            //     Swal.fire('Error', 'Please select an MT5 Server first!', 'error');
            //     return;
            // }
            fetch("{{ route('getmt5group') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    mt5_grp_type_id: id,
                    get_groupTypes: 1
                })
            }).then(res => res.json()).then(data => {
                if (!data.error) {
                    document.getElementById("mt5_grp_type_id").value = data.mt5_grp_cat_id;
                    document.getElementById("group_type_name").value = data.mt5_grp_cat_name;
                    document.getElementById("group_type_desc").value = data.mt5_grp_cat_desc;
                    document.getElementById("group_type_category").value = data.mt5_grp_cat_type;
                    document.getElementById("is_active").value = data.is_active;

                    document.getElementById("mt5_server_id").value = data.mt5_server_id;
                    document.getElementById("groupTypeModalLabel").innerText = "Edit Group Type";
                    $('#groupTypeModal').modal('show');
                } else {
                    Swal.fire('Error', data.error, 'error');
                }
            }).catch(err => console.error(err));
        }

        // Submit with SweetAlert
        document.getElementById("groupTypeForm").addEventListener('submit', function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            fetch(this.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: formData
                })
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: data.message,
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => location.reload());
                    } else {
                        Swal.fire('Error', data.message, 'error');
                    }
                })
                .catch(err => {
                    Swal.fire('Error', 'Something went wrong', 'error');
                    console.error(err)
                });
        });

        function openGroupMainModal() {
            //  let serverId = document.getElementById("mt5_server_id").value;
            // if (!serverId) {
            //     Swal.fire('Error', 'Please select an MT5 Server first!', 'error');
            //     return;
            // }
            document.getElementById("groupMainForm").reset();
            document.getElementById("groupMain_id").value = "";
            document.getElementById("groupMainModalLabel").innerText = "Add Group Main";
            $('#groupMainModal').modal('show');
        }

        function GroupModaladd() {

         
            document.getElementById("groupMgmtCreation").reset();
            document.getElementById("ac_index").value = "";
            document.getElementById("groupMgmtLabel").innerText = "Add Group Main";
            // document.getElementById("groupMgmt_server_id").value = serverId;

            $('#groupMgmt').modal('show');
        }
          function onServerChange(serverId) {
    // Use the correct IDs from your HTML
    document.getElementById("mt5_server_id").value = serverId;

    // Only set these if these IDs exist in your HTML
    var catElem = document.getElementById("groupCategory_server_id");
    if (catElem) catElem.value = serverId;

    var typeElem = document.getElementById("groupType_server_id");
    if (typeElem) typeElem.value = serverId;
}
function openEditModal(group) {
    $("#ac_index").val(group.ac_index);
    $("#ac_type").val(group.ac_type);
    $("#ac_name").val(group.ac_name);
    $("#ac_category").val(group.ac_category);
    $("#ac_book_type").val(group.ac_book_type);
    $("#ac_group").val(group.ac_group);
    $("#ac_min_deposit").val(group.ac_min_deposit);
    $("#ac_max_leverage").val(group.ac_max_leverage);
    $("#ac_spread").val(group.ac_spread);
    $("#ac_swap").val(group.ac_swap);
    $("#is_client_group").val(group.is_client_group);
    $("#inquiry_status").val(group.inquiry_status);
    $("#status").val(group.status);
    $("#ib_enabled").val(group.ib_enabled);
    $("#display_priority").val(group.display_priority);

    // ✅ Correct MT5 Server selection

     console.log(group.ac_index);
    $("#mt5_server_id1").val(group.mt5_server_id).trigger("change");

    $("#groupMgmtLabel").text("Edit Group Main");
    $("#groupMgmtCreation button[type=submit]").text("Update");

    $("#groupMgmt").modal("show");
}
        function editGroupMain(id) {

            fetch("{{ route('getmt5group') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    id: id,
                    get_groupMains: 1
                })
            }).then(res => res.json()).then(data => {
                if (!data.error) {
                    document.getElementById("groupMain_id").value = data.mt5_group_id;
                    document.getElementById("mt5_group_name").value = data.mt5_group_name;
                    document.getElementById("mt5_group_desc").value = data.mt5_group_desc;
                    document.getElementById("mt5_group_type").value = data.mt5_group_type;
                    document.getElementById("is_active_main").value = data.is_active;

                    document.getElementById("mt5_server_id").value = data.mt5_server_id;

                    document.getElementById("groupMainModalLabel").innerText = "Edit Group Main";
                    $('#groupMainModal').modal('show');
                } else {
                    Swal.fire('Error', data.error, 'error');
                }
            }).catch(err => console.error(err));
        }

        // Submit for Group Main
        document.getElementById("groupMainForm").addEventListener('submit', function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            fetch(this.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: formData
                })
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: data.message,
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => location.reload());
                    } else {
                        Swal.fire('Error', data.message, 'error');
                    }
                })
                .catch(err => {
                    Swal.fire('Error', 'Something went wrong', 'error');
                    console.error(err)
                });
        });

        function openGroupCategoryModal() {
            //  let serverId = document.getElementById("mt5_server_id").value;
            // if (!serverId) {
            //     Swal.fire('Error', 'Please select an MT5 Server first!', 'error');
            //     return;
            // }
            document.getElementById("groupCategoryForm").reset();
            document.getElementById("groupCategory_id").value = "";
            document.getElementById("groupCategoryModalLabel").innerText = "Add Group Category";
            $('#groupCategoryModal').modal('show');
        }

        function editGroupCategory(id) {
            //  let serverId = document.getElementById("mt5_server_id").value;
            // if (!serverId) {
            //     Swal.fire('Error', 'Please select an MT5 Server first!', 'error');
            //     return;
            // }
            fetch("{{ route('getmt5group') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    id: id,
                    get_groupCategories: 1
                })
            }).then(res => res.json()).then(data => {
                if (!data.error) {
                    document.getElementById("groupCategory_id").value = data.mt5_grp_cat_id;
                    document.getElementById("mt5_grp_cat_name").value = data.mt5_grp_cat_name;
                    document.getElementById("mt5_grp_cat_desc").value = data.mt5_grp_cat_desc;
                    document.getElementById("mt5_grp_cat_type").value = data.mt5_grp_cat_type;
                    document.getElementById("is_active").value = data.is_active;

                    document.getElementById("mt5_server_id").value = data.mt5_server_id;
                    document.getElementById("groupCategoryModalLabel").innerText = "Edit Group Category";
                    $('#groupCategoryModal').modal('show');
                } else {
                    Swal.fire('Error', data.error, 'error');
                }
            }).catch(err => console.error(err));
        }

        // Submit handler for Group Category
        document.getElementById("groupCategoryForm").addEventListener('submit', function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            fetch(this.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: formData
                })
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: data.message,
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => location.reload());
                    } else {
                        Swal.fire('Error', data.message, 'error');
                    }
                }).catch(err => {
                    Swal.fire('Error', 'Something went wrong', 'error');
                    console.error(err);
                });
        });

     
        function updateGroupName() {
            let mainSelect = document.getElementById('ac_type');
            let categorySelect = document.getElementById('ac_category');
            let typeSelect = document.getElementById('ac_book_type');

            let mainText = mainSelect.selectedOptions[0]?.dataset.gname || '';
            let categoryText = categorySelect.selectedOptions[0]?.text || '';
            let typeText = typeSelect.selectedOptions[0]?.text || '';

            if (mainText && categoryText && typeText) {
                document.getElementById('ac_group').value = `${mainText}\\${categoryText}-${typeText}`;
            } else {
                document.getElementById('ac_group').value = '';
            }
        }

        // Event listeners
        document.getElementById('ac_type').addEventListener('change', updateGroupName);
        document.getElementById('ac_category').addEventListener('change', updateGroupName);
        document.getElementById('ac_book_type').addEventListener('change', updateGroupName);

        document.getElementById("groupMgmtCreation").addEventListener("submit", function(e) {
            e.preventDefault();

            let form = this;
            let formData = new FormData(form);

            fetch(form.action, {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": formData.get('_token')
                    },
                    body: formData
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        $('#groupMgmt').modal('hide');
                        Swal.fire('Success', 'Group created successfully!', 'success')
                            .then(() => {
                                location.reload(); // ✅ reload page
                            });
                    } else {
                        Swal.fire('Error', data.error || 'Something went wrong', 'error');
                    }
                })
                .catch(err => {
                    Swal.fire('Error', 'Server error. Try again later.', 'error');
                });
        });
    </script>
@endsection
