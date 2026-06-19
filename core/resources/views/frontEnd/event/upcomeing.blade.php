@extends('frontEnd.layouts.master')

@section('content')

<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<style>
/* Container & Hero */
.container { max-width: 1250px; margin: 0 auto; padding: 0 20px; }
.hero-wrap { position: relative; margin: 32px auto; border-radius: 10px; overflow: hidden; padding: 0; }
.hero-bg {
  background-image: linear-gradient(120deg, rgba(51,48,48,0.55), rgba(45,27,27,0.75)), url('{{ asset('assets/frontend/images/players/events/upcomingevent.png') }}');
  background-size: cover;
  background-position: inherit;
  min-height: 550px;
  display: flex;
  align-items: center;
  justify-content: center;
}
.hero-glass {
  width: calc(100% - 40px);
  max-width: 1180px;
  margin: 28px;
  display: grid;
  grid-template-columns: 1fr 380px;
  gap: 28px;
  border-radius: 10px;
  padding: 28px;
  color: #fff;
  align-items: center;
  background: rgba(255,255,255,0.02);
  /* backdrop-filter: blur(12px); */
}
.hero-left h1 { font-family: "Marcellus", serif; font-size: 40px; margin: 0 0 14px; color: #fff; line-height:1.1; }
.hero-left h3 { font-size: 18px; font-weight:400; margin-bottom:14px; color:#fff; }
.hero-left p { font-size:16px; line-height:1.65; margin-bottom:20px;color:#fff; }

/* Buttons */
.btn { border:none; padding:10px 18px; border-radius:999px; font-weight:700; cursor:pointer; display:inline-flex; align-items:center; gap:8px; text-decoration:none; }
.btn-primary { background: linear-gradient(90deg, #ef7e35, #f5362b); color:#fff; box-shadow:0 8px 30px rgba(175,51,54,0.18); }
.btn-secondary { background:transparent; border:1px solid rgba(200,200,200,0.3); color:#fff; }
.btn-outline{background:rgba(255,255,255,0.08);color:white;border:1px solid rgba(255,255,255,0.12)}
.btn-primary:hover, .btn-outline:hover{border: 1px solid #EF7E35;opacity:0.9;transform:translateY(-2px);transition:all .3s ease-in-out}


/* Section Headings */
.section { max-width: 1250px; margin:44px auto; padding:0 20px; color: #333; }
.section h2 { font-family:"Marcellus", serif; font-size:30px; margin-bottom:18px; text-align:center; }

/* Filters */
.filters { 
  display: flex; 
  gap: 16px; 
  flex-wrap: wrap; 
  justify-content: center; 
  margin-bottom: 30px; 
}

.filter { 
  background: rgba(255,255,255,0.9); 
  padding: 12px 16px; 
  border-radius: 0px; 
  border: 0px solid rgba(200,200,200,0.3); 
  /* backdrop-filter: blur(6px);  */
  display: flex; 
  flex-direction: column; 
}

.filter label { 
  font-weight: 600; 
  margin-bottom: 6px; 
  font-size: 14px; 
  color: #333;
}

.select-wrap { 
  position: relative; 
  width: 200px; 
}

/* .select-wrap::after { 
 
  position: absolute; 
  right: 12px; 
  top: 50%; 
  transform: translateY(-50%); 
  pointer-events: none; 
  color: #66788a; 
  font-weight: 700; 
} */

.select { 
  width: 100%; 
  padding: 10px 36px 10px 12px; 
  border: 1px solid #ccc; 
  border-radius: 8px; 
  font-size: 14px; 
  background: #fff; 
  color: #333; 
  appearance: none; 
}

.select:focus { 
  outline: none; 
  border-color: #ef7e35; 
  box-shadow: 0 0 0 2px rgba(239,126,53,0.15); 
}

/* Button */
.filter button { 
  padding: 10px 20px; 
  border-radius: 40px; 
  border: none; 
  font-weight: 700; 
  cursor: pointer; 
  transition: all 0.3s ease; 
}

.filter button:hover { 
  opacity: 0.9; 
}

/* Responsive */
@media(max-width: 600px){ 
  .filters { flex-direction: column; align-items: center; } 
  .select-wrap { width: 100%; } 
  .filter { width: 100%; max-width: 320px; } 
}
/* Event Grid */
.grid { display:grid; gap:20px; grid-template-columns: repeat(auto-fit, minmax(300px,1fr)); }
.event-card { background: linear-gradient(180deg, rgba(255,255,255,0.85), rgba(255,255,255,0.75)); border-radius:14px; overflow:hidden; border:1px solid rgba(200,200,200,0.3); box-shadow:0 8px 30px rgba(150,150,150,0.2); display:flex; flex-direction:column; transition: transform .25s ease, box-shadow .25s ease; }
.event-card:hover { transform: translateY(-8px); box-shadow:0 20px 45px rgba(150,150,150,0.3); }
.event-thumb { width:100%; height:250px; object-fit:inherit; display:block; }
.event-body { padding:14px 16px; display:flex; flex-direction:column; gap:8px; }
.event-meta { font-size:13px; color: rgba(0,0,0,0.7); display:flex; gap:8px; flex-wrap:wrap; }
.kv { font-weight:800; color:#333; }
.card-actions { margin-top:auto; display:flex; gap:8px; justify-content:flex-start; }
.load-more { margin:18px auto; display:block; background: linear-gradient(90deg,#ef7e35,#f5362b); padding:10px 18px; border-radius:12px; border:none; color:#fff; cursor:pointer; }




/* Responsive */
@media(max-width:1100px){ .hero-glass { grid-template-columns:1fr 320px; } }
@media(max-width:860px){ .hero-glass { grid-template-columns:1fr; } }
@media(max-width:480px){ .hero-left h1{ font-size:22px; } .hero-left p{ font-size:14px; } .filters { gap:8px; } }
</style>

@php
$events = [
    [
        'name'     => 'Upcoming Events',
        'title'    => 'Call of Duty Warzone',
        'date'     => '2026-01-14',
        'location' => 'Mumbai, India (Hybrid)',
        'type'     => 'E-Sports',
        'slots'    => 16,
        'cap'      => 97,
        'min'      => 11,
        'image'    => URL::asset('assets/frontend/images/players/event/smallbox/1.png'),
        'bg'       => URL::asset('assets/frontend/images/players/event/bigbox/1.png'),
        'cta'      => 'RSVP Squad',
    ],
    [
        'name'     => 'Upcoming Events',
        'title'    => 'Call of Duty Warzone',
        'date'     => '2026-02-03',
        'location' => 'Dubai, UAE',
        'type'     => 'E-Sports',
        'slots'    => 39,
        'cap'      => 78,
        'min'      => 4,
        'image'    => URL::asset('assets/frontend/images/players/event/smallbox/3.png'),
        'bg'       => URL::asset('assets/frontend/images/players/event/bigbox/3.png'),
        'cta'      => 'Enroll',
    ],
    [
        'name'     => 'Upcoming Events',
        'title'    => 'Cricket Derby',
        'date'     => '2026-03-25',
        'location' => 'Mumbai, India',
        'type'     => 'Physical',
        'slots'    => 42,
        'cap'      => 88,
        'min'      => 4,
        'image'    => URL::asset('assets/frontend/images/players/event/smallbox/9.png'),
        'bg'       => URL::asset('assets/frontend/images/players/event/bigbox/9.png'),
        'cta'      => 'Team Up',
    ],
    [
        'name'     => 'Upcoming Events',
        'title'    => 'FIFA Tournament',
        'date'     => '2026-04-19',
        'location' => 'Mumbai, India',
        'type'     => 'Physical',
        'slots'    => 36,
        'cap'      => 74,
        'min'      => 4,
        'image'    => URL::asset('assets/frontend/images/players/event/smallbox/2.png'),
        'bg'       => URL::asset('assets/frontend/images/players/event/bigbox/2.png'),
        'cta'      => 'Kick Off',
    ],
    [
        'name'     => 'Upcoming Events',
        'title'    => 'Fortnite Royale',
        'date'     => '2026-09-08',
        'location' => 'Mumbai, India (Virtual)',
        'type'     => 'E-Sports',
        'slots'    => 15,
        'cap'      => 66,
        'min'      => 4,
        'image'    => URL::asset('assets/frontend/images/players/event/smallbox/6.png'),
        'bg'       => URL::asset('assets/frontend/images/players/event/bigbox/6.png'),
        'cta'      => 'Drop In',
    ],
    [
        'name'     => 'Upcoming Events',
        'title'    => 'Call of Duty Warzone Squad Battle',
        'date'     => '2026-11-21',
        'location' => 'Virtual',
        'type'     => 'E-Sports',
        'slots'    => 10,
        'cap'      => 83,
        'min'      => 4,
        'image'    => URL::asset('assets/frontend/images/players/event/smallbox/4.png'),
        'bg'       => URL::asset('assets/frontend/images/players/event/bigbox/4.png'),
        'cta'      => 'Queue Up',
    ],
    [
        'name'     => 'Upcoming Events',
        'title'    => 'Chess Championship',
        'date'     => '2026-05-20',
        'location' => 'Bengaluru, India',
        'type'     => 'Indoor',
        'slots'    => 20,
        'cap'      => 40,
        'min'      => 2,
        'image'    => URL::asset('assets/frontend/images/tournaments/chess (1).png'),
        'bg'       => URL::asset('assets/frontend/images/players/event/bigbox/snooker2.jpeg'),
        'cta'      => 'Compete',
    ],
    [
        'name'     => 'Upcoming Events',
        'title'    => 'Snooker Championship',
        'date'     => '2026-06-20',
        'location' => 'Bengaluru, India',
        'type'     => 'Indoor',
        'slots'    => 20,
        'cap'      => 40,
        'min'      => 2,
        'image'    => URL::asset('assets/frontend/images/tournaments/snooker.png'),
        'bg'       => URL::asset('assets/frontend/images/players/event/bigbox/snooker2.jpeg'),
        'cta'      => 'Compete',
    ],
];

@endphp

<!-- HERO -->
<section class="container-fluid">
  <div class="hero-wrap" data-aos="fade-up">
    <div class="hero-bg">
      <div class="hero-glass">
        <div class="hero-left">
          <h1>Upcoming Events: Gear Up for 2026 Glory</h1>
          <h3 style="color:#fff">Detailed Forex Exclusive Tournaments – RSVP Now for Sponsored Spots.</h3>
          <p>Lock in your calendar with Profx's 2026 lineup – survey-voted, fully sponsored events for brokers and prop traders. From virtual Warzone wipes to Mumbai cricket derbies, verify your credentials to claim spots. Min. squads required; logos for branding. UAE/Gulf/India venues; virtual options.</p>
          <div class="hero-ctas">
            <a href="#eventsGrid" class="btn btn-primary">Filter Events</a>
            <a href="/membership" class="btn btn-outline">Register</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- FILTERS & EVENTS -->
<section class="section">
  <h2>2026 Horizon: Full Upcoming Event Breakdown</h2>

  <!--<div class="filters">-->
    <!-- Type Filter -->
  <!--  <div class="filter select-wrap">-->
  <!--    <label for="filterType">Type</label>-->
  <!--    <select id="filterType" class="select form-control">-->
  <!--      <option value="">All Types</option>-->
  <!--      <option value="Physical">Physical</option>-->
  <!--      <option value="E-Sports">E-Sports</option>-->
  <!--    </select>-->
  <!--  </div>-->

    <!-- Location Filter -->
  <!--  <div class="filter select-wrap">-->
  <!--    <label for="filterLocation">Location</label>-->
  <!--    <select id="filterLocation" class="select form-control">-->
  <!--      <option value="">All Locations</option>-->
  <!--      <option value="UAE">UAE</option>-->
  <!--      <option value="Mumbai, India">Mumbai, India</option>-->
  <!--      <option value="Virtual">Virtual</option>-->
  <!--      <option value="Dubai, UAE">Dubai</option>-->
  <!--      <option value="Mumbai, India (Hybrid)">Mumbai Hybrid</option>-->
  <!--      <option value="Mumbai, India (Virtual)">Mumbai Virtual</option>-->
  <!--    </select>-->
  <!--  </div>-->

    <!-- Apply Button -->
  <!--  <div class="filter" style="align-self:flex-end;">-->
  <!--    <button id="applyFilters" class="btn btn-primary">Apply Filters</button>-->
  <!--  </div>-->
  <!--</div>-->

  <!-- Events Grid -->
  <div id="eventsGrid" class="grid">
    @foreach($events as $event)
      <article class="event-card" data-type="{{ $event['type'] }}" data-location="{{ $event['location'] }}" data-date="{{ $event['date'] }}">
        <img class="event-thumb" src="{{ $event['image'] }}" alt="{{ $event['title'] }}">
        <div class="event-body">
          <h4>{{ $event['title'] }}</h4>
          <div class="event-meta">Date: <span class="kv">{{ \Carbon\Carbon::parse($event['date'])->format('M d, Y') }}</span> | Location: {{ $event['location'] }} | Type: {{ $event['type'] }}</div>
          <p>Slots: <strong class="kv">{{ $event['slots'] }}</strong> / <span class="kv">{{ $event['cap'] }}</span>. Min. {{ $event['min'] }} players.</p>
          <div class="card-actions">
<a href="{{ url('/detailsEvent') }}?
title={{ urlencode($event['title']) }}
&type={{ urlencode($event['type']) }}
&location={{ urlencode($event['location']) }}
&date={{ urlencode($event['date']) }}
&min={{ urlencode($event['min']) }}
&cap={{ urlencode($event['cap']) }}
&slots={{ urlencode($event['slots']) }}
&image={{ urlencode($event['image']) }}
&name={{ urlencode($event['name']) }}
&bg={{ urlencode($event['bg']) }}"
class="btn btn-primary" >View</a>          </div>
        </div>
      </article>
    @endforeach
  </div>
</section>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
AOS.init({ duration:800, once:true });

document.getElementById('applyFilters').addEventListener('click', () => {
  const type = document.getElementById('filterType').value;
  const location = document.getElementById('filterLocation').value;

  document.querySelectorAll('#eventsGrid .event-card').forEach(card=>{
    const show = (!type || card.dataset.type === type) && (!location || card.dataset.location === location);
    card.style.display = show ? 'flex' : 'none';
  });
});
</script>

@endsection
