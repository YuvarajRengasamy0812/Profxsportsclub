<style>
    @media (min-width: 766px) and (max-width: 992px) {
  .usermenu-dashboard {
    display: none !important;
  }
}

</style>

<div class="col-md-2 px-0 h-100  shadow-sm sidebar usermenu-dashboard" id="sidebar">
	<!-- <h1 class="bi bi-bootstrap text-primary d-flex my-4 justify-content-center"></h1> -->
	<div class="list-group sidebar-content">
		<a href="{{ route('user.dashboard') }}" class="list-group-item list-group-item-action border-0 d-flex align-items-center {{ Route::is('user.dashboard') ? 'active' : '' }}">
			<span class="bi bi-border-all"></span>
			<span class="ms-2">Dashboard</span>
		</a>
		
		@php
			$tournmentSectionOpen = Route::is('user.listleague') && in_array(request()->listing, ['active', 'upcoming', 'expired']);
		@endphp
		<button class="list-group-item list-group-item-action border-0 d-flex justify-content-between align-items-center"
				data-bs-toggle="collapse"
				data-bs-target="#salecollapsetour"
				aria-expanded="{{ $tournmentSectionOpen ? 'true' : 'false' }}">
			<div>
				<span class="bi bi-person-circle"></span>
				<span class="ms-2">Tournaments</span>
			</div>
			<span class="bi bi-chevron-down small {{ $tournmentSectionOpen ? 'rotate' : '' }}"></span>
		</button>
		
		<div class="collapse {{ $tournmentSectionOpen ? 'show' : '' }}" id="salecollapsetour" data-bs-parent="#sidebar">
			<div class="list-group">
				<a href="{{ route('user.listleague', ['listing' => 'active']) }}" class="list-group-item list-group-item-action border-0 ps-4 {{ request()->routeIs('user.listleague') && request()->listing == 'active' ? 'active' : '' }}">
					<div>
						<span class="bi bi-arrow-counterclockwise"></span>
						<span class="ms-1">Active League</span>
					</div>
				</a>
				<a href="{{ route('user.listleague', ['listing' => 'upcoming']) }}" class="list-group-item list-group-item-action border-0 ps-4 {{ request()->routeIs('user.listleague') && request()->listing == 'upcoming' ? 'active' : '' }}">
					<div>
						<span class="bi bi-alarm"></span>
						<span class="ms-1">Upcoming League</span>
					</div>
				</a>
				<a href="{{ route('user.listleague', ['listing' => 'expired']) }}" class="list-group-item list-group-item-action border-0 ps-4 {{ request()->routeIs('user.listleague') && request()->listing == 'expired' ? 'active' : '' }}">
					<div>
						<span class="bi bi-arrow-clockwise"></span>
						<span class="ms-1">Expired League</span>
					</div>
				</a>
			</div>
		</div>
		
		<a href="{{ route('user.myleague') }}" class="list-group-item list-group-item-action border-0 align-items-center {{ Route::is('user.myleague') ? 'active' : '' }}">
			<span class="bi bi-trophy"></span>
			<span class="ms-2">My League</span>
		</a>
		<a href="{{ route('user.wallet') }}" class="list-group-item list-group-item-action border-0 align-items-center {{ Route::is('user.wallet') ? 'active' : '' }}">
			<span class="bi bi-wallet2"></span>
			<span class="ms-2">ProFX Wallet</span>
		</a>
		<a href="{{ route('user.leaderboard') }}" class="list-group-item list-group-item-action border-0 align-items-center {{ Route::is('user.leaderboard') ? 'active' : '' }}">
			<span class="bi bi-graph-up"></span>
			<span class="ms-2">Leader Board</span>
		</a>
		<a href="{{ route('user.announcements') }}" class="list-group-item list-group-item-action border-0 align-items-center {{ Route::is('user.announcements') ? 'active' : '' }}">
			<span class="bi bi-megaphone"></span>
			<span class="ms-2">Announcements</span>
		</a>
		<!--<a href="{{ route('user.leaderresult') }}" class="list-group-item list-group-item-action border-0 align-items-center {{ Route::is('user.leaderresult') ? 'active' : '' }}">-->
		<!--	<span class="bi bi-clipboard-data"></span>-->
		<!--	<span class="ms-2">League Results</span>-->
		<!--</a>-->
		
		@php
			$referralSectionOpen = Route::is('user.referral') || Route::is('user.referred') || Route::is('user.referralearning');
		@endphp
		
		<button class="list-group-item list-group-item-action border-0 d-flex justify-content-between align-items-center " data-bs-toggle="collapse" data-bs-target="#salecollapsere" aria-expanded="{{ $referralSectionOpen ? 'true' : 'false' }}" >
			<div>
				<span class="bi bi-people"></span>
				<span class="ms-2">Referral & Earn</span>
			</div>
			<span class="bi bi-chevron-down small {{ $referralSectionOpen ? 'rotate' : '' }}"></span>
		</button>
		<div class="collapse {{ $referralSectionOpen ? 'show' : '' }}" id="salecollapsere" data-bs-parent="#sidebarre">
			<div class="list-group">
				<a href="{{ route('user.referral') }}" class="list-group-item list-group-item-action border-0 ps-4 {{ Route::is('user.referral') ? 'active' : '' }}">
					<div>
						<span class="bi bi-code"></span>
						<span class="ms-1">Referral</span>
					</div>
				</a>
				<a href="{{ route('user.referred') }}" class="list-group-item list-group-item-action border-0 ps-4 {{ Route::is('user.referred') ? 'active' : '' }}">
					<div>
						<span class="bi bi-sliders"></span>
						<span class="ms-1">Referred</span>
					</div>
				</a>
				<a href="{{ route('user.referralearning') }}" class="list-group-item list-group-item-action border-0 ps-4 {{ Route::is('user.referralearning') ? 'active' : '' }}">
					<div>
						<span class="bi bi-wallet-fill"></span>
						<span class="ms-1">Earning</span>
					</div>
				</a>
			</div>
		</div>
		
		
		@php
			$accountSectionOpen = request()->routeIs('user.profile') 
							|| request()->routeIs('user.kyc') 
							|| request()->routeIs('user.security') 
							|| request()->routeIs('user.bankdetail');
			@endphp

			<!-- Parent Button -->
			<button class="list-group-item list-group-item-action border-0 d-flex justify-content-between align-items-center"
					data-bs-toggle="collapse"
					data-bs-target="#salecollapse"
					aria-expanded="{{ $accountSectionOpen ? 'true' : 'false' }}">
				<div>
					<span class="bi bi-person-circle"></span>
					<span class="ms-2">Account</span>
				</div>
				<span class="bi bi-chevron-down small {{ $accountSectionOpen ? 'rotate' : '' }}"></span>
			</button>

			<!-- Collapsible Menu -->
			<div class="collapse {{ $accountSectionOpen ? 'show' : '' }}" id="salecollapse" data-bs-parent="#sidebar">
				<div class="list-group">
					<a href="{{ route('user.profile') }}" 
					class="list-group-item list-group-item-action border-0 ps-4 {{ request()->routeIs('user.profile') ? 'active' : '' }}">
						<div>
							<span class="bi bi-person-lines-fill"></span>
							<span class="ms-1">Profile</span>
						</div>
					</a>

					<a href="{{ route('user.kyc') }}" 
					class="list-group-item list-group-item-action border-0 ps-4 {{ request()->routeIs('user.kyc') ? 'active' : '' }}">
						<div>
							<span class="bi bi-shield-check"></span>
							<span class="ms-1">KYC</span>
						</div>
					</a>

					<a href="{{ route('user.security') }}" 
					class="list-group-item list-group-item-action border-0 ps-4 {{ request()->routeIs('user.security') ? 'active' : '' }}">
						<div>
							<span class="bi bi-shield-lock-fill"></span>
							<span class="ms-1">Security</span>
						</div>
					</a>

					<a href="{{ route('user.bankdetail') }}" 
					class="list-group-item list-group-item-action border-0 ps-4 {{ request()->routeIs('user.bankdetail') ? 'active' : '' }}">
						<div>
							<span class="bi bi-credit-card"></span>
							<span class="ms-1">Bankdetails</span>
						</div>
					</a>
                    <a href="{{ route('user.cryptowallet') }}" class="list-group-item list-group-item-action border-0 ps-4 {{ request()->routeIs('user.cryptowallet') ? 'active' : '' }}">
                        <div>
                            <span class="bi bi-wallet2"></span>
                            <span class="ms-1">Crypto Wallet</span>
                        </div>
                    </a>
				</div>
			</div>
		@php
            $certificateSectionOpen = Route::is('user.registration.certificate') || Route::is('user.leaguecertificate');
        @endphp
        @if(!empty(Auth::user()->certificate_path))

        <button class="list-group-item list-group-item-action border-0 d-flex justify-content-between align-items-center"
            data-bs-toggle="collapse"
            data-bs-target="#salecertificate"
            aria-expanded="{{ $certificateSectionOpen ? 'true' : 'false' }}">
            <div>
                <span class="bi bi-award"></span>
                <span class="ms-2">Certificate</span>
            </div>
            <span class="bi bi-chevron-down small {{ $certificateSectionOpen ? 'rotate' : '' }}"></span>
        </button>

        <div class="collapse {{ $certificateSectionOpen ? 'show' : '' }}" id="salecertificate" data-bs-parent="#sidebar">
            <div class="list-group">
                <a href="{{ route('user.registration.certificate') }}" class="list-group-item list-group-item-action border-0 ps-4 {{ Route::is('user.registration.certificate') ? 'active' : '' }}">
                    <div>
                        <span class="bi bi-file-earmark-text"></span>
                        <span class="ms-1">Registration Certificate</span>
                    </div>
                </a>
                <a href="{{ route('user.leaguecertificate') }}" class="list-group-item list-group-item-action border-0 ps-4 {{ Route::is('user.leaguecertificate') ? 'active' : '' }}">
                    <div>
                        <span class="bi bi-file-earmark-text"></span>
                        <span class="ms-1">League Certificate</span>
                    </div>
                </a>
            </div>
        </div>
        @endif
		<a href="{{ route('logout')}}"
			class="list-group-item list-group-item-action border-0 align-items-center">
			<span class="bi bi-arrow-bar-left"></span>
			<span class="ms-2">Logout</span>
		</a>
	</div>
</div>