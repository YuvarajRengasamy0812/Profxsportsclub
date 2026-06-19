@extends('frontEnd.layouts.master')

@section('content')

<!-- AOS + Swiper -->
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" rel="stylesheet">

<style>




.container { max-width: 1250px; margin: 0 auto; padding: 0 20px; }

.hero-wrap {
  position: relative;
  margin: 32px auto;
  border-radius: 10px;
  overflow: hidden;
  padding: 0;
}

.hero-bg {
  background-image: linear-gradient(120deg, rgba(51, 48, 48, 0.10), rgba(45, 27, 27, 0.20)), url('{{ asset('assets/frontend/images/players/events/event.png') }}');
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
  border-radius: 2px;
  padding: 28px;
  color: var(--text);
  align-items: center;
}

.hero-left {
  display: flex;
  flex-direction: column;
  justify-content: center;
  color: #fff;
}

.hero-left h1 {
  font-family: "Marcellus", serif;
  font-size: 40px;
  margin: 0 0 14px;
  color: #fff;
  line-height: 1.1;
  letter-spacing: -0.5px;
}

.hero-left h3 {
  font-size: 18px;
  font-weight: 400;
  margin: 0 0 14px;
  color: #fff !important;
}

.hero-left p {
  font-size: 16px;
  color: #fff;
  line-height: 1.65;
  margin: 0 0 20px;
}

.hero-ctas {
  display: flex;
  gap: 12px;
  flex-wrap: wrap;
  margin-top: 12px;
}

.btn {
  border: none;
  padding: 10px 18px;
  border-radius: 999px;
  font-weight: 700;
  cursor: pointer;
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  gap: 8px;
}

.btn-primary {
  background: linear-gradient(90deg, var(--accent1), var(--accent2));
  color: #fff;
  box-shadow: 0 8px 30px rgba(175, 51, 54, 0.18);
}

.btn-secondary {
  background: transparent;
  color: var(--text);
  border: 1px solid rgba(200, 200, 200, 0.3);
}

.btn-tertiaryone {
  background: rgba(255, 255, 255, 0.6);
  color: var(--text);
  border: 1px solid rgba(200, 200, 200, 0.3);
}



/* .cal-header { display:flex; justify-content:space-between; align-items:center; margin-bottom:8px; }
.cal-title { font-weight:800; font-size:14px; }
.cal-week { display:grid; grid-template-columns:repeat(7,1fr); gap:6px; font-size:12px; color:rgba(0,0,0,0.6); margin-bottom:6px; text-align:center; }
.cal-grid { display:grid; grid-template-columns:repeat(7,1fr); gap:8px; }
.cal-cell { padding:8px; text-align:center; border-radius:8px; font-weight:700; cursor:pointer; background: transparent; color: var(--text); }
.cal-cell.disabled { color: rgba(0,0,0,0.2); cursor:default; font-weight:600; }
.cal-cell.event { background:#011C32; color:#fff; position:relative; box-shadow: inset 0 -4px 0 rgba(239,126,53,0.14); }
.cal-cell.today { background: linear-gradient(90deg,var(--accent1),var(--accent2)); color: #fff; } */

/* Section Headings */
.section { max-width: 1250px; margin: 44px auto; padding: 0 20px; color: var(--text); }
.section h2 { font-family: "Marcellus", serif; font-size: 30px; margin-bottom: 18px; text-align:center; color: var(--text); }

/* Filters */
.filters {
  display:flex; gap:12px; align-items:center; justify-content:center; flex-wrap:wrap; margin: 12px 0 20px;
}
.filter {
  background: rgba(255,255,255,0.75); padding:10px; border-radius:10px; border:1px solid rgba(200,200,200,0.3); backdrop-filter: blur(6px);
}
.select, .input-date, .search { background: transparent; color: var(--text); border: none; outline:none; font-size:14px; }
.search { min-width:220px; padding-left:12px; }

