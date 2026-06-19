@extends('frontEnd.layouts.master')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
body{
  margin:0;
  font-family:"DM Sans", sans-serif;
  background:#f5f7fa;
  color:#011C32;
}
.hero{
  background: linear-gradient(rgba(0,0,0,0.55), rgba(0,0,0,0.55)), url('{{ asset('assets/frontend/images/banner/network.png') }}') center/cover no-repeat;
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
.cta-center a{ background:#011C32; color:white; padding:12px 30px; border-radius:40px; text-decoration:none; font-weight:700; }
.carousel{ display:flex; gap:20px; overflow-x:auto; scroll-snap-type:x mandatory; padding-bottom:10px; }
.trip-card{ flex:0 0 330px; background: linear-gradient(180deg, #ffffff, #fdf3ed); border-radius:20px; box-shadow:0px 5px 20px rgba(0,0,0,.1); scroll-snap-align:start; transition: transform .4s ease, box-shadow .4s ease; }
.trip-card:hover{ transform: translateY(-6px); box-shadow: 0 10px 25px rgba(0,0,0,.15); }
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
.select-wrap{position:relative;justify-content:center;}
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
    <h1>Networking: Forge Forex Alliances</h1>
    <h3>Connect with Brokers & Traders – Exclusive Bonds Through Sports.</h3>
    <p>Profx Networking builds unbreakable forex connections. Verify your prop firm role to access. Events like cricket mixers or PUBG chats create partnerships. Private industry-only spaces ensure true insider conversations. UAE expos, Gulf gatherings, and India hubs create nonstop connection. Winners network via profxnews.com. Expanding to Cyprus and Hong Kong soon — turn competition into collaboration.</p>
    <a href="{{ url('/membership') }}">Connect</a>
  </div>
</section>

<!-- BENEFITS -->
<section class="section">
  <h2>Build Your Circle</h2>
  <div class="perks">
    <div class="card">
      <h3>Event Mixers</h3>
      <p>Post-match chats that seal deals and spark alliances.</p>
    </div>
    <div class="card">
      <h3>Private Lobbies</h3>
      <p>E-sports voice rooms for strategy talks and group networking.</p>
    </div>
    <div class="card">
      <h3>Global Reach</h3>
      <p>UAE to India — Cyprus & Hong Kong expansion soon.</p>
    </div>
  </div>
  <div class="cta-center">
    <a href="{{ url('/events') }}">See Events</a>
  </div>
</section>

<!-- FEATURED NETWORKS (Swiper.js Premium Carousel) -->
<section class="section">
  <h2>Key Opportunities</h2>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <div class="swiper feeder-swiper">
    <div class="swiper-wrapper">
      <div class="swiper-slide trip-card">
        <img src="{{  URL::asset('assets/frontend/images/players/network/broker.png') }}" alt="Broker Derbies" />
        <div class="body">
          <h4>Broker Derbies</h4>
          <p>Rival teams turn into strategic partners.</p>
          <a href="{{ url('/events') }}">Join Network</a>
        </div>
      </div>
      <div class="swiper-slide trip-card">
        <img src="{{ URL::asset('assets/frontend/images/players/network/e tourney.png') }}" alt="E-Tourney Talks" />
        <div class="body">
          <h4>E-Tourney Talks</h4>
          <p>Squads share insights and elevate skill sets.</p>
          <a href="{{ url('/events') }}">Join Network</a>
        </div>
      </div>
      <div class="swiper-slide trip-card">
        <img src="{{URL::asset('assets/frontend/images/players/network/expo.png')}}" alt="Expo Ties" />
        <div class="body">
          <h4>Expo Ties</h4>
          <p>VIP access for top performers and industry leaders.</p>
          <a href="{{ url('/events') }}">Join Network</a>
        </div>
      </div>
     <div class="swiper-slide trip-card">
        <img src="{{  URL::asset('assets/frontend/images/players/network/broker.png') }}" alt="Broker Derbies" />
        <div class="body">
          <h4>Broker Derbies</h4>
          <p>Rival teams turn into strategic partners.</p>
          <a href="{{ url('/events') }}">Join Network</a>
        </div>
      </div>
      <div class="swiper-slide trip-card">
        <img src="{{ URL::asset('assets/frontend/images/players/network/e tourney.png') }}" alt="E-Tourney Talks" />
        <div class="body">
          <h4>E-Tourney Talks</h4>
          <p>Squads share insights and elevate skill sets.</p>
          <a href="{{ url('/events') }}">Join Network</a>
        </div>
      </div>
      <div class="swiper-slide trip-card">
        <img src="{{URL::asset('assets/frontend/images/players/network/expo.png')}}" alt="Expo Ties" />
        <div class="body">
          <h4>Expo Ties</h4>
          <p>VIP access for top performers and industry leaders.</p>
          <a href="{{ url('/events') }}">Join Network</a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- TESTIMONIALS -->
<section class="section">
  <h2>Connection Stories</h2>
  <div class="testimonials">
    <div class="quote">
      <p>"Landed partnership post-tourney."</p>
      <span>– Faisal M., Abu Dhabi</span>
    </div>
    <div class="quote">
      <p>"Bonds beyond boundaries."</p>
      <span>– Sofia L., India</span>
    </div>
  </div>
  <div class="cta-center">
    <a href="{{ url('/contact') }}">Share</a>
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
  <h2>Suggest Meetup</h2>
  <form class="form-card" method="POST" action="{{ route('networks.networks') }}" >
    @csrf
    <label for="type">Meetup Type</label>
  <div class="select-wrap">
    <select id="type" name="type" required class="form-control form-control-lg form-control-select">
      <option value="">Choose type</option>
      <option value="Cricket Mixer">Cricket Mixer</option>
      <option value="PUBG Lobby">PUBG Lobby</option>
      <option value="Expo Meetup">Expo Meetup</option>
      <option value="Private Meetup">Private Meetup</option>
    </select>
</div>
    <label for="location">Location</label>
    <input type="text" id="location" name="location" placeholder="Enter city or region" required />

    <label for="comments">Comments</label>
    <textarea id="comments" name="comments" placeholder="Any suggestions or special requests..."></textarea>

    <button type="submit">Vote</button>
  </form>
</section>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
const swiper = new Swiper('.feeder-swiper', {
  loop: true,
  slidesPerView: 'auto',
  spaceBetween: 15,
  freeMode: true,
  speed: 4000,         // rolling speed
  autoplay: {
    delay: 0,          // continuous motion
    disableOnInteraction: false,
  },
});

// Stop scrolling on slide click
document.querySelectorAll('.feeder-swiper .swiper-slide').forEach(slide => {
  slide.addEventListener('click', () => {
    swiper.autoplay.stop();
  });
});
</script

@endsection
