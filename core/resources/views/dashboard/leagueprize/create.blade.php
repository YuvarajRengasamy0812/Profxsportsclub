@extends('dashboard.layouts.master')
@section('title', 'League - Prize Plannong')
@section('content')
<div class="padding">
    <div class="box">
        <div class="box-header dker">
            <h2><i class="material-icons">&#xe02e;</i> Add New Prize</h2>
            <small>
                <a href="{{ route('adminHome') }}">{{ __('backend.home') }}</a> /
                <a href="{{ route('leagueprizelist') }}">League Prize</a>
            </small>
        </div>
        
        <div class="box-body p-a-2">
            {{ Form::open(['route'=>['leagueprizestore'],'method'=>'POST', 'files' => true ]) }}
            
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
                        <label class="form-label">Total Prize</label>
                        <input type="number" class="form-control" name="totalprize" id="totalprize" readonly />
                    </div>
                </div> 
            </div>
			<div class="row">
				<h6>Prize Values</h6>
				<hr />

				<div class="col-sm-12">
					<table class="table table-bordered" id="prizeTable">
						<thead>
							<tr>
								<th style="width: 10%">Rank</th>
								<th style="width: 30%">Prize Value</th>
								<th style="width: 10%">Action</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td><input type="number" name="rank[]" class="form-control" value="1" readonly /></td>
								<td><input type="number" name="prize[]" class="form-control prize-input" value="0" /></td>
								<td><button type="button" class="btn btn-success addRow">+</button></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			
			
            <hr/>
            <div class="form-group row m-t-md">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-lg btn-primary m-t">
                        <i class="material-icons">&#xe31b;</i> {!! __('backend.add') !!}
                    </button>
                    <a href="{{route('leagueprizelist')}}" class="btn btn-lg btn-default m-t">
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

document.addEventListener("DOMContentLoaded", function () {
    let table = document.querySelector("#prizeTable tbody");
    let totalPrizeInput = document.querySelector("#totalprize");

    // Function to update total prize
    function updateTotal() {
        let rowCount = table.querySelectorAll("tr").length;
        totalPrizeInput.value = rowCount;
    }

    // Event: Add new row
    document.addEventListener("click", function (e) {
        if (e.target.classList.contains("addRow")) {
            let rowCount = table.querySelectorAll("tr").length;
            let newRow = document.createElement("tr");
            newRow.innerHTML = `
				<td><input type="number" name="rank[]" class="form-control" value="${rowCount + 1}" readonly /></td>
				<td><input type="number" name="prize[]" class="form-control prize-input" value="0" /></td>
				<td><button type="button" class="btn btn-danger removeRow">x</button></td>
			`;
            table.appendChild(newRow);
			updateTotal();
        }
    });

    // Event: Remove row
    document.addEventListener("click", function (e) {
        if (e.target.classList.contains("removeRow")) {
            e.target.closest("tr").remove();
            // Reorder rank numbers after delete
            let rows = table.querySelectorAll("tr");
            rows.forEach((row, index) => {
                row.querySelector("input[name='rank[]']").value = index + 1;
            });

            updateTotal();
        }
    });

    // Event: Auto update total prize
    updateTotal();
});


</script>
@endpush
