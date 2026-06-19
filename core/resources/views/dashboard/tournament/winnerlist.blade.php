@extends('dashboard.layouts.master')
@section('title', 'Winners Prize List')
@section('content')
<style>
tfoot input {
    width: 100%;
    padding: 3px;
    box-sizing: border-box;
}
.dt-search{
    display: flex;
    align-items: baseline;
    gap: 10px;
    padding: 0.5rem;
}
.dt-length {
    display: flex;
    align-items: baseline;
    gap: 10px;
    padding: 0.5rem;
}
</style>
<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css">

<!-- jQuery (needed if using DataTables <2 or jQuery mode) -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
    <div class="padding">
        <div class="box">

            <div class="box-header dker">
                <h2><img src="{{ asset('assets/winnercup.png') }}" alt="" width="30" height="30" /> Winners Prize List</h2>
                <small>
                    <a href="{{ route('adminHome') }}">{{ __('backend.home') }}</a>
                </small>
            </div>
			
			<div class="row p-a pull-right" style="margin-top: -70px;">
				<div class="col-sm-12">
				    @if($showLeague->price_distribute == 0)
					<a class="btn btn-fw primary distributePrize" href="javascript:void(0);">
						<img src="{{ asset('assets/winnercup.png') }}" alt="" width="30" height="30" /> Distribute the Prizes
					</a>
					@else
			        <h4><img src="{{ asset('assets/winnercup.png') }}" alt="" width="30" height="30" /> Winner's Amount Distributed</h4>
		        	@endif
				</div>
			</div>
		
			
			<div class="table-responsive">
				<table id="example" class="table table-bordered m-a-0">
				   <thead class="dker">
					<tr>
						<th style="text-align:left;!important">#ID / Name</th>
						<th style="text-align:left;!important">Trade ID</th>
						<th style="text-align:left;!important">Deposit</th>
						<th style="text-align:left;!important">Balance</th>
						<th style="text-align:left;!important">Equity</th>
						<th style="text-align:left;!important">Profit(%)</th>
						<th style="text-align:left;!important">#Rank - Prize($)</th>
					</tr>
				</thead>
					<tbody>
						@forelse($liveaccountData as $leader)
							<tr class="text-start">
								<td>
									<a href="{{ route('clientview', ['userid' => md5($leader->randuser)]) }}">
										<div style="display: flex; align-items: center; gap:10px;">
											<div>
												@if($leader->profile_image)
													<img style="border-radius: 50px;" src="{{ asset($leader->profile_image) }}" width="45" height="45" />
												@else
													<img style="border-radius: 50px;" src="{{ asset('assets/frontend/img/user.png') }}" width="45" height="45" />
												@endif
											</div>
											<div style="display: flex; flex-direction: column; justify-content: center; position: relative; top: 8px;">
												<h6 class="mb-0" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ ucfirst($leader->name) }}</h6>
												<p class="text-muted f-12 mb-0" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $leader->randuser }} / <img src="https://flagcdn.com/24x18/{{ strtolower($leader->ccode) }}.png" alt="{{ $leader->ccode }}" /></p>
											</div>
										</div>
									</a>
								</td>
								<td>
									<a href="{{ route('accountview', ['tradeid' => md5($leader->trade_id)]) }}">
										<div style="display: flex; align-items: center; gap:10px;">
											<div style="flex-shrink: 0;">
												<img src="{{ asset('assets/frontend/img/mt5.png') }}" alt="user-image" width="45" height="45" />
											</div>
											<div style="display: flex; flex-direction: column; justify-content: center; position: relative; top: 8px;">
												<h6 class="mb-0" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $leader->trade_id }}</h6>
												<p class="text-muted f-12 mb-0" style="white-space: normal; overflow: hidden; text-overflow: ellipsis;">{{ $leader->ac_group }}</p>
											</div>
										</div>
									</a>
								</td>
								<td style="text-align:left" >$10000</td>
								<td style="text-align:left">${{ $leader->Balance }}</td>
								<td style="text-align:left">${{ $leader->equity }}</td>
								<td style="text-align:left">{{ $leader->profit_percent }}</td>
								<td style="text-align:left">
									@if(!empty($leader->rank))
										<img src="{{ asset('assets/winnercup.png') }}" alt="" width="30" height="30" />&nbsp;&nbsp;&nbsp; <b>{{ $leader->rank }}</b> - ${{ $leader->prize_amount }}
									@endif
								</td>
								
							</tr>
						@empty
							<tr>
								<td class="text-center">No Winner list found</td>
							</tr>
						@endforelse
					</tbody>
				</table>
			</div>
        </div>
    </div>
@endsection

@push("after-scripts")
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
new DataTable('#example', {
    fixedHeader: true,
    ordering: false,
    initComplete: function () {
        let api = this.api();

        // Define which columns should have search inputs
        let searchableColumns = [0, 1, 7];

        api.columns().every(function () {
            let column = this;
            let colIndex = column.index();

            // Only add input if column index is in searchableColumns
            if (searchableColumns.includes(colIndex)) {
                let cell = $(column.header()); // first row th

                // Wrap title + input inside a flex container
                let title = cell.text();
                cell.empty();

                $('<div style="display:flex; flex-direction:row; align-items:center; gap:10px;">')
    .append('<span style="white-space:nowrap;">' + title + '</span>')
    .append(
        $('<input type="text" placeholder="Search" style="padding:4px 8px; max-width:120px; border:1px solid #ccc; border-radius:25px; font-size:12px;" />')
            .on('keyup change', function () {
                if (column.search() !== this.value) {
                    column.search(this.value).draw();
                }
            })
    )
    .appendTo(cell);

            }
        });
    }
});


$(document).on('click', '.distributePrize', function() {
    Swal.fire({
        title: 'Are you sure?',
        text: "This will distribute the prizes to winners' wallets!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, distribute!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "{{ route('distributePrize', $showLeague->id) }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function(res) {
                    Swal.fire('Success!', res.message, 'success');
                },
                error: function(xhr) {
                    Swal.fire('Error!', 'Something went wrong.', 'error');
                }
            });
        }
    });
});
</script>

@endpush