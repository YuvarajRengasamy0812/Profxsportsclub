<?php $joinproclub = Helper::Topic(148);
if ($joinproclub->$title_var != '') {
    $titleclub = $joinproclub->$title_var;
} else {
    $titleclub = $joinproclub->$title_var2;
}
?>

<style>
    /* Initial hidden state */
    .cta-area-1 {
        opacity: 0;
        transform: translateY(50px);
        transition: all 1s ease;
    }

    /* When visible */
    .cta-area-1.animate {
        opacity: 1;
        transform: translateY(0);
    }

    .cta-thumb {
        opacity: 0;
        transform: scale(0.9);
        transition: all 1s ease 0.5s;
        /* delay */
    }

    .cta-thumb.animate {
        opacity: 1;
        transform: scale(1);
    }

    .cta-wrap {
        opacity: 0;
        transform: translateX(-50px);
        transition: all 1s ease 1s;
        /* more delay */
    }

    .cta-wrap.animate {
        opacity: 1;
        transform: translateX(0);
    }

    .cta-wrap-bg .cta-bg-img img {}


    /* Desktop screens between 1200px and 1350px */
    @media (min-width: 1200px) and (max-width: 1350px) {
        .cta-wrap-bg .cta-bg-img img {
            position: absolute;
            top: 25px;
            /* adjust as needed */
            right: 250px;
            /* adjust as needed */
            opacity: 0.1;
        }

        .cta-wrap-bg {
            position: relative;
        }
    }

    /* Desktop screens between 1350px and 1500px */
    @media (min-width: 1300px) and (max-width: 1600px) {
        .cta-wrap-bg .cta-bg-img img {
            position: absolute;
            top: 100px;
            /* adjust as needed */
            right: 400px;
            /* adjust as needed */
            opacity: 0.1;
        }

        .cta-wrap-bg {
            position: relative;
        }
    }
    @media (min-width: 1600px) and (max-width: 1900px) {
        .cta-wrap-bg .cta-bg-img img {
            position: absolute;
            top: 100px;
            /* adjust as needed */
            right: 380px;
            /* adjust as needed */
            opacity: 0.1;
        }

        .cta-wrap-bg {
            position: relative;
        }
    }
</style>
<section class="space">
    <div class="container">
        <div class="cta-area-1">
            <div class="cta-bg-shape-border"><svg width="1464" height="564" viewBox="0 0 1464 564" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M1463.5 30V534C1463.5 550.292 1450.29 563.5 1434 563.5H1098H927.426C919.603 563.5 912.099 560.392 906.567 554.86L884.14 532.433C878.42 526.713 870.663 523.5 862.574 523.5H601.426C593.337 523.5 585.58 526.713 579.86 532.433L557.433 554.86C551.901 560.392 544.397 563.5 536.574 563.5H366H30C13.7076 563.5 0.5 550.292 0.5 534V30C0.5 13.7076 13.7076 0.5 30 0.5H366H536.574C544.397 0.5 551.901 3.60802 557.433 9.14034L579.86 31.5668C585.58 37.2866 593.337 40.5 601.426 40.5H862.574C870.663 40.5 878.42 37.2866 884.14 31.5668L906.567 9.14035C912.099 3.60803 919.603 0.5 927.426 0.5H1098H1434C1450.29 0.5 1463.5 13.7076 1463.5 30Z"
                        stroke="url(#paint0_linear_202_547)" />
                    <defs>
                        <linearGradient id="paint0_linear_202_547" x1="0" y1="0" x2="1505.47"
                            y2="412.762" gradientUnits="userSpaceOnUse">
                            <stop offset="0" stop-color="var(--theme-color)" />
                            <stop offset="1" stop-color="var(--theme-color2)" />
                        </linearGradient>
                    </defs>
                </svg></div>
            <div class="cta-wrap-bg bg-repeat"
                data-mask-src="{{ URL::asset('assets/frontend/img/cta-bg-shape1.svg') }}">
                <div class="cta-bg-img img-fluid"><img decoding="async"
                        src="{{ URL::asset('assets/frontend/img/club-logo-bg.png') }}" alt="cta sec1 bg"
                        style="opacity:0.1;" />
                </div>
                <div class="cta-thumb img-fluid"><img decoding="async"
                        src="{{ URL::to('uploads/topics/' . $joinproclub->photo_file) }}"
                        alt="{{ $joinproclub->title }}" alt="cta1 1" style="margin-right: 100px;max-height: 500px;" />
                </div>
            </div>
            <div class="cta-wrap">
                <div class="row">
                    <div class="col-xl-5">
                        {!! @$joinproclub->$details_var !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const section = document.querySelector(".cta-area-1");
        const thumb = section.querySelector(".cta-thumb");
        const wrap = section.querySelector(".cta-wrap");

        function checkScroll() {
            const rect = section.getBoundingClientRect();
            if (rect.top < window.innerHeight - 100) {
                section.classList.add("animate");
                thumb.classList.add("animate");
                wrap.classList.add("animate");
                window.removeEventListener("scroll", checkScroll);
            }
        }

        window.addEventListener("scroll", checkScroll);
        checkScroll(); // run on load
    });
</script>
