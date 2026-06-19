<!-- Enhanced Attractive & Modern Impact Section -->
<section class="impact-section">
    <div class="impact-container">

        <div class="sec-title centred mb_60">
            <span class="sub-title" style="color:#fff">Forex Impact Amplified</span>
            <h2 style="color:#fff">Numbers That Narrate Our Narrative</h2>
        </div>

        <div class="impact-grid">

            <!-- Card 1 -->
            <div class="impact-card">
                <div class="chart-circle">
                    <span>10+</span>
                </div>
                <h4>Sponsored Matches</h4>
                <p>60% Physical • 40% E-Sports</p>
            </div>

            <!-- Card 2 -->
            <div class="impact-card">
                <div class="chart-circle">
                    <span>85%</span>
                </div>
                <h4>Events from Member Surveys</h4>
                <p></p>
            </div>

            <!-- Card 3 -->
            <div class="impact-card">
                <div class="chart-circle small">
                    <span>20+</span>
                </div>
                <h4>Forex Partnerships Forged</h4>
            </div>

            <!-- Card 4 -->
            <div class="impact-card">
                <div class="chart-circle">
                    <span>15+</span>
                </div>
                <h4>Expansion Roadmap</h4>
                <p>Cyprus (Q1 2026), Hong Kong (Q3 2026)</p>
            </div>

            <!-- Card 5 -->
            <div class="impact-card">
                <div class="chart-circle">
                    <span>98%</span>
                </div>
                <h4>Privacy Compliance</h4>
                <p>GDPR for Forex Data</p>
            </div>

        </div>

    </div>
</section>

<style>
    /* Section Base */
    .impact-section {
        padding: 80px 20px;
        background: #011C32;
        text-align: center;
        font-family: "Poppins", sans-serif;
    }

    /* Grid Layout */
    .impact-grid {
        display: grid;
        gap: 35px;
        grid-template-columns: repeat(auto-fit, minmax(270px, 1fr));
        margin-bottom: 40px;
    }


    .impact-card {
        background: #ffffff;
        padding: 30px;
        border-radius: 16px;
        transition: transform .35s ease, box-shadow .35s ease;
        position: relative;
        overflow: hidden;
    }

    .impact-card:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0px 14px 30px rgba(0, 0, 0, 0.12);
    }

    .impact-card::before {
        content: "";
        position: absolute;
        top: -40%;
        left: -40%;
        width: 180%;
        height: 180%;
        background: rgba(43, 89, 255, 0.06);
        transform: rotate(25deg);
        border-radius: 30%;
        z-index: 0;
    }

    .impact-card * {
        position: relative;
        z-index: 2;
    }

    /* Circle Chart */
    .chart-circle {
        width: 125px;
        height: 125px;
        border-radius: 50%;
        /* border: 4px solid transparent; */
        /* background: #011C32; */
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 15px;
        font-size: 28px;
        font-weight: 700;
        color: #EF7E35;
        box-shadow: inset 0px 0px 12px rgba(176, 85, 28, 0.3);
    }

    .chart-circle.small {
        width: 105px;
        height: 105px;
        font-size: 24px;
    }

    /* Bar Progress & Roadmap (optional) */
    .bar-progress {
        width: 100%;
        height: 16px;
        background: #e0e6ff;
        border-radius: 10px;
        margin-bottom: 20px;
        overflow: hidden;
    }

    .bar-fill {
        height: 100%;
        background: linear-gradient(90deg, #AF3336, #EF7E35);
        border-radius: 10px;
    }

    .roadmap-box {
        padding: 18px;
        background: #eef3ff;
        border-radius: 12px;
        margin-bottom: 15px;
        box-shadow: inset 0px 0px 8px rgba(43, 89, 255, 0.15);
    }

    .roadmap-box p {
        margin: 6px 0;
        font-weight: 500;
    }

    /* Media Queries */

    /* Mobile Devices */
    @media (max-width: 480px) {
        .impact-section {
            padding: 40px 10px;
        }

        .impact-grid {
            grid-template-columns: 1fr;
            gap: 20px;
        }

        .chart-circle {
            width: 90px;
            height: 90px;
            font-size: 20px;
        }

        .chart-circle.small {
            width: 70px;
            height: 70px;
            font-size: 16px;
        }

        .impact-card h4 {
            font-size: 15px;
        }

        .impact-card p {
            font-size: 12px;
        }
    }

    /* Mobile / Tablet */
    @media (max-width: 768px) {
        .impact-section {
            padding: 50px 10px;
        }

        .impact-grid {
            gap: 20px;
        }

        .chart-circle {
            width: 100px;
            height: 100px;
            font-size: 22px;
        }

        .chart-circle.small {
            width: 80px;
            height: 80px;
            font-size: 18px;
        }

        .impact-card h4 {
            font-size: 16px;
        }

        .impact-card p {
            font-size: 13px;
        }
    }

    /* Tablets */
    @media (max-width: 1024px) {
        .impact-section {
            padding: 60px 15px;
        }

        .impact-grid {
            gap: 25px;
        }

        .impact-card {
            padding: 25px;
        }

        .chart-circle {
            width: 110px;
            height: 110px;
            font-size: 24px;
        }

        .chart-circle.small {
            width: 90px;
            height: 90px;
            font-size: 20px;
        }

        .impact-card h4 {
            font-size: 18px;
        }

        .impact-card p {
            font-size: 14px;
        }
    }


    /* Large screens / deployment width */
    @media (min-width: 1500px) {
        .impact-grid {
            grid-template-columns: repeat(5, 1fr);
            /* exactly 5 cards per row */
            gap: 40px;
        }

        .impact-card {
            padding: 35px;
            border-radius: 20px;
        }

        .chart-circle {
            width: 150px;
            height: 150px;
            font-size: 32px;
        }

        .chart-circle.small {
            width: 130px;
            height: 130px;
            font-size: 28px;
        }

        .impact-card h4 {
            font-size: 20px;
        }

        .impact-card p {
            font-size: 16px;
        }
    }
</style>


<script>
// Function to animate counting
function animateCount(el, duration = 2000) {
    const originalText = el.textContent.trim();
    const isPercent = originalText.includes('%');
    const hasPlus = originalText.includes('+');
    
    // Remove non-digit characters to get the numeric value
    const target = parseInt(originalText.replace(/\D/g, '')) || 0;
    let start = 0;
    const stepTime = Math.max(Math.floor(duration / target), 1);
    
    const counter = setInterval(() => {
        start += 1;
        el.textContent = start + (isPercent ? '%' : '') + (hasPlus ? '+' : '');
        if (start >= target) {
            el.textContent = target + (isPercent ? '%' : '') + (hasPlus ? '+' : '');
            clearInterval(counter);
        }
    }, stepTime);
}

// Check if element is in viewport
function isInViewport(el) {
    const rect = el.getBoundingClientRect();
    return (
        rect.top <= (window.innerHeight || document.documentElement.clientHeight) &&
        rect.bottom >= 0
    );
}

const circles = document.querySelectorAll('.chart-circle span');
let animated = false;

function checkAnimation() {
    const section = document.querySelector('.impact-section');
    if (!animated && isInViewport(section)) {
        circles.forEach(span => animateCount(span));
        animated = true;
    }
}

// Trigger on page load and scroll
window.addEventListener('load', checkAnimation);
window.addEventListener('scroll', checkAnimation);
</script>

