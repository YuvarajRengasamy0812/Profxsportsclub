@extends('frontEnd.layouts.master')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


<style>
body{ margin:0; font-family:"DM Sans", sans-serif; background:#f5f7fa; color:#011C32; }
.hero{ background: linear-gradient(rgba(0,0,0,0.55), rgba(0,0,0,0.55)), url('{{ asset('assets/frontend/images/banner/tournament.png') }}') center/cover no-repeat; padding:120px 20px; text-align:center; color:white; }
.hero h1{ font-size:50px; font-family:"Marcellus", serif; margin-bottom:14px;color: #fff; }
.hero h3{ font-size:22px; margin-bottom:18px; font-weight:400;color: #fff; }
.hero p{ max-width:760px; margin:0 auto 28px; font-size:18px; line-height:1.6;color: #fff; }
.hero a{ background: linear-gradient(90deg, #AF3336 0%, #EF7E35 100%); padding:14px 32px; border-radius:40px; color:white; font-weight:700; text-decoration:none; }
.section{ max-width:1250px; margin:70px auto; padding:0 20px; }
.section h2{ font-family:"Marcellus",serif; font-size:38px; text-align:center; margin-bottom:35px; }
.tabs{ display:flex; gap:15px; justify-content:center; margin-bottom:25px; flex-wrap:wrap; }
.tab-btn{ padding:12px 25px; border-radius:25px; border:none; cursor:pointer; font-weight:700; background:#e5e9f0; transition:0.3s; }
.tab-btn.active{ background: linear-gradient(90deg,#AF3336,#EF7E35); color:white; }
.tab-content{ display:none; }
.tab-content.active{ display:block; }
.tourneys{ display:grid; grid-template-columns:repeat(auto-fit,minmax(280px,1fr)); gap:25px; }
.card{ background:white; border-radius:20px; box-shadow:0 5px 20px rgba(0,0,0,.08); overflow:hidden; transition:transform .3s; }
.card:hover{ transform:translateY(-8px); }
.card img{ width:100%; height:180px; object-fit:cover; }
.card .body{ padding:20px; }
.card h4{ font-size:20px; margin-bottom:10px; }
.card p{ margin-bottom:14px; color:#333; }
.card a{background: linear-gradient(90deg, #AF3336 0%, #EF7E35 100%); color:white; padding:10px 18px; border-radius:8px; text-decoration:none; font-weight:700; }

/* Rules & form row */
.row-flex{display:flex;gap:30px;flex-wrap:wrap;align-items:flex-start;justify-content:space-between}
.col{flex:1 1 48%;min-width:300px}
.rules{background:#fff;padding:22px;border-radius:14px;box-shadow:0 8px 26px rgba(0,0,0,.06)}
.rules ul{padding-left:18px}
.rules li{margin-bottom:10px}

/* Form */
.form-card{background:#fff;padding:22px;border-radius:14px;box-shadow:0 8px 26px rgba(0,0,0,.06)}
.form-card label{display:block;font-weight:700;margin:12px 0 6px}
.form-control{width:100%;padding:12px;border-radius:10px;border:1px solid #d6e0ec;font-size:15px;background:#fff}
.form-control:focus{outline:none;box-shadow:0 0 0 3px rgba(239,126,53,0.08);border-color:var(--accent2)}
.select-wrap{position:relative}
.select-wrap::after{content:"▾";position:absolute;right:14px;top:50%;transform:translateY(-50%);pointer-events:none;color:#66788a;font-weight:700}
.submit-btn{ display: inline-block; background: linear-gradient(90deg, #AF3336 0%, #EF7E35 100%);color:#fff;padding:12px 24px;border-radius:40px;border:none;font-weight:800;cursor:pointer;margin-top:14px}

.rules-title {
  text-align: left;
  margin-bottom: 18px;
  font-family: 'Poppins', sans-serif;
  font-weight: 600;
  font-size: 1.8rem;
  color: #011C32;
}

.rules-list {
  list-style: none;
  padding: 0;
  margin: 0;
}

.rules-list li {
  display: flex;
  align-items: center;
  margin-bottom: 15px;
  padding: 12px 16px;
  background: #f7f9fc;
  border-radius: 10px;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  cursor: pointer;
}

.rules-list li:hover {
  transform: translateY(-4px);
  box-shadow: 0 8px 20px rgba(0,0,0,0.12);
}

.icon-wrap {
  display: flex;
  justify-content: center;
  align-items: center;
  width: 40px;
  height: 40px;
  margin-right: 15px;
  border-radius: 50%;
  color: white;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  position: relative;
}

.icon-wrap.primary { background: #0d6efd; }
.icon-wrap.success { background: #198754; }
.icon-wrap.warning { background: #fd7e14; }
.icon-wrap.danger  { background: #dc3545; }

.rules-list li:hover .icon-wrap {
  transform: scale(1.2);
  box-shadow: 0 4px 12px rgba(0,0,0,0.2);
}

.rules-list li i {
  font-size: 18px;
}

.rules-list li span.icon-wrap::after {
  content: "";
  position: absolute;
  width: 0;
  height: 0;
  border-radius: 50%;
  background: rgba(255,255,255,0.3);
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  transition: width 0.3s ease, height 0.3s ease;
}

.rules-list li:hover span.icon-wrap::after {
  width: 60px;
  height: 60px;
}
@media(max-width:768px){ .hero h1{ font-size:34px; } .hero h3{ font-size:18px; } }
</style>

<!-- HERO -->
<section class="hero">
  <div class="container">
    <h1>Tournaments: Forex-Only Competitions</h1>
    <h3>Sponsored Battles for Brokers & Prop Traders – Join the Fray.</h3>
    <p>Dive into exclusive tournaments tailored for forex pros. Verify credentials to compete in sponsored events like PUBG squads or cricket clashes. Min. 4 players for e-sports; 11 for physical. Weekly surveys decide formats; Profx covers prizes and venues.</p>
    <a href="{{ url('/events') }}">Enter Now</a>
  </div>
</section>

<!-- TOURNAMENT TYPES TABS -->
<section class="section">
  <h2>Tournament Types</h2>
  <div class="tabs">
    <button class="tab-btn active" data-tab="physical">Physical Tourneys</button>
    <button class="tab-btn" data-tab="esports">E-Sports Tourneys</button>
     <button class="tab-btn" data-tab="indoor">Indoor Tourneys</button>
  </div>

  <div id="physical" class="tab-content active">
    <!--<p>Cricket T20s; FIFA matches. Sponsored stadiums.</p>-->
    <div class="tourneys">
      <div class="card">
        <img src="{{ URL::asset('assets/frontend/images/tournaments/1.png') }}" alt="Cricket"/>
        <div class="body">
          <h4>Cricket</h4>
          <p>T20 Matches</p>
          <a href="{{ url('/physicalsports') }}">Details</a>
        </div>
      </div>
      <div class="card">
        <img src="{{ URL::asset('assets/frontend/images/tournaments/2.png') }}" alt="FIFA"/>
        <div class="body">
          <h4>FIFA</h4>
          <p>Stadium Matches</p>
          <a href="{{ url('/physicalsports') }}">Details</a>
        </div>
      </div>
    </div>
  </div>

  <div id="esports" class="tab-content">
    <!--<p>PUBG BRs; Warzone modes. Private lobbies.</p>-->
    <div class="tourneys">
      <div class="card">
        <img src="{{ URL::asset('assets/frontend/images/tournaments/3.png') }}" alt="PUBG"/>
        <div class="body">
          <h4>PUBG</h4>
          <p>Battle Royale</p>
          <a href="{{ url('/esports') }}">Details</a>
        </div>
      </div>
      <div class="card">
        <img src="{{ URL::asset('assets/frontend/images/tournaments/14.png') }}" alt="COD"/>
        <div class="body">
          <h4>COD</h4>
          <p>Warzone Mode</p>
          <a href="{{ url('/esports') }}">Details</a>
        </div>
      </div>
    </div>
  </div>
   <div id="indoor" class="tab-content">
    <!--<p>Snooker;Chess. Private lobbies.</p>-->
    <div class="tourneys">
      <div class="card">
        <img src="{{ URL::asset('assets/frontend/images/tournaments/snooker.png') }}" alt="PUBG"/>
        <div class="body">
          <h4>Snooker</h4>
          <p>BR wins & prizes</p>
          <a href="{{ url('/indoorsports') }}">Details</a>
        </div>
      </div>
      <div class="card">
        <img src="{{ URL::asset('assets/frontend/images/tournaments/chess (1).png') }}" alt="COD"/>
        <div class="body">
          <h4>Chess</h4>
          <p>Strategy & scouts</p>
          <a href="{{ url('/indoorsports') }}">Details</a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- UPCOMING TOURNEYS -->
<section class="section">
  <h2>UpComing Battles</h2>
  <div class="tourneys">
    <div class="card">
      <img src="{{ URL::asset('assets/frontend/images/tournaments/cricket tournment.png') }}" alt="Cricket Tourney"/>
      <div class="body">
        <h4>Cricket Tourney</h4>
        <p>Date: JAN 20 | UAE | Min. 11 squad</p>
        <a href="{{ url('/membership') }}">Register</a>
      </div>
    </div>
    <div class="card">
      <img src="{{ URL::asset('assets/frontend/images/tournaments/4.png') }}" alt="PUBG Clash"/>
      <div class="body">
        <h4>PUBG Clash</h4>
        <p>Date: Every Week Sat | Virtual | Min. 4</p>
        <a href="{{ url('/membership') }}">Register</a>
      </div>
    </div>
    <div class="card">
      <img src="{{ URL::asset('assets/frontend/images/tournaments/football.png') }}" alt="FIFA Final"/>
      <div class="body">
        <h4>FIFA Final</h4>
        <p>Date: Jan 25 | Gulf | Sponsored</p>
        <a href="{{ url('/membership') }}">Register</a>
      </div>
    </div>
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
<section class="section" data-aos="fade-up">
  <div class="row-flex">
   <div class="col">
  <h2 class="rules-title">Play Rules</h2>
  <div class="rules">
    <ul class="rules-list">
      <li>
        <span class="icon-wrap primary">
          <i class="fa fa-check-circle"></i>
        </span>
        Verify forex role / credentials before entry.
      </li>
      <li>
        <span class="icon-wrap success">
          <i class="fa fa-users"></i>
        </span>
        Minimum squad: 4 for e-sports, 11 for physical.
      </li>
      <li>
        <span class="icon-wrap warning">
          <i class="fa fa-id-badge"></i>
        </span>
        Logo DPs required for sponsored participants.
      </li>
      <li>
        <span class="icon-wrap danger">
          <i class="fa fa-lock"></i>
        </span>
        Private lobbies only; public matches disallowed.
      </li>
    </ul>
  </div>
</div>

    <div class="col">
      <h2 style="text-align:left;margin-bottom:18px">Vote Tourney</h2>
      <div class="form-card">
        <form method="POST" action="{{ route('tournaments.tournaments') }}" >
          @csrf

          <label for="type">Type</label>
          <div class="select-wrap">
            <select id="type" name="type" required class="form-control form-control-lg form-control-select">
              <option value="">Select Tournament Type</option>
              <option value="Physical">Physical</option>
              <option value="E-Sports">E-Sports</option>
            </select>
          </div>

          <label for="date">Preferred Date</label>
          <input type="date" id="date" name="date" class="form-control" required />

          <label for="comments">Comments</label>
          <textarea id="comments" name="comments" class="form-control" placeholder="Share thoughts or suggestions..."></textarea>

          <button type="submit" class="submit-btn">Vote</button>
        </form>
      </div>
    </div>
  </div>
</section>

<script>
// Tabs functionality
const tabButtons = document.querySelectorAll('.tab-btn');
const tabContents = document.querySelectorAll('.tab-content');

tabButtons.forEach(btn => {
  btn.addEventListener('click', () => {
    tabButtons.forEach(b => b.classList.remove('active'));
    tabContents.forEach(c => c.classList.remove('active'));
    btn.classList.add('active');
    document.getElementById(btn.dataset.tab).classList.add('active');
  });
});
</script>

@endsection
