<!--********************************
   Code End  Here
 ******************************** -->

<!-- Scroll To Top -->
<style>
    /* Right middle floating container */
    .social-icons {
        position: fixed;
        top: 50%;
        right: 0;
        transform: translateY(-50%);
        z-index: 2000;
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        padding-right: 5px;
        /* optional spacing from edge */
    }

    /* Social icons list */
    .social-icons ul {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-direction: column;
        gap: 10px;
        align-items: flex-end;
    }

    /* Icon buttons */
    .social-icons ul li a {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        color: #fff;
        box-shadow: 0 3px 6px rgba(0, 0, 0, 0.2);
        transition: all 0.3s ease;
    }

    .social-icons ul li a:hover {
        transform: scale(1.1);
    }

    /* Individual colors */
    .social-icons .whatsapp-live {
        background: #128C7E;
    }

    .social-icons .whatsapp {
        background: #25D366;
    }

    .social-icons .telegram {
        background: #0088cc;
    }

    .social-icons .messenger {
        background: #0084FF;
    }

    .social-icons .discord {
        background: #5865F2;
    }

    .social-icons .email {
        background: #EA4335;
    }

    /* Responsive adjustments */
    @media (max-width: 576px) {
        .social-icons ul li a {
            width: 40px;
            height: 40px;
            font-size: 18px;
        }
    }
</style>

<!-- Floating Toggle -->
<!-- Floating Social Icons -->
<?php
/* <div class="social-icons">
  <ul>
   <!--<li><a href="https://wa.me/+971585043433" target="_blank" class="whatsapp-live"><i-->
   <!--            class="fa-solid fa-headset"></i></a></li>-->
   <li><a href="https://wa.me/+971585697837" target="_blank" class="whatsapp"><i class="fab fa-whatsapp"></i></a></li>
   <li><a href="http://T.me/profxleague" target="_blank" class="telegram"><i class="fab fa-telegram-plane"></i></a>
   </li>
   <li><a href="https://m.me/profxleague" target="_blank" class="messenger"><i
      class="fab fa-facebook-messenger"></i></a></li>
   <li><a href="https://discord.gg/profxleague" target="_blank" class="discord"><i class="fab fa-discord"></i></a>
   </li>
   <li><a href="mailto:Support@profxleague.com" class="email"><i class="fa-solid fa-envelope"></i></a></li>
  </ul>
 </div> */
?>
<!--Scroll to top-->
<div class="scroll-to-top">
    <svg class="scroll-top-inner" viewBox="-1 -1 102 102">
        <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
    </svg>
</div>



<!--==============================
    All Js File
============================== -->
<!-- jequery plugins -->
<script src="{{ URL::asset('assets/frontend/js/jquery.js') }}?v={{ Helper::system_version() }}"></script>
<script src="{{ URL::asset('assets/frontend/js/bootstrap.min.js') }}?v={{ Helper::system_version() }}"></script>
<script src="{{ URL::asset('assets/frontend/js/owl.js') }}?v={{ Helper::system_version() }}"></script>
<script src="{{ URL::asset('assets/frontend/js/wow.js') }}?v={{ Helper::system_version() }}"></script>
<script src="{{ URL::asset('assets/frontend/js/validation.js') }}?v={{ Helper::system_version() }}"></script>
<script src="{{ URL::asset('assets/frontend/js/jquery.fancybox.js') }}?v={{ Helper::system_version() }}"></script>
<script src="{{ URL::asset('assets/frontend/js/appear.js') }}?v={{ Helper::system_version() }}"></script>
<script src="{{ URL::asset('assets/frontend/js/isotope.js') }}?v={{ Helper::system_version() }}"></script>
<script src="{{ URL::asset('assets/frontend/js/parallax-scroll.js') }}?v={{ Helper::system_version() }}"></script>
<script src="{{ URL::asset('assets/frontend/js/jquery.nice-select.min.js') }}?v={{ Helper::system_version() }}">
</script>
<script src="{{ URL::asset('assets/frontend/js/scrolltop.min.js') }}?v={{ Helper::system_version() }}"></script>
<script src="{{ URL::asset('assets/frontend/js/jquery-ui.js') }}?v={{ Helper::system_version() }}"></script>
<script src="{{ URL::asset('assets/frontend/js/odometer.js') }}?v={{ Helper::system_version() }}"></script>