/* Event Grid */
.grid { display:grid; gap:20px; grid-template-columns: repeat(auto-fit, minmax(300px,1fr)); }
.event-card { background: linear-gradient(180deg, rgba(255,255,255,0.85), rgba(255,255,255,0.75)); border-radius:14px; overflow:hidden; border:1px solid rgba(200,200,200,0.3); box-shadow:0 8px 30px rgba(150,150,150,0.2); display:flex; flex-direction:column; transition: transform .25s ease, box-shadow .25s ease; }
.event-card:hover { transform: translateY(-8px); box-shadow:0 20px 45px rgba(150,150,150,0.3); }
.event-thumb { width:100%; height:250px; object-fit:inherit; display:block; }
.event-body { padding:14px 16px; color: var(--text); display:flex; flex-direction:column; gap:8px; }
.event-meta { font-size:13px; color: rgba(0,0,0,0.7); display:flex; gap:8px; flex-wrap:wrap; }
.kv { color: var(--text); font-weight:800; }
.card-actions { margin-top:auto; display:flex; gap:8px; }
.load-more { margin:18px auto 0; display:block; background: linear-gradient(90deg,var(--accent1),var(--accent2)); padding:10px 18px; border-radius:12px; border:none; color:#fff; cursor:pointer; }

/* Survey */
.form-card { 
  background:#fff; 
  padding:22px; 
  border-radius:14px; 
  box-shadow:0 8px 26px rgba(0,0,0,.06); 
}

.form-card label { 
  display:block; 
  font-weight:700; 
  margin:12px 0 6px; 
}

.form-control { 
  width:100%; 
  padding:12px; 
  border-radius:10px; 
  border:1px solid #d6e0ec; 
  font-size:15px; 
  background:#fff; 
}

.form-control:focus { 
  outline:none; 
  box-shadow:0 0 0 3px rgba(239,126,53,0.08); 
  border-color:var(--accent2); 
}

.select-wrap { 
  position:relative; 
}

.select-wrap::after { 
  content:"▾"; 
  position:absolute; 
  right:14px; 
  top:50%; 
  transform:translateY(-50%); 
  pointer-events:none; 
  color:#66788a; 
  font-weight:700; 
}

.submit-btn { 
  display:inline-block; 
  background: linear-gradient(90deg, var(--accent1), var(--accent2)); 
  color:#fff; 
  padding:12px 24px; 
  border-radius:40px; 
  border:none; 
  font-weight:800; 
  cursor:pointer; 
  margin-top:14px; 
}

/* New layout fixes */
.form-row { 
  margin-bottom:16px; 
}

.radio-group { 
  display:flex; 
  gap:20px; 
  flex-wrap:wrap; 
  align-items:center; 
}

.flex-wrap { 
  display:flex; 
  gap:12px; 
  flex-wrap:wrap; 
}

.flex-item { 
  flex:1; 
  min-width:180px; 
}
/* Swiper */
.swiper { padding:12px 0; }
.swiper-slide img { border-radius:12px; width:100%; height:220px; object-fit:cover; }

@media(max-width: 1100px){ .hero-glass { grid-template-columns: 1fr 320px; } }
@media(max-width: 860px){ .hero-glass { grid-template-columns: 1fr; } .calendar { width:100%; margin-top:8px; } }
@media(max-width:480px){ .hero-left h1{ font-size:22px; } .hero-left p{ font-size:14px; } .filters { gap:8px; } }
</style>

<section class="container-fluid" aria-labelledby="events-hero">
  <div class="hero-wrap" data-aos="fade-up">
    <div class="hero-bg">
      <div class="hero-glass" role="region" aria-label="Events hero panel">
        <div class="hero-left">
          <h1 id="events-hero">2026 Event Lineup – Filter - Join</h1>
          <h3>Exclusive forex pro tournaments and physical matchups.</h3>
          <p>Explore upcoming events for 2026. Use filters to find your match: Type, Location, and Date Range.</p>
        </div>

        <!-- Mini Calendar -->
        <!-- <aside class="calendar" role="application" aria-label="Mini calendar">
          <div class="cal-header">
            <button id="calPrev" class="btn-tertiaryone">&lt;</button>
            <div class="cal-title" id="calTitle" aria-live="polite">Month Year</div>
            <button id="calNext" class="btn-tertiaryone">&gt;</button>
          </div>
          <div class="cal-week" aria-hidden="true">
            <div>Sun</div><div>Mon</div><div>Tue</div><div>Wed</div><div>Thu</div><div>Fri</div><div>Sat</div>
          </div>
          <div class="cal-grid" id="calGrid" role="grid" aria-label="Calendar dates"></div>
        </aside> -->
      </div>
    </div>
  </div>
</section>

<!-- FILTERS -->
<section class="section" data-aos="fade-up" aria-labelledby="filters-title">
  <h2 id="filters-title">2026 Event Lineup </h2>
  <!--<div class="filters" role="region" aria-label="Event filters">-->
  <!--  <div class="filter">-->
      <!--<label>Type</label>-->
  <!--    <select id="filterType" class="select">-->
  <!--      <option value="">Types</option>-->
  <!--      <option value="Physical">Physical</option>-->
  <!--      <option value="E-Sports">E-Sports</option>-->
  <!--    </select>-->
  <!--  </div>-->
  <!--  <div class="filter">-->
      <!--<label>Location</label>-->
  <!--    <select id="filterLocation" class="select">-->
  <!--      <option value="">Locations</option>-->
  <!--      <option value="UAE">UAE</option>-->
  <!--      <option value="Gulf">Gulf</option>-->
  <!--      <option value="India">India</option>-->
  <!--      <option value="Virtual">Virtual</option>-->
  <!--    </select>-->
  <!--  </div>-->
  <!--  <div class="filter">-->
  <!--    <label>From</label>-->
  <!--    <input id="filterFrom" type="date" class="input-date">-->
  <!--  </div>-->
  <!--  <div class="filter">-->
  <!--    <label>To</label>-->
  <!--    <input id="filterTo" type="date" class="input-date">-->
  <!--  </div>-->
  <!--  <div style="align-self:end">-->
  <!--    <button id="applyFilters" class="btn btn-primary">Apply</button>-->
  <!--  </div>-->
  <!--</div>-->

 <div id="eventsGrid" class="grid" aria-live="polite">

    <!-- Event Card 1 -->
    <article class="event-card" data-type="E-Sports" data-location="Virtual" data-date="2026-11-21" data-title="Call of Duty Warzone Squad Battle">
      <img class="event-thumb" src="{{ URL::asset('assets/frontend/images/players/event/smallbox/1.png') }}" alt="Call of Duty Warzone">
      <div class="event-body">
        <h4>Call of Duty Warzone Squad Battle</h4>
        <div class="event-meta">Date: <span class="kv">Nov 21, 2026</span> | Location: Virtual | Type: E-Sports</div>
        <p>Sponsored e-sports frenzy for forex squads. Min. 4 players; logo DPs required. Prizes: Gaming gear + profxnews feature.</p>
        <div class="event-meta">Spots: <strong class="kv">10</strong>/<span class="kv">83</span></div>
        <div class="card-actions">
          <a href="{{ url('/detailsEvent') }}?title=Call+of+Duty+Warzone+Squad+Battle&type=E-Sports&location=Virtual&date=2026-11-21&slots=10&cap=83&image={{ URL::asset('assets/frontend/images/players/event/smallbox/1.png') }}&bg={{ URL::asset('assets/frontend/images/players/event/bigbox/1.png') }}" class="btn btn-primary">Details & RSVP</a>
        </div>
      </div>
    </article>

    <!-- Event Card 2 -->
    <article class="event-card" data-type="Physical" data-location="India" data-date="2026-04-19" data-title="FIFA Tournament">
      <img class="event-thumb" src="{{ URL::asset('assets/frontend/images/players/event/smallbox/2.png') }}" alt="FIFA Tournament">
      <div class="event-body">
        <h4>FIFA Tournament</h4>
        <div class="event-meta">Date: <span class="kv">Apr 19, 2026</span> | Location: Mumbai, India | Type: Physical</div>
        <p>Stadium showdowns for prop trader teams. Min. 4 players; scouts for nationals. Sponsored kits included.</p>
        <div class="event-meta">Spots: <strong class="kv">36</strong>/<span class="kv">74</span></div>
        <div class="card-actions">
          <a href="{{ url('/detailsEvent') }}?title=FIFA+Tournament&type=Physical&location=India&date=2026-04-19&slots=36&cap=74&image={{ URL::asset('assets/frontend/images/players/event/smallbox/2.png') }}&bg={{ URL::asset('assets/frontend/images/players/event/bigbox/2.png') }}" class="btn btn-primary">Details & RSVP</a>
        </div>
      </div>
    </article>

    <!-- Event Card 3 -->
    <article class="event-card" data-type="E-Sports" data-location="India" data-date="2026-01-14" data-title="Call of Duty Warzone - Jan">
      <img class="event-thumb" src="{{ URL::asset('assets/frontend/images/players/event/smallbox/3.png') }}" alt="Call of Duty Warzone January">
      <div class="event-body">
        <h4>Call of Duty Warzone</h4>
        <div class="event-meta">Date: <span class="kv">Jan 14, 2026</span> | Location: Mumbai, India | Type: E-Sports</div>
        <p>High-stakes virtual battles. Min. 11 squad (hybrid); full sponsorship. Rewards: Social shoutouts.</p>
        <div class="event-meta">Spots: <strong class="kv">16</strong>/<span class="kv">97</span></div>
        <div class="card-actions">
          <a href="{{ url('/detailsEvent') }}?title=Call+of+Duty+Warzone+-+Jan&type=E-Sports&location=India&date=2026-01-14&slots=16&cap=97&image={{ URL::asset('assets/frontend/images/players/event/smallbox/3.png') }}&bg={{ URL::asset('assets/frontend/images/players/event/bigbox/3.png') }}" class="btn btn-primary">Details & RSVP</a>
        </div>
      </div>
    </article>

    <!-- Event Card 4 -->
    <article class="event-card" data-type="E-Sports" data-location="UAE" data-date="2026-02-03" data-title="Call of Duty Warzone - Feb">
      <img class="event-thumb" src="{{ URL::asset('assets/frontend/images/players/event/smallbox/3.png') }}" alt="Call of Duty Warzone February">
      <div class="event-body">
        <h4>Call of Duty Warzone</h4>
        <div class="event-meta">Date: <span class="kv">Feb 03, 2026</span> | Location: Dubai, UAE | Type: E-Sports</div>
        <p>Gulf edition e-tournaments. Min. 4 players; private lobbies. Prizes: Expo VIP passes.</p>
        <div class="event-meta">Spots: <strong class="kv">39</strong>/<span class="kv">78</span></div>
        <div class="card-actions">
          <a href="{{ url('/detailsEvent') }}?title=Call+of+Duty+Warzone+-+Feb&type=E-Sports&location=UAE&date=2026-02-03&slots=39&cap=78&image={{ URL::asset('assets/frontend/images/players/event/smallbox/3.png') }}&bg={{ URL::asset('assets/frontend/images/players/event/bigbox/3.png') }}" class="btn btn-primary">Details & RSVP</a>
        </div>
      </div>
    </article>

    <!-- Event Card 5 -->
    <article class="event-card" data-type="Physical" data-location="India" data-date="2026-03-25" data-title="Cricket Derby">
      <img class="event-thumb" src="{{ URL::asset('assets/frontend/images/players/event/smallbox/9.png') }}" alt="Cricket Derby">
      <div class="event-body">
        <h4>Cricket Derby</h4>
        <div class="event-meta">Date: <span class="kv">Mar 25, 2026</span> | Location: Mumbai, India | Type: Physical</div>
        <p>Inter-firm T20 clash. Min. 4 players (scalable); logo jerseys. National trial pathway.</p>
        <div class="event-meta">Spots: <strong class="kv">42</strong>/<span class="kv">88</span></div>
        <div class="card-actions">
          <a href="{{ url('/detailsEvent') }}?title=Cricket+Derby&type=Physical&location=India&date=2026-03-25&slots=42&cap=88&image={{ URL::asset('assets/frontend/images/players/event/smallbox/9.png') }}&bg={{ URL::asset('assets/frontend/images/players/event/bigbox/9.png') }}" class="btn btn-primary">Details & RSVP</a>
        </div>
      </div>
    </article>

    <!-- Event Card 6 -->
    <article class="event-card" data-type="E-Sports" data-location="India" data-date="2026-09-08" data-title="Fortnite Royale">
      <img class="event-thumb" src="{{ URL::asset('assets/frontend/images/players/event/smallbox/6.png') }}" alt="Fortnite Royale">
      <div class="event-body">
        <h4>Fortnite Royale</h4>
        <div class="event-meta">Date: <span class="kv">Sep 08, 2026</span> | Location: Mumbai, India | Type: E-Sports</div>
        <p>Build-and-battle for traders. Min. 4 squad; sponsored servers. Win profxnews immortality.</p>
        <div class="event-meta">Spots: <strong class="kv">15</strong>/<span class="kv">66</span></div>
        <div class="card-actions">
          <a href="{{ url('/detailsEvent') }}?title=Fortnite+Royale&type=E-Sports&location=India&date=2026-09-08&slots=15&cap=66&image={{ URL::asset('assets/frontend/images/players/event/smallbox/6.png') }}&bg={{ URL::asset('assets/frontend/images/players/event/bigbox/6.png') }}" class="btn btn-primary">Details & RSVP</a>
        </div>
      </div>
    </article>
    <!-- Event Card 5 - Snooker Match -->
<article class="event-card" data-type="Indoor" data-location="India" data-date="2026-04-15" data-title="Snooker Championship">
  <img class="event-thumb" src="{{ URL::asset('assets/frontend/images/tournaments/snooker.png') }}" alt="Snooker Championship">
  <div class="event-body">
    <h4>Snooker Championship</h4>
    <div class="event-meta">Date: <span class="kv">Apr 15, 2026</span> | Location: Delhi, India | Type: Indoor</div>
    <p>Inter-firm snooker showdown. Minimum 2 players per match; private tables; sponsored cues allowed.</p>
    <div class="event-meta">Spots: <strong class="kv">16</strong>/<span class="kv">32</span></div>
    <div class="card-actions">
      <a href="{{ url('/detailsEvent') }}?title=Snooker+Championship&type=Indoor&location=India&date=2026-04-15&slots=16&cap=32&image={{ URL::asset('assets/frontend/images/players/event/smallbox/snooker.png') }}&bg={{ URL::asset('assets/frontend/images/players/event/bigbox/snooker.jpeg') }}" class="btn btn-primary">Details & RSVP</a>
    </div>
  </div>
</article>
<article class="event-card" data-type="Indoor" data-location="India" data-date="2026-06-20" data-title="Snooker Invitational">
  <img class="event-thumb" src="{{ URL::asset('assets/frontend/images/tournaments/chess (1).png') }}" alt="Snooker Invitational">
  <div class="event-body">
    <h4>Chess Championship</h4>
    <div class="event-meta">Date: <span class="kv">May 20, 2026</span> | Location: Bengaluru, India | Type: Indoor</div>
    <p>Elite inter-firm Chess challenge. Private tables, min. 2 players; compete for trophies and prizes.</p>
    <div class="event-meta">Spots: <strong class="kv">20</strong>/<span class="kv">40</span></div>
    <div class="card-actions">
      <a href="{{ url('/detailsEvent') }}?title=Chess+Championship&type=Indoor&location=India&date=2026-06-20&slots=20&cap=40&image={{ URL::asset('assets/frontend/images/players/event/smallbox/snooker2.png') }}&bg={{ URL::asset('assets/frontend/images/players/event/bigbox/snooker2.jpeg') }}" class="btn btn-primary">Details & RSVP</a>
    </div>
  </div>
</article>
<!-- Event Card 6 - Snooker Invitational -->
<article class="event-card" data-type="Indoor" data-location="India" data-date="2026-06-20" data-title="Snooker Invitational">
  <img class="event-thumb" src="{{ URL::asset('assets/frontend/images/tournaments/snooker.png') }}" alt="Snooker Invitational">
  <div class="event-body">
    <h4>Snooker Championship</h4>
    <div class="event-meta">Date: <span class="kv">Jun 20, 2026</span> | Location: Bengaluru, India | Type: Indoor</div>
    <p>Elite inter-firm snooker challenge. Private tables, min. 2 players; compete for trophies and prizes.</p>
    <div class="event-meta">Spots: <strong class="kv">20</strong>/<span class="kv">40</span></div>
    <div class="card-actions">
      <a href="{{ url('/detailsEvent') }}?title=Snooker+Championship&type=Indoor&location=India&date=2026-06-20&slots=20&cap=40&image={{ URL::asset('assets/frontend/images/players/event/smallbox/snooker2.png') }}&bg={{ URL::asset('assets/frontend/images/players/event/bigbox/snooker2.jpeg') }}" class="btn btn-primary">Details & RSVP</a>
    </div>
  </div>
</article>


</div>


  <!--<div style="text-align:center; margin-top:18px;">-->
  <!--  <button id="loadMore" class="load-more">Load more</button>-->
  <!--</div>-->
</section>

<!-- SURVEY SECTION -->
<section class="section" data-aos="fade-up" id="surveySection">
  <h2>Shape 2026: Vote Your Event</h2>
  <div class="form-card" role="form">
    <form id="eventSurveyForm">
      
      <!-- Event Type -->
      <div class="form-row">
        <label>Event Type*</label>
        <div class="radio-group">
          <label><input type="radio" name="etype" value="Physical" required> Physical</label>
          <label><input type="radio" name="etype" value="E-Sports"> E-Sports</label>
           <label><input type="radio" name="etype" value="indoor" required> Indoor Games</label>
        </div>
      </div>

      <!-- Specific Sport/Game -->
      <div class="form-row">
        <label>Specific Sport/Game*</label>
        <div class="select-wrap">
          <select name="sport" class="form-control" required>
            <option value="">Select a game</option>
            <optgroup label="Physical">
              <option value="Cricket">Cricket</option>
              <option value="FIFA">FIFA</option>
            </optgroup>
            <optgroup label="E-Sports">
              <option value="PUBG">PUBG</option>
              <option value="Warzone">Warzone</option>
              <option value="Fortnite">Fortnite</option>
            </optgroup>
            <optgroup label="indoor">
              <option value="chess">Chess</option>
              <option value="snooker">Snooker</option>
            </optgroup>
          </select>
        </div>
      </div>

      <!-- Preferred Month -->
      <div class="form-row">
        <label>Preferred Month*</label>
        <div class="select-wrap">
          <select name="month" class="form-control" required>
            @for($m=1;$m<=12;$m++)
              <option value="{{ $m }}">{{ DateTime::createFromFormat('!m', $m)->format('F') }}</option>
            @endfor
          </select>
        </div>
      </div>

      <!-- Location and Squad Size -->
      <div class="form-row flex-wrap">
        <div class="flex-item">
          <label>Location*</label>
          <select name="locations[]" multiple class="form-control form-control-lg form-control-select" required>
            <option value="UAE">UAE</option>
            <option value="Gulf">Gulf</option>
            <option value="India">India</option>
            <option value="Virtual">Virtual</option>
          </select>
        </div>
        <div class="flex-item">
          <label>Squad Size</label>
          <input type="number" name="size" class="form-control" min="1" max="50" placeholder="e.g., 4">
        </div>
      </div>

      <button type="submit" class="submit-btn">Vote</button>
    </form>
  </div>
</section>

<!-- Sponsorship Guide -->
<section class="section" data-aos="fade-up" aria-labelledby="sponsor-title">
  <h2 id="sponsor-title">Sponsorship Opportunities</h2>
  <div class="guide">
    <div class="infographic" role="img" aria-label="Sponsorship infographic">
           <img class="event-thumb" src="{{ URL::asset('assets/frontend/images/tournaments/4.png') }}" alt="FIFA Tournament">

    </div>
    <div>
      <p>Partner with prop trading tournaments in 2026. Gain visibility in physical & virtual events across UAE, Gulf, India.</p>
      <p>Contact: <a href="mailto:events@profxnews.com">events@profxnews.com</a></p>
    </div>
  </div>
</section>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script>
// Initialize AOS
AOS.init({ duration:800, once:true });

// Example Filter Logic
document.getElementById('applyFilters').addEventListener('click', () => {
  const type = document.getElementById('filterType').value;
  const location = document.getElementById('filterLocation').value;
  const from = document.getElementById('filterFrom').value;
  const to = document.getElementById('filterTo').value;

  document.querySelectorAll('#eventsGrid .event-card').forEach(card=>{
    const cType = card.dataset.type;
    const cLocation = card.dataset.location;
    const cDate = card.dataset.date;
    let show=true;
    if(type && cType!==type) show=false;
    if(location && cLocation!==location) show=false;
    if(from && cDate<from) show=false;
    if(to && cDate>to) show=false;
    card.style.display = show ? 'flex' : 'none';
  });
});

// Load More button placeholder
document.getElementById('loadMore').addEventListener('click', () => {
  alert('Load more events placeholder');
});
</script>

@endsection
