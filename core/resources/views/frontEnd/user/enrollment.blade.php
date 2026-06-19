@extends('frontEnd.layouts.master')

@section('content')
<?php
$title_var = "title_" . @Helper::currentLanguage()->code;
$title_var2 = "title_" . config('smartend.default_language');
$details_var = "details_" . @Helper::currentLanguage()->code;
$details_var2 = "details_" . config('smartend.default_language');
$aboutsection1 = Helper::Topic(155);
$aboutsecupcoming = Helper::Topic(156);
$aboutseconemid = Helper::Topic(158);
$aboutsectwomid = Helper::Topic(159);
$aboutjoinleague = Helper::Topic(160);
?>
<div class="overflow-hidden space position-relative z-index-common" style="margin-top:100px;" >
	
	<div class="container">
		<div class="row">
			<div id="sidebar-overlay" class="overlay w-100 vh-100 d-none position-fixed"></div>
			@include('frontEnd.user.usermenu')
			<div class="col-lg-10 col-sm-12">
			
				<div class="row align-items-stretch c-dashboard-group m-3">
					<div class="col-lg-12">
						<h2 class="widget_title">ProFX <span class="text-theme">Enrollment</span> !</h2>
					</div>
				</div>
				
			</div>
		</div>
	</div>
</div>

	
	

@endsection
@push('before-styles')
    {{-- integrate your custom css code/files here --}}
@endpush
@push('after-styles')
    {{-- integrate your custom css code/files here --}}
@endpush
@push('after-scripts')
<script src="https://cdn.canvasjs.com/ga/canvasjs.min.js"></script>
<script>
    //Create Chart
    var chart = new CanvasJS.Chart("chartContainer", {
        //Chart Options - Check https://canvasjs.com/docs/charts/chart-options/
        backgroundColor: "transparent",
        color: "white",
        title: {
            text: "ProFx - League Leader Score",
            fontColor: "#fff",
            fontSize: 25,
        },
        axisX: {
            title: "Rounds",
            fontColor: "#fff",
            // valueFormatString: "MMM"
            titleFontColor: "#fff",
            labelFontColor: "#fff"
        },
        axisY: {
            title: "Rank",
            prefix: "#",
            reversed: true,
            fontColor: "#fff",
            titleFontColor: "#fff",
            labelFontColor: "#fff"
        },
        data: [{
            type: "spline",
            color: "#45F882",
            dataPoints: [{
                    label: "1",
                    legendMarkerColor: "#fff",
                    y: 10,
                    color: "#fff"
                },
                {
                    label: "2",
                    legendMarkerColor: "#fff",
                    y: 15,
                    color: "#fff"
                },
                {
                    label: "3",
                    legendMarkerColor: "#fff",
                    y: 25,
                    color: "#fff"
                },
                {
                    label: "4",
                    legendMarkerColor: "#fff",
                    y: 30,
                    color: "#fff"
                },
                {
                    label: "5",
                    legendMarkerColor: "#fff",
                    y: 28,
                    color: "#fff"
                }
            ]
        }]
    });
    //Render Chart
    chart.render();
    // var chart = new CanvasJS.Chart("chartContainer", options);
    // new CanvasJS.Chart("#chartContainer", options);
</script>
    {{-- integrate your custom js code/files here--}}
@endpush
@section('footInclude')
    {{-- integrate your custom js code/files here--}}
@endsection
