@extends('crm.layouts.master')
  @php
        $user = Auth::user();
    @endphp
@section('content')
<div style="background:#f8fafc; min-height:100vh; padding:40px 16px;">

  <div style="max-width:1100px; margin:auto; display:flex; flex-direction:column; gap:40px;">

    <!-- HEADER -->
    <div style="display:flex; flex-wrap:wrap; justify-content:space-between; align-items:center; gap:20px;">
      <h2 style="font-size:42px; font-weight:900; color:#0f172a; margin:0;">
        Account Hub
      </h2>

      <div id="successMsg"
        style="display:none; align-items:center; gap:8px; background:#ecfdf5; color:#16a34a;
        padding:10px 18px; border-radius:999px; font-weight:700; font-size:14px; border:1px solid #bbf7d0;">
        <i data-lucide="check" style="width:18px;height:18px;"></i>
        Changes saved
      </div>
    </div>

    <!-- TABS -->
    <div style="background:#fff; padding:8px; border-radius:18px; display:flex; gap:8px; width:max-content; box-shadow:0 4px 20px rgba(0,0,0,0.05);">
      <button onclick="openTab('profile',this)" class="tabBtn activeTab">Profile</button>
      <button onclick="openTab('security',this)" class="tabBtn">Security</button>
      <!-- <button onclick="openTab('privacy',this)" class="tabBtn">Privacy</button> -->
    </div>

    <!-- CARD -->
    <div style="background:#fff; border-radius:36px; padding:48px; box-shadow:0 30px 80px rgba(0,0,0,0.08);">

      <!-- PROFILE -->
      <div id="profile" class="tabContent">
        <div style="display:flex; gap:32px; align-items:center; border-bottom:1px solid #e5e7eb; padding-bottom:32px;">
          <img src="{{ $user->photo ? url($user->photo) : 'https://avatar.iran.liara.run/public' }}"
               style="width:112px; height:112px; border-radius:50%; object-fit:cover; box-shadow:0 10px 30px rgba(0,0,0,0.15);">
          <div>
            <h3 style="margin:0; font-size:26px; font-weight:900; color:#0f172a;">{{ $user->name }}</h3>
            <p style="margin-top:6px; font-size:12px; font-weight:700; letter-spacing:2px; color:#94a3b8;">
              PLAYER ACCOUNT 
            </p>
          </div>
        </div>

        <div style="margin-top:40px; display:grid; grid-template-columns:repeat(auto-fit,minmax(240px,1fr)); gap:28px;">
          <div>
            <label class="lbl">First Name</label>
            <input class="inp" value="{{ $user->name }}">
          </div>
            <div>
            <label class="lbl">Last Name</label>
            <input class="inp" value="{{ $user->lastname }}">
          </div>
          <div>
            <label class="lbl">Email</label>
            <input class="inp" value="{{ $user->email }}">
          </div>
 <div>
            <label class="lbl">Phone</label>
            <input class="inp" value="{{ $user->phone }}">
          </div>
          <div>
            <label class="lbl">Location</label>
            <input class="inp" value="{{ $user->nationalities }}">
          </div>

        
        </div>
      </div>

      <!-- SECURITY -->
     <!-- SECURITY -->
<div id="security" class="tabContent" style="display:none;">
    <h3 style="font-size:22px; font-weight:900; margin-bottom:24px;">Update Password</h3>
    @if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: '{{ session("success") }}',
        showConfirmButton: false,
        timer: 2000
    });
</script>
@endif
    <form method="POST" action="{{ route('user.update.password') }}" id="passwordForm">
        @csrf
        <div style="max-width:360px; display:flex; flex-direction:column; gap:16px;">
            <input class="inp" type="password" name="current_password" placeholder="Current Password" required>
            <input class="inp" type="password" name="password" placeholder="New Password" required>
            <input class="inp" type="password" name="password_confirmation" placeholder="Confirm Password" required>
        </div>

        <div style="margin-top:40px; background:#fff7ed; padding:24px; border-radius:20px;
            display:flex; justify-content:space-between; align-items:center;">
            <div>
                <strong style="display:block;">Two-Factor Authentication</strong>
                <small style="color:#ea580c; font-weight:700;">Extra Security</small>
            </div>
            <button type="button" class="btnOrange">Enable</button>
        </div>

        <div style="margin-top:48px; display:flex; justify-content:flex-end; gap:16px;">
          <a href="{{ route('crmaccount') }}" class="btnGhost">Reset</a>
            <button type="submit" class="btnPrimary">Update </button>
        </div>
    </form>
</div>


      <!-- PRIVACY -->
      <!-- <div id="privacy" class="tabContent" style="display:none;">
        <h3 style="font-size:22px; font-weight:900; margin-bottom:24px;">Notifications</h3>

        <div class="toggleRow">
          <div>
            <strong>Match Reminders</strong>
            <p>Before your match</p>
          </div>
          <div class="switch on"></div>
        </div>

        <div class="toggleRow">
          <div>
            <strong>Tournament Updates</strong>
            <p>New leagues</p>
          </div>
          <div class="switch on"></div>
        </div>

        <div class="toggleRow">
          <div>
            <strong>Leaderboard Alerts</strong>
            <p>Rank changes</p>
          </div>
          <div class="switch"></div>
        </div>
      </div> -->

      <!-- FOOTER -->
    

    </div>
  </div>
</div>

<script>

function openTab(tab, btn){
  document.querySelectorAll('.tabContent').forEach(t => t.style.display='none');
  document.getElementById(tab).style.display='block';

  document.querySelectorAll('.tabBtn').forEach(b => b.classList.remove('activeTab'));
  btn.classList.add('activeTab');
}

function saveChanges(){
  const msg=document.getElementById('successMsg');
  msg.style.display='flex';
  setTimeout(()=>msg.style.display='none',2500);
}


lucide.createIcons();
</script>

<style>
.tabBtn{
  padding:12px 22px;
  border-radius:14px;
  border:none;
  font-weight:900;
  font-size:12px;
  letter-spacing:1.5px;
  background:transparent;
  cursor:pointer;
  color:#64748b;
}
.activeTab{
  background:#e85a3c;
  color:white;
}
.lbl{
  font-size:11px;
  font-weight:900;
  letter-spacing:2px;
  color:#94a3b8;
}
.inp{
  width:100%;
  padding:14px 18px;
  border-radius:14px;
  border:none;
  background:#f1f5f9;
  font-weight:700;
}
.toggleRow{
  display:flex;
  justify-content:space-between;
  align-items:center;
  padding:20px;
  border-radius:18px;
  border:1px solid #e5e7eb;
  margin-bottom:12px;
}
.switch{
  width:56px;height:30px;background:#cbd5f5;border-radius:999px;padding:4px;
}
.switch::after{
  content:"";display:block;width:22px;height:22px;background:white;border-radius:50%;
}
.switch.on{background:#e85a3c;}
.switch.on::after{transform:translateX(26px);}
.btnPrimary{
  background:#0f172a;color:white;padding:14px 28px;border-radius:16px;font-weight:900;border:none;
}
.btnGhost{
  background:#f1f5f9;color:#64748b;padding:14px 28px;border-radius:16px;font-weight:900;border:none;
}
.btnOrange{
  background:#e85a3c;color:white;padding:10px 22px;border-radius:14px;font-weight:900;border:none;
}
</style>
@endsection