<!-- main-js -->
<script src="{{ URL::asset('assets/frontend/js/script.js') }}?v={{ Helper::system_version() }}"></script>


<script src="https://cdn.gtranslate.net/widgets/latest/dwf.js" defer></script>
<script id="gt_widget_script_35511682-js-before" type="text/javascript">
    $(document).ready(function() {
        $('.league-gtranslate .gt_selected').click();
    });

    window.gtranslateSettings = {
        "default_language": "en",
        "native_language_names": true,
        "languages": ["ar", "en", "hi", "ms", "ur", "bn", "fr", "pt", "it", "nl", "de", "ru", "es", "zh-CN", "hi",
            "th", "tr",
        ],
        "wrapper_selector": ".gtranslate_wrapper",
        "horizontal_position": "inline",
        "flag_size": 16,
        "switcher_vertical_position": "top"
    }
</script>

{{-- ajax subscribe to news letter --}}
@if (Helper::GeneralSiteSettings('style_subscribe'))
    <script type="text/javascript">
        $(document).ready(function() {

            //Subscribe
            $('#subscribeForm').submit(function(evt) {
                evt.preventDefault();
                let btn = $('#subscribeFormSubmit');
                btn.html(
                    "<img src=\"{{ asset('assets/dashboard/images/loading.gif') }}\" style=\"height: 20px\"/> {!! __('frontend.subscribe') !!}"
                );
                btn.prop('disabled', true);
                var formData = new FormData(this);
                $.ajax({
                    type: "POST",
                    url: "{{ route('subscribeSubmit') }}",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(result) {
                        let stat = 'alert-warning';
                        if (result.stat === 'success') {
                            stat = 'alert-success';
                            $('#subscribeForm')[0].reset();
                        }
                        let confirm = '<div class="alert alert-dismissible ' + stat +
                            ' alert-dismissible fade show mt-3" role="alert">' + result.msg +
                            '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                        $(".footer-newsletter .alert").remove();
                        $(".footer-newsletter").append(confirm);
                        btn.html("{!! __('frontend.subscribe') !!}");
                        btn.prop('disabled', false);
                    }
                });
                return false;
            });

        });
    </script>
@endif

{{-- Google Tags and google analytics --}}
@if (
    @Helper::GeneralWebmasterSettings('google_tags_status') &&
        @Helper::GeneralWebmasterSettings('google_tags_id') != '')
    <!-- Google Tag Manager (noscript) -->
    <noscript>
        <iframe src="//www.googletagmanager.com/ns.html?id={!! @Helper::GeneralWebmasterSettings('google_tags_id') !!}" height="0" width="0"
            style="display:none;visibility:hidden"></iframe>
    </noscript>
    <!-- End Google Tag Manager (noscript) -->
@endif

