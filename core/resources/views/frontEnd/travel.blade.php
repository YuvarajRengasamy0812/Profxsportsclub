@extends('frontEnd.layouts.master')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
/* --- scoped CSS for Travel Club Blade page --- */
body{
  margin:0;
  font-family:"DM Sans", sans-serif;
  background:#f5f7fa;
  color:#011C32;
}
.hero{
  background:url('{{ asset('assets/frontend/images/banner/travel.png') }}') center/cover no-repeat;
  padding:120px 20px;
  text-align:center;
  color:white;
}
.hero h1{ font-size:50px; font-family:"Marcellus", serif; margin-bottom:14px;color:#fff }
.hero h3{ font-size:22px; margin-bottom:18px; font-weight:400;color:#fff }
.hero p{ max-width:760px; margin:0 auto 28px; font-size:18px; line-height:1.6;color:#fff }
.hero a{ background:linear-gradient(90deg,#AF3336,#EF7E35); padding:14px 32px; border-radius:40px; color:white; font-weight:700; text-decoration:none; }
.section{ max-width:1250px; margin:70px auto; padding:0 20px; }
.section h2{ font-family:"Marcellus",serif; font-size:38px; text-align:center; margin-bottom:35px; }
.perks{ display:grid; grid-template-columns:repeat(auto-fit,minmax(300px,1fr)); gap:28px; }
.card{ background:white; padding:28px; border-radius:20px; box-shadow:0px 5px 20px rgba(0,0,0,.08); text-align:center; }
.card h3{ font-size:22px; margin-bottom:10px; }
.card p{ color:#333; line-height:1.5; }
.cta-center{ text-align:center; margin-top:25px; }
.cta-center a{ background:#011C32; color:white; padding:12px 30px; border-radius:40px; font-weight:700; text-decoration:none; }
.carousel{ display:flex; justify-content:center; gap:20px; overflow-x:auto; scroll-snap-type:x mandatory; padding-bottom:10px; }
.trip-card{ flex:0 0 330px; background:white; border-radius:20px; box-shadow:0px 5px 20px rgba(0,0,0,.1); scroll-snap-align:start; }
.trip-card img{ width:100%; height:190px; border-radius:20px 20px 0 0; object-fit:cover; }
.trip-card .body{ padding:20px; }
.trip-card h4{ font-size:20px; margin-bottom:8px; }
.trip-card p{ margin-bottom:16px; color:#333; }
.trip-card a{ background:#EF7E35; color:white; padding:10px 18px; border-radius:8px; text-decoration:none; font-weight:700; }
.testimonials{ display:grid; grid-template-columns:repeat(auto-fit,minmax(350px,1fr)); gap:25px; }
.quote{ background:white; padding:28px; border-radius:20px; box-shadow:0px 4px 18px rgba(0,0,0,.08); }
.quote p{ font-style:italic; margin-bottom:12px; font-size:17px; }
.quote span{ font-weight:700; color:#AF3336; font-size:15px; }
.form-card{ background:white; padding:32px; border-radius:20px; box-shadow:0 5px 20px rgba(0,0,0,.08); max-width:650px; margin:0 auto; }
label{ font-weight:600; margin:15px 0 6px; display:block; }
select,input,textarea{ width:100%; padding:12px; border-radius:12px; border:1px solid #ccd3df; font-size:15px; background:white; }
textarea{ min-height:130px; }
.select-wrap{position:relative}
.select-wrap::after{position:absolute;right:14px;top:50%;transform:translateY(-50%);pointer-events:none;color:#66788a;font-weight:700}
.form-card{background:#fff;padding:22px;border-radius:14px;box-shadow:0 8px 26px rgba(0,0,0,.06)}
.form-card label{display:block;font-weight:700;margin:12px 0 6px}
.form-control{width:100%;padding:12px;border-radius:10px;border:1px solid #d6e0ec;font-size:15px;background:#fff}
.form-control:focus{outline:none;box-shadow:0 0 0 3px rgba(239,126,53,0.08);border-color:var(--accent2)}
button{ background:linear-gradient(90deg,#AF3336,#EF7E35); color:white; padding:13px 30px; border:none; border-radius:40px; font-size:17px; font-weight:700; margin-top:20px; cursor:pointer; }
@media (max-width:768px){ .hero{ padding:80px 16px; } .hero h1{ font-size:34px; } }
</style>

<!-- HERO -->
<section class="hero">
  <div class="container">
    <h1>Travel Club: Forex Journeys Sponsored</h1>
    <h3>Exclusive Trips for Industry Pros – Network on the Move.</h3>
    <p>Profx Travel Club offers sponsored travel for forex elites. Verify brokerage ties to join free. Attend events in UAE stadiums, Gulf gyms and India fields. Transport for company squads covered. National trials include trips; surveys pick destinations. Expand to Cyprus beaches and Hong Kong fintech hubs. Bond over journeys — winners get expo travel perks.</p>
    <a href="{{ url('/membership') }}">Join Travel</a>
  </div>
</section>

<!-- PERKS -->
<section class="section">
  <h2>Why Travel with Us</h2>
  <div class="perks">
    <div class="card">
      <h3>Sponsored Trips</h3>
      <p>Venues and transportation covered for approved events and team travel.</p>
    </div>
    <div class="card">
      <h3>Forex Networking</h3>
      <p>Mix with pros en route — deals and partnerships formed while traveling.</p>
    </div>
    <div class="card">
      <h3>Expansion Destinations</h3>
      <p>UAE / Gulf / India now; Cyprus & Hong Kong launching soon.</p>
    </div>
  </div>
  <div class="cta-center">
    <a href="{{ url('/events') }}">See Events</a>
  </div>
</section>

<!-- FEATURED TRIPS -->
<section class="section">
  <h2>Upcoming Travels</h2>
  <div class="carousel">

    <div class="trip-card">
      <img src="{{ URL::asset('assets/frontend/images/players/travels/1.png') }}" alt="Dubai Derby"/>
      <div class="body">
        <h4>Dubai Derby Trip</h4>
        <p>Sponsored travel to UAE stadium events.</p>
        <a href="{{ url('/events/upcoming') }}">Book Spot</a>
      </div>
    </div>

    <div class="trip-card">
      <img src="{{ URL::asset('assets/frontend/images/players/travels/mumbai.png') }}" alt="Mumbai Match"/>
      <div class="body">
        <h4>Mumbai Match Journey</h4>
        <p>India field events with full team transport.</p>
        <a href="{{ url('/events/upcoming') }}">Book Spot</a>
      </div>
    </div>

    <div class="trip-card">
      <img src="{{ URL::asset('assets/frontend/images/players/travels/abu dhabi.png') }}" alt="Gulf Gaming"/>
      <div class="body">
        <h4>Gulf Gaming Getaway</h4>
        <p>Abu Dhabi sponsored e-sports & fintech events.</p>
        <a href="{{ url('/events/upcoming') }}">Book Spot</a>
      </div>
    </div>

  </div>
</section>

<!-- TESTIMONIALS -->
<section class="section">
  <h2>Traveler Tales</h2>
  <div class="testimonials">
    <div class="quote">
      <p>"Sponsored trips built bonds."</p>
      <span>– Karim A., Dubai</span>
    </div>
    <div class="quote">
      <p>"Networking on the go."</p>
      <span>– Anika P., Mumbai</span>
    </div>
  </div>
  <div class="cta-center">
    <a href="{{ url('/contact') }}">Share Story</a>
  </div>
</section>
 @if(session('success'))

        <?php    echo '1';
        ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
                confirmButtonText: 'OK'
            });
        </script>
    @endif

    @if(session('error'))

        <?php    echo '3';
        ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '{{ session('error') }}',
                confirmButtonText: 'OK'
            });
        </script>
    @endif
<!-- SURVEY FORM -->
<section class="section">
  <h2>Pick Destination</h2>
  <form class="form-card" method="POST" action="{{ route('travels.travels') }}" >
    @csrf
    <label for="location">Location</label>
      <div class="select-wrap">
    <select id="location" name="location" required class="form-control form-control-lg form-control-select">
      <option value="">Choose a destination</option>
      <option value="Dubai">Dubai</option>
      <option value="Abu Dhabi">Abu Dhabi</option>
      <option value="Mumbai">Mumbai</option>
      <option value="Cyprus">Cyprus</option>
      <option value="Hong Kong">Hong Kong</option>
    </select>
</div>
    <label for="date">Preferred Date</label>
    <input type="date" id="date" name="date" required />

    <label for="comments">Comments</label>
    <textarea id="comments" name="comments" placeholder="Share thoughts or special requests..."></textarea>

    <label for="email">Email (so we can contact you)</label>
    <input type="email" id="email" name="email" required />

    <button type="submit">Submit</button>
  </form>
</section>

@push('scripts')
<script>
// Small UX: smooth scroll for carousel on card click (optional)
document.querySelectorAll('.trip-card a').forEach(a=>{
  a.addEventListener('click', (e)=>{
    // allow default navigation to booking page — nothing else required here
  });
});
</script>
@endpush

@endsection

<!-- Integration notes:
  1) Put hero and trip images in public/images/ (e.g. travel-hero.jpg, dubai-derby.jpg)
  2) Add route in routes/web.php: Route::post('/travel/survey', '[YourController]@submitSurvey')->name('travel.survey.submit');
  3) Example controller logic: validate request, store or email, then redirect back with success.
-->
