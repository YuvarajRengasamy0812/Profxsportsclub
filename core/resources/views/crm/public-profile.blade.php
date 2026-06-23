<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $user->name }} – ProFX Sports Club</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#f8fafc] min-h-screen flex items-center justify-center p-6">

  <div class="w-full max-w-sm">

    <!-- Card -->
    <div class="bg-white rounded-[3rem] shadow-2xl overflow-hidden">

      <!-- Header band -->
      <div class="bg-gradient-to-br from-[#0f172a] via-slate-900 to-black h-28 relative">
        <div class="absolute -bottom-14 left-1/2 -translate-x-1/2">
          <img src="{{ $user->photo ? asset($user->photo) : asset('assets/frontend/images/user.png') }}"
               onerror="this.src='{{ asset('assets/frontend/images/user.png') }}'"
               class="w-28 h-28 rounded-full border-4 border-white object-cover shadow-xl">
        </div>
      </div>

      <!-- Body -->
      <div class="pt-16 pb-10 px-8 text-center">

        <h1 class="text-2xl font-black text-[#0f172a] mt-2">
          {{ $user->name }} {{ $user->lastname }}
        </h1>

        @if($user->role)
        <p class="text-xs font-black uppercase tracking-widest text-[#e85a3c] mt-1">
          {{ $user->role }}
        </p>
        @endif

        @if($user->nationalities)
        <p class="text-sm text-slate-400 font-bold mt-1">
          {{ $user->nationalities }}
        </p>
        @endif

        <div class="mt-6 border-t border-slate-100 pt-6 space-y-3 text-left">
          @if($user->connect_email)
          <div class="flex items-center gap-3">
            <span class="text-xs font-black uppercase tracking-widest text-slate-400 w-16">Email</span>
            <span class="text-sm font-bold text-[#0f172a] truncate">{{ $user->connect_email }}</span>
          </div>
          @elseif($user->email)
          <div class="flex items-center gap-3">
            <span class="text-xs font-black uppercase tracking-widest text-slate-400 w-16">Email</span>
            <span class="text-sm font-bold text-[#0f172a] truncate">{{ $user->email }}</span>
          </div>
          @endif

          @if($user->phone)
          <div class="flex items-center gap-3">
            <span class="text-xs font-black uppercase tracking-widest text-slate-400 w-16">Phone</span>
            <span class="text-sm font-bold text-[#0f172a]">{{ $user->phone }}</span>
          </div>
          @endif
        </div>

        <a href="{{ url('/customer') }}"
           class="mt-8 block w-full py-4 bg-[#e85a3c] text-white rounded-2xl font-black text-sm uppercase tracking-widest hover:bg-[#0f172a] transition">
          Join ProFX Sports Club
        </a>

        <p class="mt-4 text-xs text-slate-400 font-bold">profxsportsclub.com</p>
      </div>

    </div>

  </div>

</body>
</html>
