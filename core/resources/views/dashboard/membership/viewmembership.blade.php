@extends('dashboard.layouts.master')
@section('title','Membership Details')

@section('content')

<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<style>
:root{
    --primary:#af3336; /* Background */
    --dark:#fff;    /* Font color */
}

/* PAGE */
.page-wrapper{
    background:#f5f5f5;
    padding:30px;
    min-height:100vh;
}

/* MAIN CARD */
.main-card{
    background:#fff;
    border-radius:20px;
    padding:28px;
    box-shadow:0 15px 40px rgba(0,0,0,.12);
}

/* HEADER */
.page-header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    border-bottom:2px solid var(--primary);
    padding-bottom:15px;
    margin-bottom:25px;
}
.page-header h3{
    font-weight:900;
    color:var(--dark);
}
.btn-back{
    background:var(--primary);
    color:var(--dark);
    border-radius:30px;
    padding:8px 22px;
}

/* INFO CARD - all same style now */
.info-card{
    border-radius:18px;
    padding:22px;
    background:var(--primary);
    color:var(--dark);
    font-weight:600;
    transition:.35s ease;
}
.info-card:hover{
    transform:translateY(-6px);
    box-shadow:0 12px 30px rgba(0,0,0,.25);
}
.info-card h6{
    font-size:12px;
    opacity:.8;
    letter-spacing:.05em;
    margin-bottom:6px;
}
.info-card h5{
    margin:0;
    font-weight:700;
}

/* SECTION TITLE */
.section-title{
    font-weight:900;
    color:var(--dark);
    margin-bottom:15px;
}

/* SPORTS BADGES */
.sport-badge{
    background:var(--primary);
    color:var(--dark);
    padding:6px 14px;
    border-radius:20px;
    font-size:13px;
    font-weight:600;
    display:inline-block;
    margin:4px;
    text-transform:uppercase;
}
.sport-badge:hover{
    transform:scale(1.05);
}

/* PROOF */
.proof-img{
    max-height:250px;
    border-radius:18px;
    box-shadow:0 18px 40px rgba(0,0,0,.3);
}
</style>

<div class="page-wrapper">

    <div class="main-card" data-aos="fade-up">

        {{-- HEADER --}}
        <div class="page-header">
            <h3>Membership Details</h3>
            <a href="{{ url()->previous() }}" class="btn btn-back">← Back</a>
        </div>

        {{-- PERSONAL INFO --}}
        <h5 class="section-title">Personal Information</h5>
        <div class="row g-4 mb-4">
            <div class="col-md-3"><div class="info-card"><h6>Name</h6><h5>{{ $member->name }}</h5></div></div>
            <div class="col-md-3"><div class="info-card"><h6>Email</h6><h5>{{ $member->email }}</h5></div></div>
            <div class="col-md-3"><div class="info-card"><h6>Phone</h6><h5>{{ $member->phone }}</h5></div></div>
            <div class="col-md-3"><div class="info-card"><h6>Location</h6><h5>{{ $member->location }}</h5></div></div>
        </div>

        {{-- COMPANY & ROLE --}}
        <h5 class="section-title">Company & Role</h5>
        <div class="row g-4 mb-4">
            <div class="col-md-4"><div class="info-card"><h6>Company</h6><h5>{{ $member->company }}</h5></div></div>
            <div class="col-md-4"><div class="info-card"><h6>Role</h6><h5>{{ $member->role }}</h5></div></div>
            <div class="col-md-4"><div class="info-card"><h6>Joined On</h6><h5>{{ date('d M Y', strtotime($member->created_at)) }}</h5></div></div>
        </div>

        {{-- SPORTS --}}
        <h5 class="section-title">Sports</h5>
        <div class="mb-4">
            @php
                $sports = array_filter(array_map('trim', explode(',', $member->sports)));
            @endphp

            @foreach($sports as $sport)
                @if($sport)
                    <span class="sport-badge">{{ $sport }}</span>
                @endif
            @endforeach
        </div>



      

    </div>

</div>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
AOS.init({
    duration:900,
    once:true
});
</script>

@endsection
