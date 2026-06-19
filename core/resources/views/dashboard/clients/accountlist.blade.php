@extends('dashboard.layouts.master')
@section('title', 'Accounts List')
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
                <h2><i class="material-icons">&#xe7fe;</i> Client Accounts</h2>
                <small>
                    <a href="{{ route('adminHome') }}">{{ __('backend.home') }}</a>
                </small>
            </div>
			
			<div class="table-responsive">
    <table id="example" class="table table-bordered m-a-0">
       <thead class="dker">
        <tr>
            <th style="text-align:left;!important">#ID / Name</th>
            <th style="text-align:left;!important">Country</th>
            <th style="text-align:left;!important">Trade ID</th>
            <th style="text-align:left;!important">Deposit</th>
            <th style="text-align:left;!important">Balance</th>
            <th style="text-align:left;!important">Equity</th>
            <th style="text-align:left;!important">Profit(%)</th>
            <th style="text-align:left;!important">#Rank</th>
        </tr>
        <!-- Filter row at the TOP -->
        <!--<tr class="text-center" id="filterrow">-->
        <!--    <th>#ID / Name</th>-->
        <!--    <th>Country</th>-->
        <!--    <th>Trade ID</th>-->
        <!--    <th>Deposit</th>-->
        <!--    <th>Balance</th>-->
        <!--    <th>Equity</th>-->
        <!--    <th>Profit(%)</th>-->
        <!--    <th>#Rank</th>-->
        <!--</tr>-->
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
                                    <p class="text-muted f-12 mb-0" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $leader->randuser }}</p>
                                </div>
                            </div>
                        </a>
                    </td>
                    <td class="text-center"><img src="https://flagcdn.com/24x18/{{ strtolower($leader->ccode) }}.png" alt="{{ $leader->ccode }}" /></td>
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
                            <img src="{{ asset('assets/winnercup.png') }}" alt="" width="30" height="30" />
                            {{ $leader->rank }}
                        @else
                            -
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center">No Leader Ranks found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
			
			<!--<div class="table-responsive">-->
			<!--	<table class="table table-bordered m-a-0">-->
			<!--		<thead class="dker">-->
			<!--			<tr class="text-center">-->
			<!--				<th>#ID / Name</th>-->
			<!--				<th>Country</th>						   -->
			<!--				<th>Trade ID</th>-->
			<!--				<th>Deposit</th>-->
			<!--				<th>Balance</th> -->
			<!--				<th>Equity</th>-->
			<!--				<th>Profit(%)</th> -->
			<!--				<th>#Rank</th> -->
   <!--                     </tr>-->
			<!--		</thead>-->
			<!--		<tbody>-->
   <!--                     @forelse($liveaccountData as $leader)-->
			<!--			<tr class="">-->
   <!--                         <td class="text-start">-->
			<!--					<a href="{{ route('clientview', ['userid' => md5($leader->randuser)]) }}">-->
			<!--						<div class="d-flex align-items-center gap-2" style="display: flex;">-->
			<!--							<div class="">-->
			<!--								@if($leader->profile_image)-->
			<!--									<img style="border-radius: 50px;" src="{{ asset($leader->profile_image) }}" width="30" height="30" />-->
			<!--								@else-->
			<!--									<img style="border-radius: 50px;" src="{{ asset('assets/frontend/img/user.png') }}" width="30" height="30" />-->
			<!--								@endif-->
			<!--								</div>-->
			<!--							<div class="">-->
			<!--								<h6 class="mb-0"><span class="text-truncate w-100">{{ ucfirst($leader->name) }}</span>-->
			<!--								</h6>-->
			<!--								<p class="text-muted f-12 mb-0"><span class="text-truncate w-100">{{ $leader->randuser }}</span>-->
			<!--								</p>-->
			<!--							</div>-->
			<!--						</div>-->
			<!--					</a>-->
   <!--         			    </td>-->
			<!--				<td><img src="https://flagcdn.com/24x18/{{ strtolower($leader->ccode) }}.png" alt="{{ $leader->ccode }}" /></td>-->
			<!--				<td class="sorting_1">-->
			<!--					<a href="{{ route('accountview', ['tradeid' => md5($leader->trade_id)]) }}">-->
			<!--						<div class="row align-items-center">-->
			<!--							<div class="col-auto pe-0"><img src="{{ asset('assets/frontend/img/mt5.png') }}" alt="user-image" width="30" height="30" /></div>-->
			<!--							<div class="col ps-2">-->
			<!--								<h6 class="mb-0"><span class="text-truncate w-100">{{ $leader->trade_id }}</span>-->
			<!--								</h6>-->
			<!--								<p class="text-muted f-12 mb-0"><span class="text-truncate w-100">{{ $leader->ac_group }}</span>-->
			<!--								</p>-->
			<!--							</div>-->
			<!--						</div>-->
			<!--					</a>-->
			<!--				</td>-->
   <!--                         <td>$10000</td>-->
   <!--                         <td>${{ $leader->Balance }}</td>-->
   <!--         				<td>${{ $leader->equity }}</td>-->
   <!--         				<td>{{ $leader->profit_percent }}</td>-->
   <!--         				<td class="text-start">-->
   <!--                             @if(!empty($leader->rank))-->
   <!--                                 <img src="{{ asset('assets/winnercup.png') }}" alt="" width="30" height="30" />-->
   <!--                                 {{ $leader->rank }}-->
   <!--                             @else-->
   <!--                                 --->
   <!--                             @endif-->
   <!--                         </td>-->
   <!--                     </tr>-->
   <!--                     @empty-->
   <!--                     <tr>-->
   <!--                         <td colspan="9" class="text-center">No Leader Ranks found</td>-->
   <!--                     </tr>-->
   <!--                     @endforelse-->
			<!--		</tbody>-->
			<!--	</table>-->
			<!--</div>-->
        </div>
    </div>
@endsection

@push("after-scripts")

<!--<script>-->
   
<!--  new DataTable('#example', {-->
<!--    orderCellsTop: true,-->
<!--    fixedHeader: true,-->
<!--    ordering: false,-->
<!--    initComplete: function () {-->
<!--        let api = this.api();-->

        // Define which columns should have search inputs
<!--        let searchableColumns = [0, 2, 7];-->

<!--        api.columns().every(function () {-->
<!--            let column = this;-->
<!--            let colIndex = column.index();-->

            // Only add input if column index is in searchableColumns
<!--            if (searchableColumns.includes(colIndex)) {-->
<!--                let cell = $('#filterrow th').eq(colIndex);-->

<!--                let input = $('<input type="text" placeholder="Search" />')-->
<!--                    .appendTo(cell.empty())-->
<!--                    .on('keyup change', function () {-->
<!--                        if (column.search() !== this.value) {-->
<!--                            column.search(this.value).draw();-->
<!--                        }-->
<!--                    });-->
<!--            } else {-->
                // Clear other header cells (no search box)
<!--                $('#filterrow th').eq(colIndex).empty();-->
<!--            }-->
<!--        });-->
<!--    }-->
<!--});-->
<!--</script>-->
<script>
new DataTable('#example', {
    fixedHeader: true,
    ordering: false,
    initComplete: function () {
        let api = this.api();

        // Define which columns should have search inputs
        let searchableColumns = [0, 2, 7];

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
</script>


@endpush