<?php
if (@$PageTitle == '') {
    $PageTitle = Helper::GeneralSiteSettings('site_title_' . @Helper::currentLanguage()->code);
}
?>
@include('frontEnd.layouts.cookie')
{!! Helper::SaveVisitorInfo($PageTitle) !!}
<script>
    // window.ZXWAMS = {
    //     brandColor: "#45F882",
    //     ctaText: "Chat on WhatsApp",
    //     mobileFullscreen: false,
    //     position: "bottom-right",
    //     brandName: "PROFXSPORTSCLUB",
    //     phoneNumber: "+971585945733",
    //     brandHeadline: "Hi ðŸ‘‹ Need help or have questions? Let's chat on WhatsApp!",
    //     messageText: "Hi, I want to know more!",
    //     brandImg: "https://yt3.googleusercontent.com/HRugd8i2At1dHPUsJuhv8Z8kOExO0wPwoS34FRxtTxVhWnAPQxsEjXdO0c4J7EmFKHce2I7xqA=s160-c-k-c0x00ffffff-no-rj"
    // };

    // (function() {
    //     var script = document.createElement('script');
    //     script.src = "https://forms.zixflow.com/waWidget.bundle.js";
    //     script.async = true;
    //     var entry = document.getElementsByTagName('script')[0];
    //     entry.parentNode.insertBefore(script, entry);
    // })();

    // Observer to fix invisible blocking on small screens
    function observeZixFlowWidget() {
        const observer = new MutationObserver(() => {
            const widgets = document.querySelectorAll('.zixflow-widget');
            widgets.forEach(div => {
                if (window.innerWidth <= 1200) {
                    div.style.pointerEvents = 'none';
                    div.style.width = '0px';
                    div.style.height = '0px';
                    div.style.opacity = '0';
                } else {
                    div.style.pointerEvents = 'auto';
                    div.style.width = '';
                    div.style.height = '';
                    div.style.opacity = '';
                }
            });
        });

        observer.observe(document.body, {
            childList: true,
            subtree: true
        });
    }

    window.addEventListener('load', () => setTimeout(observeZixFlowWidget, 500));
    window.addEventListener('resize', () => {
        const widgets = document.querySelectorAll('.zixflow-widget');
        widgets.forEach(div => {
            if (window.innerWidth > 420) {
                div.style.pointerEvents = 'auto';
                div.style.width = '';
                div.style.height = '';
                div.style.opacity = '';
            }
        });
    });

    /*const toggleBtn = document.querySelector(".social-toggle .toggle-btn");
       const toggleBox = document.querySelector(".social-toggle");

       // Click toggle (manual)
       toggleBtn.addEventListener("click", () => {
           toggleBox.classList.toggle("active");
       });

       // Optional: Close when clicking outside
       document.addEventListener("click", function(event) {
           if (!toggleBox.contains(event.target)) {
               toggleBox.classList.remove("active");
           }
       }); */
</script>

<?php if (Auth::check()) { ?>

<!-- Add SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    let idleTime = 0;
    const idleLimit = 5 * 60; // 5 minutes idle
    const warningLimit = 3 * 60; // 3 minutes countdown
    let warningShown = false;
    let idleInterval;

    function resetIdle() {
        if (!warningShown) {
            idleTime = 0;
        }
    }

    function timerIncrement() {
        idleTime++;
        if (idleTime >= idleLimit && !warningShown) {
            showWarning();
        }
    }

    function showWarning() {
        warningShown = true;
        idleTime = 0;

        let timeLeft = warningLimit;

        Swal.fire({
            title: "⚠️ Session Expiring",
            html: `You will be logged out in <b id="countdown">${formatTime(timeLeft)}</b>`,
            icon: "warning",
            allowOutsideClick: false,
            allowEscapeKey: false,
            showCancelButton: true,
            confirmButtonText: "Stay Logged In",
            cancelButtonText: "Logout",
            didOpen: () => {
                const countdownEl = Swal.getHtmlContainer().querySelector("#countdown");

                const timer = setInterval(() => {
                    timeLeft--;
                    countdownEl.textContent = formatTime(timeLeft);

                    if (timeLeft <= 0) {
                        clearInterval(timer);
                        Swal.close();
                        document.getElementById("logout-form").submit();
                    }
                }, 1000);

                // store timer id so we can clear if user stays logged in
                Swal._idleTimer = timer;
            }
        }).then((result) => {
            clearInterval(Swal._idleTimer);

            if (result.isConfirmed) {
                // Stay Logged In
                stayLoggedIn();
            } else {
                // Logout
                document.getElementById("logout-form").submit();
            }
        });
    }

    function stayLoggedIn() {
        idleTime = 0;
        warningShown = false;
    }

    function formatTime(seconds) {
        let m = Math.floor(seconds / 60);
        let s = seconds % 60;
        return `${m}:${s.toString().padStart(2, "0")}`;
    }

    // Detect activity only when popup not showing
    window.onload = resetIdle;
    document.onmousemove = resetIdle;
    document.onkeypress = resetIdle;

    idleInterval = setInterval(timerIncrement, 1000);
</script>

<!-- Hidden Logout Form -->
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
    @csrf
</form>
<?php } ?>
