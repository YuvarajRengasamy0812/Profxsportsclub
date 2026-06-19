@extends('frontEnd.layouts.master')

@section('content')

<!-- AOS + Masonry + Swiper -->
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" rel="stylesheet">

<style>

  .share-modal{
  display:none; position:fixed; top:0; left:0; width:100%; height:100%;
  background:rgba(0,0,0,.55); justify-content:center; align-items:center; 
  z-index:9999;
}
.share-content{
  background:#fff; padding:25px; border-radius:12px; width:320px; text-align:center;
  box-shadow:0 6px 25px rgba(0,0,0,0.25);
}
.social-buttons a, .social-buttons button{
  display:block; margin:10px 0; padding:10px; border-radius:8px;; 
  color:#011C32; text-decoration:none; font-weight:bold; cursor:pointer;
}
.social-buttons .btn {
    font-weight: 600;
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 8px;
  }
.close-btn{
  margin-top:15px; background:#333; color:#fff; padding:10px 18px; border-radius:8px;
  cursor:pointer; font-weight:700; border:none;
}
/* General Section */
.section { max-width: 1250px; margin: 44px auto; padding: 0 20px; color: #333; }
.section h2 { font-family: "Marcellus", serif; font-size: 28px; margin-bottom: 20px; text-align:center; }

/* Hero */
.hero-wrap { position: relative; margin: 32px auto; border-radius: 10px; overflow: hidden; padding:0; }
.hero-bg {
  background-image: linear-gradient(120deg, rgba(51,48,48,0.15), rgba(45,27,27,0.15)),url('{{ asset('assets/frontend/images/players/events/past events.png') }}');
  background-size: cover; background-position: inherit; min-height: 550px; display: flex; align-items: center; justify-content: center;
}
.hero-glass {
   padding: 28px; border-radius: 10px;
  color: #fff; max-width: 1100px; display: grid; grid-template-columns: 1fr 300px; gap: 28px; align-items: center;
}
.hero-left h1 { font-size: 40px; margin:0 0 12px; font-family:"Marcellus", serif; }
.hero-left h3 { font-size: 18px; margin-bottom:12px;color:#fff }
.hero-left p { font-size:16px; line-height:1.6;color:#fff; }
.hero-ctas { display:flex; gap:12px; margin-top:14px; flex-wrap: wrap; }
.btn { text-decoration:none; display:inline-flex; align-items:center; gap:8px; font-weight:700; padding:10px 18px; border-radius:999px; cursor:pointer; border:none; transition:0.3s ease; }
.btn-primary { background: linear-gradient(90deg,#ef7e35,#ef3b3b); color:#fff; }
.btn-secondar { background:#011C32 ; border:0px solid #fff; color:#fff; }

/* Filters */
.filters { display:flex; gap:16px; flex-wrap:wrap; justify-content:center; margin-bottom:30px; }
.filter { background: rgba(255,255,255,0.9); padding:12px 16px; border-radius:0px; border:0px solid rgba(200,200,200,0.3); backdrop-filter: blur(6px); display:flex; flex-direction:column; }
.filter label { font-weight:600; margin-bottom:6px; font-size:14px; }
.select-wrap { position:relative; width:200px; }
.select-wrap::after {  position:absolute; right:12px; top:50%; transform:translateY(-50%); pointer-events:none; color:#66788a; font-weight:700; }
.select { width:100%; padding:10px 36px 10px 12px; border:1px solid #ccc; border-radius:8px; background:#fff; appearance:none; font-size:14px; color:#333; }
.select:focus { outline:none; border-color:#ef7e35; box-shadow:0 0 0 2px rgba(239,126,53,0.15); }
.filter button { padding:10px 20px; border-radius:40px; border:none; font-weight:700; cursor:pointer; background:linear-gradient(90deg,#ef7e35,#ef3b3b); color:#fff; }
.filter button:hover { opacity:0.9; }

/* Masonry Grid */
.grid { display:grid; grid-template-columns: repeat(auto-fit,minmax(280px,1fr)); gap:20px; }
.event-card { background:#fff; border-radius:12px; overflow:hidden; box-shadow:0 8px 26px rgba(0,0,0,0.1); display:flex; flex-direction:column; transition:0.3s ease; }
.event-card:hover { transform:translateY(-6px); box-shadow:0 20px 45px rgba(0,0,0,0.15); }
.event-thumb { width:100%; height:150px; object-fit:inherit; }
.event-body { padding:14px 16px; display:flex; flex-direction:column; gap:8px; }
.event-meta { font-size:13px; color:rgba(0,0,0,0.7); display:flex; gap:6px; flex-wrap:wrap; }
.card-actions { margin-top:auto; display:flex; gap:8px; }

/* Responsive */
@media(max-width: 860px){ .hero-glass { grid-template-columns:1fr; } .select-wrap { width:100%; } }
@media(max-width:480px){ .hero-left h1{ font-size:24px; } .hero-left p, .hero-left h3{ font-size:14px; } }
</style>

<section class="container-fluid hero-wrap" data-aos="fade-up">
  <div class="hero-bg">
    <div class="hero-glass">
      <div class="hero-left">
        <h1>Past Events: Echoes of 2026 Triumphs</h1>
        <h3>Relive Wins, Lessons, and Forex Glory</h3>
        <p>Browse Profx's 2026 archives – recaps of sponsored spectacles where brokers became champions. UAE/Gulf/India highlights; virtual vibes. Verified members: Share your recaps!</p>
        <div class="hero-ctas">
          <a href="#recapGrid" class="btn btn-primary">Browse Recaps</a>
          <a href="{{ url('/upcomeingEvent') }}" class="btn btn-secondar">Upcoming Event</a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Filters -->
<section class="section" data-aos="fade-up">
  <h2>2026 Victory Vault – Detailed Recaps</h2>
  <div class="filters">
    <div class="filter select-wrap">
      <label>Type</label>
      <select id="filterType" class="select">
        <option value="">All Types</option>
        <option value="Physical">Physical</option>
        <option value="E-Sports">E-Sports</option>
        <option value="Hybrid">Hybrid</option>
      </select>
    </div>
    <div class="filter select-wrap">
      <label>Location</label>
      <select id="filterLocation" class="select">
        <option value="">All Locations</option>
        <option value="UAE">UAE</option>
        <option value="Gulf">Gulf</option>
        <option value="India">India</option>
        <option value="Virtual">Virtual</option>
      </select>
    </div>
    <div class="filter" style="align-self:flex-end;">
      <button id="applyFilters" class="btn">Apply Filters</button>
    </div>
  </div>

  <!-- Recap Grid -->
  <div id="recapGrid" class="grid">
    @php
      $recaps = [
        ['name'=>'Past Events','title'=>'Badminton Bash','date'=>'2026-03-02','location'=>'Abu Dhabi, Gulf','type'=>'Physical','winner'=>'Alpha Brokers','stats'=>'Top 3 Matches: 45','image'=>URL::asset('assets/frontend/images/players/event/smallbox/7.png'),'bg'=>URL::asset('assets/frontend/images/players/event/bigbox/7.png')],
        ['name'=>'Past Events','title'=>'Fitness Challenge','date'=>'2026-04-06','location'=>'Dubai, UAE','type'=>'Physical','winner'=>'Beta Prop Firm','stats'=>'Reps: 180 total','image'=>URL::asset('assets/frontend/images/players/event/smallbox/8.png'),'bg'=>URL::asset('assets/frontend/images/players/event/bigbox/8.png')],
        ['name'=>'Past Events','title'=>'Cricket Derby','date'=>'2026-07-15','location'=>'Mumbai, India','type'=>'Physical','winner'=>'Delta Squad','stats'=>'Runs: 180','image'=>URL::asset('assets/frontend/images/players/event/smallbox/9.png'),'bg'=>URL::asset('assets/frontend/images/players/event/bigbox/9.png')],
        ['name'=>'Past Events','title'=>'FIFA Tournament','date'=>'2026-09-13','location'=>'Abu Dhabi, Gulf','type'=>'Physical','winner'=>'Alpha Brokers','stats'=>'Goals: 7-3','image'=>URL::asset('assets/frontend/images/players/event/smallbox/2.png'),'bg'=>URL::asset('assets/frontend/images/players/event/bigbox/2.png')],
        ['name'=>'Past Events','title'=>'FIFA Tournament Virtual','date'=>'2026-10-26','location'=>'Virtual','type'=>'Hybrid','winner'=>'Delta Squad','stats'=>'Top Goals: 45','image'=>URL::asset('assets/frontend/images/players/event/smallbox/10.png'),'bg'=>URL::asset('assets/frontend/images/players/event/bigbox/10.png')],
        ['name'=>'Past Events','title'=>'Tekken Tilt','date'=>'2026-11-12','location'=>'Virtual','type'=>'E-Sports','winner'=>'Beta Prop Firm','stats'=>'Brackets: 32','image'=>URL::asset('assets/frontend/images/players/event/smallbox/11.png'),'bg'=>URL::asset('assets/frontend/images/players/event/bigbox/11.png'),]
   ];
    @endphp

    @foreach($recaps as $recap)
      <article class="event-card" data-type="{{ $recap['type'] }}" data-location="{{ $recap['location'] }}">
        <img class="event-thumb" src="{{ $recap['image'] }}" alt="{{ $recap['title'] }}">
        <div class="event-body">
          <h4>{{ $recap['title'] }}</h4>
          <div class="event-meta">Date: <span class="kv">{{ \Carbon\Carbon::parse($recap['date'])->format('M d, Y') }}</span> | Location: {{ $recap['location'] }} | Type: {{ $recap['type'] }}</div>
          <p>Winner: <strong>{{ $recap['winner'] }}</strong> | Stats: {{ $recap['stats'] }}</p>
          <div class="card-actions">
<a href="{{ url('/detailsEvent') }}?
title={{ urlencode($recap['title']) }}
&name={{ urlencode($recap['name']) }}
&type={{ urlencode($recap['type']) }}
&location={{ urlencode($recap['location']) }}
&date={{ urlencode($recap['date']) }}
&winner={{ urlencode($recap['winner']) }}
&stats={{ urlencode($recap['stats']) }}
&image={{ urlencode($recap['image']) }}
&bg={{ urlencode($recap['bg']) }}"
class="btn btn-primary" >View</a>
          <button class="btn btn-secondar share-btn"
        data-title="{{ $recap['title'] }}"
        data-url="{{ url('/detailsEvent') }}?title={{ urlencode($recap['title']) }}">
    Share
</button>

          </div>
        </div>
      </article>
    @endforeach
  </div>
</section>

<!-- Share Modal -->
<div id="shareModalBox" class="share-modal">
    <div class="share-content">
        <h3 id="shareTitle">Share Event</h3>

       <div class="social-buttons">

    <a id="shareWhatsApp" target="_blank"  w-100 mb-2">
        <i class="bi bi-whatsapp"></i> WhatsApp
    </a>

    <a id="shareFacebook" target="_blank"  w-100 mb-2">
        <i class="bi bi-facebook"></i> Facebook
    </a>

    <a id="shareTwitter" target="_blank"  w-100 mb-2">
        <i class="bi bi-twitter-x"></i> Twitter / X
    </a>

    <a id="shareLinkedIn" target="_blank"  w-100 mb-2 text-white">
        <i class="bi bi-linkedin" style="color: #0077B5;"></i> LinkedIn
    </a>

    <button id="copyLink" class="btn  w-100">
        <i class="bi bi-link-45deg"></i> Copy Link
    </button>

</div>


        <button id="closeShare" class="close-btn">Close</button>
    </div>
</div>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
AOS.init({ duration:800, once:true });

// Filter functionality
document.getElementById('applyFilters').addEventListener('click', ()=>{
  const type = document.getElementById('filterType').value;
  const location = document.getElementById('filterLocation').value;
  
  document.querySelectorAll('#recapGrid .event-card').forEach(card=>{
    const show = (!type || card.dataset.type === type) && (!location || card.dataset.location === location);
    card.style.display = show ? 'flex' : 'none';
  });
});
</script>


<script>
document.addEventListener("DOMContentLoaded", function() {

    const modal = document.getElementById("shareModalBox");
    const closeBtn = document.getElementById("closeShare");

    document.querySelectorAll(".share-btn").forEach(btn => {
        btn.addEventListener("click", function() {

            const title = this.dataset.title;
            const url = this.dataset.url;

            document.getElementById("shareTitle").innerText = "Share: " + title;

            document.getElementById("shareWhatsApp").href =
                "https://wa.me/?text=" + encodeURIComponent(title + " — " + url);

            document.getElementById("shareFacebook").href =
                "https://www.facebook.com/sharer/sharer.php?u=" + encodeURIComponent(url);

            document.getElementById("shareTwitter").href =
                "https://twitter.com/intent/tweet?text=" + encodeURIComponent(title) +
                "&url=" + encodeURIComponent(url);

            document.getElementById("shareLinkedIn").href =
                "https://www.linkedin.com/sharing/share-offsite/?url=" + encodeURIComponent(url);

            document.getElementById("copyLink").onclick = function() {
                navigator.clipboard.writeText(url);
                this.innerText = "Copied!";
                setTimeout(() => this.innerText = "Copy Link", 2000);
            };

            modal.style.display = "flex";
        });
    });

    closeBtn.addEventListener("click", () => modal.style.display = "none");

    window.onclick = (e) => { 
        if(e.target === modal) modal.style.display = "none"; 
    };

});
</script>


@endsection
