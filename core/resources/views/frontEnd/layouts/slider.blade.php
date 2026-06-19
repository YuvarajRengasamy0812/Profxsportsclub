<section class="pro-banner-section">
    <div class="pro-carousel">

        <div class="pro-slides">
            <!-- Slide 1 -->
            <div class="pro-slide">
                <picture>
                    <source media="(max-width: 767px)" srcset="{{ asset('assets/frontend/images/banner/4.png') }}">
                    <source media="(max-width: 1024px)" srcset="{{ asset('assets/frontend/images/banner/1.png') }}">
                    <img src="{{ asset('assets/frontend/images/banner/1.png') }}" alt="Banner 1">
                </picture>
            </div>

            <!-- Slide 2 -->
            <div class="pro-slide">
                <picture>
                    <source media="(max-width: 767px)" srcset="{{ asset('assets/frontend/images/banner/5.png') }}">
                    <source media="(max-width: 1024px)" srcset="{{ asset('assets/frontend/images/banner/2.png') }}">
                    <img src="{{ asset('assets/frontend/images/banner/2.png') }}" alt="Banner 2">
                </picture>
            </div>

            <!-- Slide 3 -->
            <div class="pro-slide">
                <picture>
                    <source media="(max-width: 767px)" srcset="{{ asset('assets/frontend/images/banner/6.png') }}">
                    <source media="(max-width: 1024px)" srcset="{{ asset('assets/frontend/images/banner/3.png') }}">
                    <img src="{{ asset('assets/frontend/images/banner/3.png') }}" alt="Banner 3">
                </picture>
            </div>
        </div>

        <!-- Buttons -->
        <div class="pro-banner-buttons" id="proBannerButtons">
            <a href="{{ route('customerdashboard') }}" class="pro-btn pro-btn-register">
                REGISTER FREE
            </a>
            <a href="{{ route('event') }}" class="pro-btn pro-btn-login">
                EXPLORE
            </a>
        </div>

        <!-- Navigation -->
        <button class="pro-nav pro-prev">&#10094;</button>
        <button class="pro-nav pro-next">&#10095;</button>

    </div>
</section>

<style>
/* ================= BASE ================= */

.pro-banner-section {
    width: 100%;
    overflow: hidden;
}

.pro-carousel {
    position: relative;
    width: 100%;
    max-width: 1600px;
    margin: auto;
    overflow: hidden;
}

.pro-slides {
    display: flex;
    transition: transform 0.6s ease-in-out;
}

/* Slide */
.pro-slide {
    min-width: 100%;
    aspect-ratio: 1600 / 569;
    position: relative;
    overflow: hidden;
}

.pro-slide img {
    width: 100%;
    object-fit: cover;
    display: block;
}

/* Navigation arrows */
.pro-nav {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(0,0,0,0.6);
    color: #fff;
    border: none;
    padding: 14px 18px;
    font-size: 24px;
    cursor: pointer;
    border-radius: 50%;
    z-index: 10;
}

.pro-prev { left: 20px; }
.pro-next { right: 20px; }

/* Buttons default */
.pro-banner-buttons {
    position: absolute;
    bottom: 12%;
    left: 8%;
    display: flex;
    gap: 14px;
    z-index: 9;
    transition: all 0.4s ease;
}

/* Banner 3 → RIGHT */
.pro-banner-buttons.pro-right {
    left: auto;
    right: 8%;
}

/* Buttons */
.pro-btn {
    padding: 12px 26px;
    text-decoration: none;
    font-size: 16px;
    font-weight: 600;
    border-radius: 4px;
    transition: all 0.3s ease;
}

.pro-btn-register {
    background: linear-gradient(90deg, #AF3336 0%, #EF7E35 100%);
    color: #fff;
}

.pro-btn-login {
    background: transparent;
    color: #fff;
    border: 2px solid #fff;
}

.pro-btn-login:hover {
    background: linear-gradient(90deg, #AF3336 0%, #EF7E35 100%);
    border-color: #EF7E35;
}

/* ============ TABLET ============ */
@media (max-width: 1024px) {
    .pro-slide {
        aspect-ratio: 16 / 9;
    }

    .pro-banner-buttons {
        bottom: 10%;
        left: 6%;
    }

    .pro-banner-buttons.pro-right {
        right: 6%;
    }

    .pro-btn {
        font-size: 15px;
        padding: 10px 22px;
    }
}

/* ============ MOBILE ============ */
@media (max-width: 767px) {
    .pro-slide {
        aspect-ratio: 4 / 3;
    }

    .pro-banner-buttons {
        bottom: 6%;
        left: 50%;
        transform: translateX(-50%);
        flex-direction: column;
        gap: 10px;
        width: auto;
        text-align: center;
    }

    /* Hide EXPLORE button */
    .pro-btn-login {
        display: none;
    }

    .pro-btn-register {
        width: 160px; /* smaller button */
        font-size: 14px;
        padding: 10px 18px;
    }

    .pro-nav {
        font-size: 18px;
        padding: 10px 12px;
    }
}
/* ============ SMALL MOBILE (320px wide) ============ */
@media (max-width: 320px) and (max-height: 608px) {
    .pro-slide {
        aspect-ratio: 4 / 3;
    }

    .pro-banner-buttons {
        bottom: 5%;           /* move slightly up */
        left: 50%;
        transform: translateX(-50%);
        flex-direction: column;
        gap: 8px;
        width: auto;
        text-align: center;
    }

    .pro-btn-register {
        width: 120px;         /* smaller to fit tiny screen */
        font-size: 12px;
        padding: 8px 12px;
    }

    .pro-btn-login {
        display: none;        /* hide explore button */
    }

    .pro-nav {
        font-size: 16px;      /* smaller nav arrows */
        padding: 8px 10px;
    }
}

</style>

<script>
let proIndex = 0;
const proSlides = document.querySelector('.pro-slides');
const proTotalSlides = document.querySelectorAll('.pro-slide').length;
const proButtons = document.getElementById('proBannerButtons');

function proShowSlide(index) {
    proSlides.style.transform = `translateX(-${index * 100}%)`;

    if (index === 2) {
        proButtons.classList.add('pro-right');
    } else {
        proButtons.classList.remove('pro-right');
    }
}

// Next/Prev buttons
document.querySelector('.pro-next').addEventListener('click', () => {
    proIndex = (proIndex + 1) % proTotalSlides;
    proShowSlide(proIndex);
});

document.querySelector('.pro-prev').addEventListener('click', () => {
    proIndex = (proIndex - 1 + proTotalSlides) % proTotalSlides;
    proShowSlide(proIndex);
});

// Auto-slide
setInterval(() => {
    proIndex = (proIndex + 1) % proTotalSlides;
    proShowSlide(proIndex);
}, 5000);

proShowSlide(proIndex);
</script>
