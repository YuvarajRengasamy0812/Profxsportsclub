@extends('crm.layouts.master')
@php
    $Event = Helper::Topics(37);
@endphp

@section('content')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="bg-slate-50">
<div class="max-w-7xl mx-auto p-8 space-y-16">

<!-- HEADER -->
<div class="text-center space-y-3">
    <h2 class="text-5xl font-black text-[#0f172a] uppercase">Gear Up For Action</h2>
</div>

<!-- EVENTS GRID -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-10">

@foreach ($Event as $event)
@php
$buttonlink = '';
if (!empty($event->fields)) {
    foreach ($event->fields as $field) {
        if ($field['field_id'] == 56) {
            $buttonlink = $field['field_value'];
        }
    }
}
$image = !empty($event->photo_file)
    ? asset('uploads/topics/' . $event->photo_file)
    : asset('assets/frontend/images/resource/event-1.jpg');
@endphp

<div class="group">

<div class="relative rounded-[2.5rem] overflow-hidden bg-white shadow-2xl mb-6">
    <img src="{{ $image }}" class="w-full h-64 object-cover">
    <div class="absolute bottom-0 left-0 right-0 bg-[#e85a3c]/90 py-4 text-center">
        <span class="text-white font-black text-xl">{{ $event->title_en }}</span>
    </div>
</div>

<div class="px-4 space-y-4">
    <div class="text-[#e85a3c] font-bold text-sm">
        {{ $event->date }}
    </div>

    <h3 class="text-2xl font-black text-[#0f172a]">
        {{ $event->details_en }}
    </h3>

     <button onclick="openModal('{{ $event->title_en }}','{{ $event->date }}')" 
        class="flex items-center gap-3 px-8 py-4 bg-[#e85a3c] text-white border rounded-xl font-black text-xs uppercase hover:bg-[#0f172a] hover:text-white transition">
        Participate Now
    </button>
</div>

</div>
@endforeach

</div>
</div>

<!-- MODAL -->
<div id="modal" class="fixed inset-0 hidden z-[120] flex items-center justify-center">
<div class="absolute inset-0 bg-black/70" onclick="closeModal()"></div>

<div class="bg-white w-full max-w-xl rounded-3xl p-10 relative">

<button onclick="closeModal()" class="absolute top-4 right-4 text-xl">✖</button>

<h3 class="text-3xl font-black mb-4" id="eventTitle"></h3>
<p class="text-slate-500 mb-6" id="eventDate"></p>

<button onclick="confirmBooking()" class="w-full bg-[#e85a3c] text-white py-4 rounded-xl font-black uppercase">
Confirm Participation
</button>

</div>
</div>

<script>
function openModal(title, date) {
    document.getElementById('modal').classList.remove('hidden');
    document.getElementById('eventTitle').innerText = title;
    document.getElementById('eventDate').innerText = date;
}

function closeModal() {
    document.getElementById('modal').classList.add('hidden');
}

function confirmBooking() {
    Swal.fire({
        icon: 'success',
        title: 'Booking Confirmed!',
        text: 'Your event booking has been successfully completed.',
        confirmButtonColor: '#e85a3c'
    }).then(() => {
        closeModal();
    });
}
</script>

@endsection
