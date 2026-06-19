

@extends('crm.layouts.master')
@php
    $Event = Helper::Topics(37);
@endphp
@section('content')
    <!-- Main Content Container -->
<div class="bg-slate-50">
<div class="max-w-7xl mx-auto p-8 space-y-16">

  <!-- HEADER -->
  <div class="text-center space-y-3">
    <div class="flex items-center justify-center gap-3">
      <div class="w-1 h-1 bg-[#e85a3c] rounded-full"></div>
      <span class="text-[#e85a3c] font-black text-sm uppercase tracking-[0.2em]">
        Upcoming Event Section
      </span>
      <div class="w-1 h-1 bg-[#e85a3c] rounded-full"></div>
    </div>
    <h2 class="text-5xl md:text-7xl font-black text-[#0f172a] tracking-tighter uppercase">
      Gear Up For Action
    </h2>
  </div>

  <!-- EVENTS GRID -->
  <div class="grid grid-cols-1 md:grid-cols-3 gap-10">

  @foreach ($Event as $event)
                @php
                    $buttonlink = '';

                    // Fetch custom fields
                    if (!empty($event->fields)) {
                        foreach ($event->fields as $field) {
                            switch ($field['field_id']) {
                                case 56:
                                    $buttonlink = $field['field_value'];
                                    break;
                            }
                        }
                    }

                    $image = !empty($event->photo_file)
                        ? asset('uploads/topics/' . $event->photo_file)
                        : asset('assets/frontend/images/resource/event-1.jpg');
                @endphp
    <!-- EVENT CARD -->
    <div onclick="openModal()" class="group cursor-pointer">
      <div class="relative rounded-[2.5rem] overflow-hidden bg-white shadow-2xl transition group-hover:-translate-y-4 aspect-[4/3] mb-8">
        <img src="{{ $image }}"
             class="w-full h-full object-cover group-hover:scale-110 transition duration-1000">
        <div class="absolute inset-0 bg-gradient-to-t from-black/40"></div>
        <div class="absolute bottom-0 left-0 right-0 bg-[#e85a3c]/90 py-4 text-center">
          <span class="text-white font-black text-xl uppercase tracking-wider">{{ $event->title_en ?? '' }}</span>
        </div>
      </div>

      <div class="px-4 space-y-4">
        <div class="flex items-center gap-2 text-[#e85a3c] font-bold text-sm">
          <i data-lucide="calendar" class="w-4 h-4"></i>
          <span>{{ $event->date }} || {{ $buttonlink ?: '#' }}</span>
        </div>
        <h3 class="text-3xl font-black text-[#0f172a] tracking-tighter">
         {{ $event->details_en ?? '' }}
        </h3>
        <button class="flex items-center gap-3 px-8 py-4 bg-white border rounded-xl font-black text-xs uppercase tracking-widest hover:bg-[#e85a3c] hover:text-white transition">
          Participate Now
          <i data-lucide="arrow-right" class="w-4 h-4"></i>
        </button>
      </div>
    </div>
        @endforeach


  </div>
</div>

<!-- MODAL -->
<div id="modal" class="fixed inset-0 hidden z-[120] items-center justify-center p-6">
  <div class="absolute inset-0 bg-[#0f172a]/90 backdrop-blur-md" onclick="closeModal()"></div>

  <div class="relative bg-white w-full max-w-2xl rounded-[3rem] p-10 shadow-2xl">

    <button onclick="closeModal()" class="absolute top-8 right-8">
      <i data-lucide="x"></i>
    </button>

    <!-- STEP INDICATOR -->
    <div class="flex items-center gap-4 mb-8">
      <span class="px-4 py-1 bg-orange-50 text-[#e85a3c] rounded-full text-[10px] font-black uppercase tracking-widest">
        Event Enrollment
      </span>
      <span class="text-slate-400 text-xs font-bold">Step <span id="stepNum">1</span> of 2</span>
    </div>

    <!-- STEP 1 -->
    <div id="step1" class="space-y-8">
      <h3 class="text-4xl font-black tracking-tighter">
        Confirming Entry for <span class="text-[#e85a3c]">Cricket</span>
      </h3>

      <div class="grid grid-cols-2 gap-6">
        <div class="bg-slate-50 p-6 rounded-3xl">
          <p class="text-[10px] uppercase font-black text-slate-400">Event Category</p>
          <p class="font-black">Outdoor Sports</p>
        </div>
        <div class="bg-slate-50 p-6 rounded-3xl">
          <p class="text-[10px] uppercase font-black text-slate-400">Venue</p>
          <p class="font-black">Chennai</p>
        </div>
      </div>

      <div>
        <h4 class="font-black text-lg mb-4">Select Participating Team</h4>

        <div class="space-y-3">
          <div class="p-5 border rounded-2xl flex justify-between items-center hover:border-[#e85a3c] cursor-pointer">
            <div class="flex items-center gap-4">
              <div class="w-10 h-10 bg-orange-50 rounded-full flex items-center justify-center text-[#e85a3c]">
                <i data-lucide="users"></i>
              </div>
              <span class="font-black">Team Alpha</span>
            </div>
            <div class="w-6 h-6 border-2 rounded-full"></div>
          </div>

          <div class="p-5 border rounded-2xl flex justify-between items-center hover:border-[#e85a3c] cursor-pointer">
            <div class="flex items-center gap-4">
              <div class="w-10 h-10 bg-orange-50 rounded-full flex items-center justify-center text-[#e85a3c]">
                <i data-lucide="users"></i>
              </div>
              <span class="font-black">Team Phoenix</span>
            </div>
            <div class="w-6 h-6 border-2 rounded-full"></div>
          </div>
        </div>
      </div>

      <button onclick="nextStep()" class="w-full bg-[#0f172a] text-white py-6 rounded-[2rem] font-black uppercase tracking-widest hover:bg-[#e85a3c] transition">
        Next: Confirm Details
      </button>
    </div>

    <!-- STEP 2 -->
    <div id="step2" class="space-y-8 hidden">
      <h3 class="text-4xl font-black tracking-tighter">Tournament Terms</h3>

      <div class="bg-slate-50 p-8 rounded-3xl space-y-4">
        <div class="flex gap-4"><i data-lucide="check" class="text-[#e85a3c]"></i> Arrive 15 minutes early</div>
        <div class="flex gap-4"><i data-lucide="check" class="text-[#e85a3c]"></i> Official jerseys required</div>
        <div class="flex gap-4"><i data-lucide="check" class="text-[#e85a3c]"></i> ID mandatory</div>
      </div>

      <div class="flex gap-4">
        <button onclick="prevStep()" class="px-10 py-6 rounded-[2rem] font-black uppercase text-slate-400">
          Go Back
        </button>
        <button class="flex-1 bg-[#e85a3c] text-white py-6 rounded-[2rem] font-black uppercase hover:scale-105 transition">
          Confirm Participation
        </button>
      </div>
    </div>

  </div>
</div>
</div>
<script>
  function openModal() {
    document.getElementById('modal').classList.remove('hidden');
  }
  function closeModal() {
    document.getElementById('modal').classList.add('hidden');
    prevStep();
  }
  function nextStep() {
    document.getElementById('step1').classList.add('hidden');
    document.getElementById('step2').classList.remove('hidden');
    document.getElementById('stepNum').innerText = '2';
  }
  function prevStep() {
    document.getElementById('step2').classList.add('hidden');
    document.getElementById('step1').classList.remove('hidden');
    document.getElementById('stepNum').innerText = '1';
  }

  lucide.createIcons();
</script>




@endsection

