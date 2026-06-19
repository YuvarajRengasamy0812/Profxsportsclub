<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: '{{ session('success') }}'
        });
    </script>
@endif

@if ($errors->any())
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: '{{ $errors->first() }}'
        });
    </script>
@endif

<div class="header-top" style="background:#011C32">
    <div class="top-inner">

        <div>
            <!--<p style="color:#fff">Breaking</p>-->
        </div>
        <div class="breaking-news-bar ">

            <span> ProFX Sports Club is thrilled to unveil its upcoming tournament series featuring elite competitions across Cricket, Football, Basketball, and eSports. Members can now register early to secure their spot and enjoy priority access to events, workshops, and networking opportunities. Stay tuned for detailed schedules and exclusive perks available only to verified members. Don’t miss out on the action — join ProFX Sports Club!</span>
        </div>


        <div class="header-info">
            <!--<div class="search-toggler pr_30 mr_30"><i class="icon-4"></i></div>-->
            @use('Illuminate\Support\Facades\Auth')

            {{-- <div class="login-box p_relative pr_30 mr_30">

				@if (Auth::check())
					USER LOGGED IN 
					<a href="#"
					onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
						Logout
					</a>

					<form id="logout-form"
						action="{{ route('logoutcustomer') }}"
						method="POST"
						style="display:none;">
						@csrf
					</form>
				@else
					USER NOT LOGGED IN 
					<a href="{{ url('/customer') }}">
						Login
					</a>
				@endif

			</div> --}}


            <ul class="social-links">
                 <li><a href="https://www.facebook.com/profxsportsclub"><i class="fab fa-faceboo-f"></i></a></li>
                <li><a href="https://www.facebook.com/profxsportsclub"><i class="fab fa-facebook-f"></i></a></li>
                <li><a href="https://x.com/profxsportsclub"><i class="fab fa-twitter"></i></a></li>
                <li><a href="https://www.instagram.com/profxsportsclub"><i class="fab fa-linkedin-in"></i></a></li>
            </ul>
        </div>
    </div>
</div>
