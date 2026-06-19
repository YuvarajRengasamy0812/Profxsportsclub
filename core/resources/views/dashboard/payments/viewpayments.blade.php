@extends('dashboard.layouts.master')
@section('title','Payments Details')

@section('content')

<style>
/* ================== PAGE ================== */
.page-wrapper{
    background:#f4f6f8;
    padding:20px;
}

/* ================== CARD ================== */
.card-box{
    background:#fff;
    border-radius:14px;
    box-shadow:0 12px 28px rgba(0,0,0,.08);
    padding:20px;
    margin-bottom:20px;
    transition:all .3s ease;
}
.card-box:hover{
    transform:translateY(-4px);
    box-shadow:0 18px 45px rgba(0,0,0,.12);
}

/* ================== HEADER ================== */
.card-header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:20px;
}
.card-header h4{
    margin:0;
    font-weight:600;
}
.btn-back{
    border-radius:20px;
    padding:6px 18px;
}

/* ================== INFO CARDS ================== */
.info-card{
    background:#f8f9fa;
    border-radius:12px;
    padding:16px 20px;
    text-align:center;
    transition:all .3s ease;
}
.info-card:hover{
    transform:translateY(-3px);
    box-shadow:0 8px 20px rgba(0,0,0,.08);
}
.info-card h6{
    font-weight:500;
    color:#6c757d;
    margin-bottom:6px;
}
.info-card h5{
    margin:0;
    font-weight:600;
    font-size:16px;
}
.info-card .badge{
    font-size:13px;
    padding:5px 12px;
}

/* ================== HORIZONTAL TIMELINE ================== */
.timeline-horizontal{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-top:30px;
    flex-wrap:wrap;
}
.timeline-step{
    text-align:center;
    position:relative;
    flex:1;
}
.timeline-step:not(:last-child)::after{
    content:'';
    position:absolute;
    top:15px;
    right:-50%;
    width:100%;
    height:4px;
    background:#c7d2fe;
    z-index:0;
}
.timeline-step-circle{
    width:30px;
    height:30px;
    border-radius:50%;
    background:#3b82f6;
    display:inline-block;
    position:relative;
    z-index:1;
    margin-bottom:6px;
}
.timeline-step span{
    display:block;
    font-size:13px;
    color:#6c757d;
}
</style>

<div class="page-wrapper">

    <!-- HEADER -->
    <div class="card-box">
        <div class="card-header">
            <h4>Payments Details</h4>
            <a href="{{ route('corporateList') }}" class="btn btn-secondary btn-back"> Back</a>
        </div>

        <!-- INFO CARDS ROW -->
        <div class="row g-3">

            <div class="col-md-3">
                <div class="info-card">
                    <h6>Plan_name</h6>
                    <h5>{{ $payment->plan_name }}</h5>
                </div>
            </div>

            <div class="col-md-3">
                <div class="info-card">
                    <h6>Email</h6>
                    <h5>{{ $payment->amount }}</h5>
                </div>
            </div>

            <div class="col-md-3">
                <div class="info-card">
                    <h6>Phone</h6>
                    <h5>{{ $payment->methods }}</h5>
                </div>
            </div>




            <div class="col-md-3">
                <div class="info-card">
                    <h6>Created At</h6>
                    <h5>{{ date('d M Y H:i', strtotime($payment->created_at)) }}</h5>
                </div>
            </div>


        </div>

        <!-- HORIZONTAL TIMELINE -->
        <div class="timeline-horizontal">
            <div class="timeline-step">
                <div class="timeline-step-circle"></div>
                <span>payment Created<br>{{ $payment->created_at }}</span>
            </div>

           

            <div class="timeline-step">
                <div class="timeline-step-circle"></div>
                <span>Viewed by Admin<br>{{ now() }}</span>
            </div>
        </div>

    </div>

</div>

@endsection
