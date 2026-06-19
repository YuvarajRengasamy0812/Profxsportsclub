@php
    $Partner = Helper::Topics(34);
@endphp

<style>
    .rl-partners-carousel {
    width: 100%;
    overflow: hidden;
    position: relative;
}

.rl-partners-track {
    display: flex;
    align-items: center;
    gap: 50px;
    width: max-content;
    animation: rl-marquee 20s linear infinite;
}

.rl-partners-carousel:hover .rl-partners-track {
    animation-play-state: paused;
}

.rl-partner-logo {
    flex-shrink: 0;
}

.rl-partner-logo img {
    height: 70px;
    width: auto;
    display: block;
}

/* Right → Left scrolling */
@keyframes rl-marquee {
    0% {
        transform: translateX(0);
    }
    100% {
        transform: translateX(-50%);
    }
}

</style>

<section class="clients-section pt_150 pb_150">
    <div class="auto-container">
        <div class="sec-title centred mb_60">
            <span class="sub-title">Our Partners</span>
        </div>

        <!-- ✅ Partners marquee container -->
        <div class="rl-partners-carousel">
            <div class="rl-partners-track">
                @foreach($Partner as $counter)
                    @php   
                        $background = !empty($counter->photo_file)
                            ? asset('uploads/topics/' . $counter->photo_file)
                            : asset('assets/frontend/images/clients/clients-1.png');
                    @endphp

                    <div class="rl-partner-logo">
                        <a href="{{ $counter->title_en ?? '#' }}">
                            <img src="{{ $background }}" alt="Client Logo">
                        </a>
                    </div>
                @endforeach
                <!-- ✅ Repeat logos to create continuous loop -->
                @foreach($Partner as $counter)
                    @php   
                        $background = !empty($counter->photo_file)
                            ? asset('uploads/topics/' . $counter->photo_file)
                            : asset('assets/frontend/images/clients/clients-1.png');
                    @endphp

                    <div class="rl-partner-logo">
                        <a href="{{ $counter->title_en ?? '#' }}">
                            <img src="{{ $background }}" alt="Client Logo">
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
