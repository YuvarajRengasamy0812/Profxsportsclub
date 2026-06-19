@extends('dashboard.layouts.master')
@section('title', 'Client List')
@section('content')
<style>
        /* Grid Layout */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 1rem !important;
        }

        /* Card Styling */
        .stat-card {
            background: #fff;
            /* border-radius: 12px; */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 16px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            /* height: 200px; */
            transition: transform 0.2s ease;
        }

        .stat-card:hover {
            transform: translateY(-3px);
        }

        /* Layout helpers */
        .stat-row {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .stat-row.spread {
            justify-content: space-between;
            align-items: flex-start;
        }

        .stat-col {
            flex: 1;
            text-align: center;
        }

        /* Typography */
        .stat-label {
            font-size: 14px;
            color: #6c757d;
            margin-bottom: 6px;
            text-align: center;
        }

        .stat-value {
            margin: 0;
        }

        /* Colors */
        .icon-primary {
            font-size: 30px;
            color: #0d6efd;
        }

        .icon-success {
            font-size: 20px;
            color: #28a745;
        }

        .icon-danger {
            font-size: 20px;
            color: #dc3545;
        }

        /* Utilities */
        .clickable {
            cursor: pointer;
        }
        
        .c-btn{
            padding: 10px;
            border: 1px solid #dee2e6;
            border-radius: 6px;
            transition: background-color 0.2s ease, border-radius 0.2s ease;
        }
        .c-btn:hover {
            background-color: #f8f9fa;
            border-radius: 8px;
        }

    </style>
    <div class="padding"> 		
        <div class="box">

            <div class="box-header dker">
                <h2><i class="material-icons">&#xe7fe;</i> Leader User List</h2>
                <small>
                    <a href="{{ route('adminHome') }}">{{ __('backend.home') }}</a>
                </small>
            </div>
			
			<div class="row p-a pull-right" style="margin-top: -70px;">
				<div class="col-sm-12">					
					<a class="btn btn-fw primary" href="{{ route('leaderusercreate') }}">
						<i class="material-icons">&#xe7fe;</i> Add New Users
					</a>
				</div>
			</div>

            @if($Users->total() > 0)
                {{Form::open()}}
                <div class="table-responsive">
                    <table class="table table-bordered m-a-0">
                        <thead class="dker">
                        <tr>
                            <th  class="width20 dker">
                                <label class="ui-check m-a-0">
                                    <input id="checkAll" type="checkbox"><i></i>
                                </label>
                            </th>
							<th class="text-center" style="width:200px;">Status / Action</th>
                            <th>Name / Email</th>       
                            <th>Phone</th>
                            <th>Country</th>
							<th>Registered At</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($Users as $User)
                            <tr>
                                <td class="dker"><label class="ui-check m-a-0">
                                        <input type="checkbox" name="ids[]" value="{{ $User->id }}"><i
                                            class="dark-white"></i>
                                        {!! Form::hidden('row_ids[]',$User->id, array('class' => 'form-control row_no')) !!}
                                    </label>
                                </td>
								
								<td class="text-center">
									<i class="fa {{ ($User->status==1) ? "fa-check text-success":"fa-times text-danger" }} inline"></i>
                                    <a class="" href="{{ route("leaderuseredit",["id"=>$User->id]) }}"> 
                                        <small><i class="material-icons">&#xe3c9;</i>
                                        </small>
                                    </a>
                                </td>
                                
                                <td>
    							    <div style="display: flex; align-items: center; gap: 10px;">
    							        <div>
            							    @if($User->profile_image)
            								    <img style="border-radius: 50px;" src="{{ asset($User->profile_image) }}" width="60" height="60" />
                                            @else
                                                <img style="border-radius: 50px;" src="{{ asset('assets/frontend/img/user.png') }}" width="60" height="60" />
                                            @endif
                                       </div>
                                       <div>
    								        <strong>{{ ucfirst($User->name) }}</strong><br />
    								        <small>{{ $User->email }}</small>
    								   </div>
    								</div>
    							</td>
                                <td class="h6">+{{ $User->country_code }} - {{ $User->phone }}</td>
                                <td class="h6"><img src="https://flagcdn.com/24x18/{{ strtolower($User->flagcode) }}.png" alt="{{ $User->flagcode }}" /> {!! ucfirst($User->country)   !!}</td>
                                <td class="h6">{{ date('Y-m-d', strtotime($User->created_at)) }}</td>
                            </tr>
                            <!-- .modal -->
                            <div id="m-{{ $User->id }}" class="modal fade" data-backdrop="true">
                                <div class="modal-dialog" id="animate">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">{{ __('backend.confirmation') }}</h5>
                                        </div>
                                        <div class="modal-body text-center p-lg">
                                            <p>
                                                {{ __('backend.confirmationDeleteMsg') }}
                                                <br>
                                                <strong>[ {{ $User->name }} ]</strong>
                                            </p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn dark-white p-x-md"
                                                    data-dismiss="modal">{{ __('backend.no') }}</button>
                                            <a href="{{ route("usersDestroy",["id"=>$User->id]) }}"
                                               class="btn danger p-x-md">{{ __('backend.yes') }}</a>
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div>
                            </div>
                            <!-- / .modal -->
                        @endforeach

                        </tbody>
                    </table>

                </div>
                <footer class="dker p-a">
                    <div class="row">
                        <div class="col-sm-3 hidden-xs">
                            <!-- .modal -->
                            <div id="m-all" class="modal fade" data-backdrop="true">
                                <div class="modal-dialog" id="animate">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">{{ __('backend.confirmation') }}</h5>
                                        </div>
                                        <div class="modal-body text-center p-lg">
                                            <p>
                                                {{ __('backend.confirmationDeleteMsg') }}
                                            </p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn dark-white p-x-md"
                                                    data-dismiss="modal">{{ __('backend.no') }}</button>
                                            <button type="submit"
                                                    class="btn danger p-x-md">{{ __('backend.yes') }}</button>
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div>
                            </div>
                            <!-- / .modal -->
                            @if(@Auth::user()->permissionsGroup->settings_status)
                                <select name="action" id="action" class="form-control c-select w-sm inline v-middle"
                                        required>
                                    <option value="">{{ __('backend.bulkAction') }}</option>
                                    <option value="activate">{{ __('backend.activeSelected') }}</option>
                                    <option value="block">{{ __('backend.blockSelected') }}</option>
                                    <option value="delete">{{ __('backend.deleteSelected') }}</option>
                                </select>
                                <button type="submit" id="submit_all"
                                        class="btn white">{{ __('backend.apply') }}</button>
                                <button id="submit_show_msg" class="btn white" data-toggle="modal"
                                        style="display: none"
                                        data-target="#m-all" ui-toggle-class="bounce"
                                        ui-target="#animate">{{ __('backend.apply') }}
                                </button>
                            @endif
                        </div>

                        <div class="col-sm-3 text-center">
                            <small class="text-muted inline m-t-sm m-b-sm">{{ __('backend.showing') }} {{ $Users->firstItem() }}
                                -{{ $Users->lastItem() }} {{ __('backend.of') }}
                                <strong>{{ $Users->total()  }}</strong> {{ __('backend.records') }}</small>
                        </div>
                        <div class="col-sm-6 text-right text-center-xs">
                            {!! $Users->links() !!}
                        </div>
                    </div>
                </footer>
                {{Form::close()}}
            @endif
        </div>
    </div>
@endsection
@push("after-scripts")
    <script type="text/javascript">
        $("#checkAll").click(function () {
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
        $("#action").change(function () {
            if (this.value == "delete") {
                $("#submit_all").css("display", "none");
                $("#submit_show_msg").css("display", "inline-block");
            } else {
                $("#submit_all").css("display", "inline-block");
                $("#submit_show_msg").css("display", "none");
            }
        });
    </script>
@endpush
