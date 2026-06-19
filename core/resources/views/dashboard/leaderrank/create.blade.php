@extends('dashboard.layouts.master')
@section('title', 'League - Add New')
@section('content')
<div class="padding">
    <div class="box">
        <div class="box-header dker">
            <h2><i class="material-icons">&#xe02e;</i> Add New Leader Rank</h2>
            <small>
                <a href="{{ route('adminHome') }}">{{ __('backend.home') }}</a> /
                <a href="{{ route('leaderranklist') }}">Leader Board</a>
            </small>
        </div>
        
        <div class="box-body p-a-2">
            {{ Form::open(['route'=>['storeleaderrank'],'method'=>'POST', 'files' => true ]) }}
            
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
				
				<div class="col-sm-12 col-md-3">
                    <div class="p-b-1">
                        <label class="form-label">Tournaments</label>
                        <select name="tournament_id" id="tournament_id" class="form-control" required >
                            <option value="" selected disabled>Select Tournaments</option>
                        </select> 
                    </div>
                </div>
				
				<div class="col-sm-12 col-md-3">
                    <div class="p-b-1">
                        <label class="form-label">Leader User</label>
                        <select name="userid" id="userid" class="form-control" required >
							<option value="" selected disabled>Select User</option>
                            @foreach($leaderuser as $leuser)
                                <option value="{{ $leuser->id }}">{{ $leuser->name }}-{{ $leuser->userid }}</option>
                            @endforeach
                        </select> 
                    </div>
                </div>

                <div class="col-sm-12 col-md-3 mb-3">
					<div class="p-b-1">
						<label class="form-label">Balance</label>
						<input type="text" class="form-control" name="balance" id="balance" required />
					</div>
				</div>

				<div class="col-sm-12 col-md-3 mb-3">
					<div class="p-b-1">
						<label class="form-label">Equity</label>
						<input type="text" class="form-control" name="equity" id="equity" required />
					</div>
				</div>

				<div class="col-sm-12 col-md-3 mb-3">
					<div class="p-b-1">
						<label class="form-label">Profit %</label>
						<input type="text" class="form-control" name="profit" id="profit" readonly />
					</div>
				</div>
				
				<div class="col-sm-12 col-md-3">
                    <label class="form-label">Status</label>
					<select name="status" class="form-control" required >
						<option value="1" >Active</option>
						<option value="0" >Inactive</option>
					</select>
				</div>
            </div>
            <hr/>
            <div class="form-group row m-t-md">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-lg btn-primary m-t">
                        <i class="material-icons">&#xe31b;</i> {!! __('backend.add') !!}
                    </button>
                    <a href="{{route('leaderranklist')}}" class="btn btn-lg btn-default m-t">
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

document.getElementById('subcategoryid').addEventListener('change', function() {
    const categoryId = document.getElementById('categoryid').value;
    const subcategoryId = this.value;
    const tournamentSelect = document.getElementById('tournament_id');
    tournamentSelect.innerHTML = '<option value="" selected disabled>Loading...</option>';

    fetch("{{ route('getTournament') }}", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json'
        },
        body: JSON.stringify({ catid: categoryId, subcategoryId: subcategoryId })
    })
    .then(response => response.json())
    .then(data => {
        tournamentSelect.innerHTML = '<option value="" selected disabled>Select Tournament</option>';
        data.forEach(tourna => {
            const option = document.createElement('option');
            option.value = tourna.id;
            option.textContent = tourna.leagurTitle;
            tournamentSelect.appendChild(option);
        });
    })
    .catch(error => {
        subcatSelect.innerHTML = '<option value="" selected disabled>Error loading Tournament</option>';
        console.error('Error fetching Tournament:', error);
    });
});

/*document.getElementById('tournament_id').addEventListener('change', function() {    
    const tournamentId = this.value;
    const useridSelect = document.getElementById('tradeid');
    useridSelect.innerHTML = '<option value="" selected disabled>Loading...</option>';

    fetch("{{ route('getTournamentuser') }}", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json'
        },
        body: JSON.stringify({ tournamentId: tournamentId })
    })
    .then(response => response.json())
    .then(data => {
        useridSelect.innerHTML = '<option value="" selected disabled>Select User</option>';
        data.forEach(tourna => {
            const option = document.createElement('option');
            option.value = tourna.trade_id;
            option.textContent = tourna.name+'-'+tourna.trade_id;
            useridSelect.appendChild(option);
        });
    })
    .catch(error => {
        subcatSelect.innerHTML = '<option value="" selected disabled>Error loading live account users</option>';
        console.error('Error fetching live account users:', error);
    });
});

document.getElementById('tradeid').addEventListener('change', function() {    
    const tradeid = this.value;
    fetch("{{ route('getliveaccountbalance') }}", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json'
        },
        body: JSON.stringify({ tradeid: tradeid })
    })
    .then(response => response.json()) // ✅ parse JSON first
    .then(data => {
        if (data && data.balance !== undefined) {
            $('#balance').val(data.balance);
            $('#userid').val(data.userid);
        } else {
            Swal.fire('Error', 'No balance found for this trade ID', 'error');
        }
    })
    .catch(error => {
        console.error('Error fetching balance:', error);
        Swal.fire('Error', 'Something went wrong fetching balance', 'error');
    });
});*/


$(document).ready(function(){

    // Auto-set equity when balance is entered
    $("#balance").on("input", function(){
        let balance = $(this).val().replace(/[^0-9.]/g, ''); // allow only numbers & decimal
        $(this).val(balance);

        if(balance !== ""){
            $("#equity").val(balance);   // auto-fill equity
            $("#profit").val("0 %");     // default profit
        } else {
            $("#equity").val("");
            $("#profit").val("");
        }
    });

    // Validation on blur (if user changes equity manually)
    $("#equity").on("blur", function(){
        let balance = parseFloat($("#balance").val()) || 0;
        let equity  = parseFloat($("#equity").val()) || 0;

        if(equity !== ""){
            if(equity < balance){
                Swal.fire({
                    icon: "error",
                    title: "Invalid Equity",
                    text: "Equity cannot be less than Balance!",
                });
                $("#equity").val(balance);
                $("#profit").val("0 %");
                return;
            }

            if(equity > balance){
                let profitValue   = equity - balance;
                let profitPercent = (profitValue / balance) * 100;
                $("#profit").val(Math.ceil(profitPercent));
            } else {
                $("#profit").val("0");
            }
        }
    });

});

</script>
@endpush
