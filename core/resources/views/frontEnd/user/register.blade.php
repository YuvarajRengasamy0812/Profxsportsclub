@extends('frontEnd.layouts.master')

@section('content')
    <?php
    $title_var = 'title_' . @Helper::currentLanguage()->code;
    $title_var2 = 'title_' . config('smartend.default_language');
    $details_var = 'details_' . @Helper::currentLanguage()->code;
    $details_var2 = 'details_' . config('smartend.default_language');
    ?>
    <div id="loadingOverlay" style="display: none;">
        <div class="loading-box">
            <p>Please wait! We will send the Email verification link to registed email...</p>
            <div class="spinner"></div>
        </div>
    </div>
    <div class="overflow-hidden space position-relative z-index-common" style="margin-top:100px;"
        data-bg-src="{{ URL::asset('assets/frontend/img/bg_auth.png') }}">

        <div class="container-fuild">
            <div class="row">
                <div class="col-md-4"
                    style="background-image: url('{{ URL::asset('assets/frontend/img/prize.png') }}'); background-size: 70%; background-repeat: no-repeat; background-position: center;">
                    &nbsp;</div>

                <div class="col-md-4">
                    <div class="title-area text-center">
                        <h2 class="sec-title text-white">Register</h2>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form id="fx-register-form" method="POST" action="{{ route('userregister') }}"
                        onsubmit="this.querySelector('button[type=submit]').disabled = true;">
                        @csrf
                        <div class="row form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input autocomplete="new-first" type="text" name="firstname"
                                        class="form-control border" placeholder="First Name" value="{{ old('firstname') }}"
                                        required>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input autocomplete="new-lastname" type="text" name="lastname"
                                        class="form-control border" placeholder="Last Name" value="{{ old('lastname') }}"
                                        required>

                                </div>
                            </div>
                        </div>

                        <div class="row form-row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input autocomplete="new-email" type="email" name="email"
                                        class="form-control border @error('email') is-invalid @enderror" placeholder="Email"
                                        value="{{ old('email') }}" required>
                                    @error('email')
                                        <span class="invalid-feedback d-block text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <select name="nationalities" id="nationalities" class="form-control border w-100"
                                        required>
                                        <option value="" selected disabled>Nationality</option>
                                        @foreach ($nationalities as $national)
                                            <option value="{{ $national['id'] }}" data-code="{{ $national['tel'] }}"
                                                {{ old('nationalities') == $national['id'] ? 'selected' : '' }}>
                                                {{ $national['title_en'] }}
                                            </option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                        </div>

                        <div class="row form-row">
                            <div class="col-4">
                                <div class="form-group">
                                    <select name="country_code" id="country_code" class="form-control border select2"
                                        required>
                                        <option value="" selected disabled>Country Code</option>
                                        @foreach ($nationalities as $national)
                                            <option value="{{ $national['tel'] }}"
                                                {{ old('country_code') == $national['tel'] ? 'selected' : '' }}>
                                                +{{ $national['tel'] }} - {{ $national['title_en'] }}
                                            </option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>

                            <div class="col-8">
                                <div class="form-group">
                                    <input autocomplete="new-phone" type="text" name="contact_phone"
                                        class="form-control border" placeholder="Mobile Number"
                                        value="{{ old('contact_phone') }}" required>

                                </div>
                            </div>
                        </div>

                        <div class="row form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input autocomplete="new-password" type="password" name="password"
                                        class="form-control border" placeholder="Password" value="{{ old('password') }}"
                                        required>

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <input autocomplete="new-confirm-password" type="password" name="password_confirmation"
                                        class="form-control border" value="{{ old('password_confirmation') }}"
                                        placeholder="Confirm Password" required>

                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <input name="referral_code" value="{{ old('refCode', $refCode ?? '') }}"
                                class="form-control border" type="text" placeholder="Enter Referral Code">
                        </div>

                        {{-- <div class="row">
						<div class="col-md-12">
							<label class="text-white d-block mb-2">Mode of Registration</label>
							<div class="form-group d-flex flex-wrap">
								<div class="custom-control custom-radio mr-3 mb-2">
									<input type="radio" id="mode_online" name="registration_mode" value="Online" class="custom-control-input"  required {{ request('mode') == 'on' ? 'checked' : '' }}>
									<label class="custom-control-label text-white" for="mode_online">Online </label> &nbsp;&nbsp;&nbsp;
								</div>
								<div class="custom-control custom-radio mb-2 ml-3">
									<input type="radio" id="mode_offline" name="registration_mode" value="Offline" class="custom-control-input"  required {{ request('mode') == 'off' ? 'checked' : '' }}>
									<label class="custom-control-label text-white" for="mode_offline">Offline</label>
								</div>

							</div>
						</div>
					</div> --}}
                        <input type="hidden" name="registration_mode" value="Online">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mt-3 custom-checkbox notice">
                                    <input id="terms_and_conditions" value="1" name="terms_and_conditions"
                                        type="checkbox" {{ old('terms_and_conditions') ? 'checked' : '' }} required>
                                    <label for="terms_and_conditions" class="text-white">
                                        I accept the <a href="{{ url('/terms') }}">Terms & Conditions</a>
                                    </label>

                                </div>
                            </div>
                        </div>

                        <p class="form-row form-group"><button type="submit" value="Register"
                                class="th-btn w-100">Register</button></p>
                        <p class="mb-0 text-center">Do have an account? <a href="{{ url('/login') }}"
                                class="btn-inline text-white">Login here</a></p>
                    </form>

                </div>

                <div class="col-md-4"
                    style="background-image: url('{{ URL::asset('assets/frontend/img/vr.png') }}'); background-size: 100%; background-repeat: no-repeat; background-position: center;">
                    &nbsp;</div>

            </div>
        </div>
    </div>

    <!-- Terms and Condition Popup Modal -->
    <div id="termsModal" class="terms-modal" aria-hidden="true" role="dialog" aria-modal="true">
        <div class="terms-backdrop" data-close="backdrop"></div>
        <div class="terms-dialog" role="document" aria-labelledby="termsTitle">
            <button class="terms-close" type="button" aria-label="Close" data-close="btn">✕</button>
            <h3 id="termsTitle" class="terms-title">PROFXSPORTSCLUB Terms & Conditions</h3>

            <div class="terms-body" id="termsModalBody">
                <p class="tcpara"><strong>Welcome to PROFXSPORTSCLUB!</strong> We’re delighted to have you join our premier
                    online forex trading league, a platform to showcase your skills to the world and contribute to
                    setting a new Guinness World Record. These Terms and Conditions outline the rules for using our
                    website and participating in our league. By accessing our site and joining PROFXSPORTSCLUB, you agree
                    to abide by these terms in full. If you disagree with any part of these terms, please refrain from
                    using our website or participating.</p>

                <p class="tcpara"><strong>1. Introduction</strong><br>
                    <strong>Company Information:</strong> PROFXSPORTSCLUB is proudly organized and managed by ProFX Media.
                    For any inquiries, feel free to reach out to us at <a
                        href="mailto:info@profxleague.com">info@profxleague.com</a>.<br>
                    <strong>Purpose:</strong> PROFXSPORTSCLUB is a global forex trading league designed to let participants
                    display their trading skills, vie for rewards, and enhance their trading abilities while aiming to
                    set a new Guinness World Record, building on our previous success of 1,449 participants at ProFX
                    Expo MENA 2025 in Dubai, UAE, on April 10, 2025.<br>
                    <strong>Note:</strong> This league is not an investment opportunity; it is solely for skill
                    improvement and participation in a competitive format.
                </p>

                <p class="tcpara"><strong>2. Eligibility Age Requirement:</strong><br>
                    Participants must be 18 years or older.<br>
                    <strong>Legal Compliance:</strong> Participants must comply with all applicable local, state, and
                    national laws and regulations.<br>
                    <strong>Account Registration:</strong> You must create an account on our website and provide
                    accurate, complete information during registration.
                </p>

                <p class="tcpara"><strong>3. Registration and Fees Registration Fee:</strong><br>
                    A non-refundable fee of $25 is required to enter the league.<br>
                    <strong>Payment Structure:</strong> [Details to be provided by you, e.g., accepted payment methods,
                    deadlines, refund policies, or additional terms related to fees.]<br>
                    <strong>Payment Methods:</strong> All fees must be paid using the methods specified on our website
                    once the payment structure is finalized.
                </p>

                <p class="tcpara"><strong>4. League Structure Phases:</strong><br>
                    The league consists of four Pre-League Contests and one Main League Event, all conducted on TRADING
                    PLATFORM.<br>
                    <strong>Pre-League Contests:</strong> Starting Wednesday, September 10, 2025, four weekly 24-hour
                    challenges will occur every Wednesday (September 10, 17, 24, October 1, 2025). Performance is based
                    on the highest profit percentages.<br>
                    <strong>Main League Event:</strong> Wednesday, October 8, 2025, a 24-hour challenge where the top 20
                    traders compete based on the highest profit percentages.<br>
                    <strong>Time Zone:</strong> All events are held at UAE time (UTC+4).
                </p>

                <p class="tcpara"><strong>5. Rewards Cash Rewards:</strong><br>
                    The total prize pool is $10,000.<br>
                    • Pre-League Contests: Each week, the top 10 traders share $1,000 (1st: $400, 2nd: $200, 3rd: $100,
                    4th: $75, 5th: $50, 6th-10th: $35 each).<br>
                    • Main League Event: The top 20 traders share $6,000 (1st: $2,500, 2nd: $1,500, 3rd: $750, 4th:
                    $500, 5th: $250, 6th-10th: $100 each).<br>
                    <strong>Distribution:</strong> Rewards will be awarded based on final rankings and performance in
                    each phase.
                </p>

                <p class="tcpara"><strong>6. ProFX Club Membership Inclusion:</strong><br>
                    Inclusion: All league participants receive a free ProFX Club membership.<br>
                    <strong>Benefits:</strong> Enjoy market analysis, trading signals, educational resources, webinars
                    with industry experts, exclusive tools, and priority support. For more information, visit ProFX
                    Club.<br>
                    <strong>Non-transferable:</strong> ProFX Club memberships are non-transferable.
                </p>

                <p class="tcpara"><strong>7. Sponsorship and Marketing Sponsorship Packages:</strong><br>
                    Various packages are available, starting at $5,000.<br>
                    <strong>Brand Visibility:</strong> Sponsors will benefit from extensive branding opportunities and
                    access to participant data.<br>
                    <strong>Referral Program:</strong> Earn up to 10% commission for each new registration through your
                    unique referral link.
                </p>

                <p class="tcpara"><strong>8. Participant Conduct Integrity:</strong><br>
                    Uphold the highest standards of integrity and honesty.<br>
                    <strong>Prohibited Actions:</strong> Fraud, cheating, and dishonest behavior are strictly prohibited
                    and will result in instant bans and wallet freezes.<br>
                    <strong>Compliance:</strong> Follow all league rules and guidelines provided by PROFXSPORTSCLUB.
                </p>

                <p class="tcpara"><strong>9. Data Privacy Data Collection:</strong><br>
                    We collect personal information during registration and participation.<br>
                    <strong>Data Use:</strong> Your data will be used for managing the league, marketing, and
                    communication.<br>
                    <strong>Data Sharing:</strong> Your data may be shared with sponsors and partners per our Privacy
                    Policy.
                </p>

                <p class="tcpara"><strong>10. Limitation of Liability Disclaimer:</strong><br>
                    PROFXSPORTSCLUB is not liable for any financial losses or damages resulting from participation.<br>
                    <strong>No Guarantees:</strong> Participation does not ensure financial gain or success in forex
                    trading.
                </p>

                <p class="tcpara"><strong>11. Amendments Changes:</strong><br>
                    We reserve the right to amend these terms at any time.<br>
                    <strong>Notification:</strong> Any changes will be communicated via our website and email.
                </p>

                <p class="tcpara"><strong>12. Governing Law Jurisdiction:</strong><br>
                    These terms are governed by applicable laws.<br>
                    <strong>Dispute Resolution:</strong> Disputes will be resolved through binding arbitration.
                </p>

                <p class="tcpara"><strong>13. Contact Information Inquiries:</strong><br>
                    For any questions or concerns, please contact us at <a
                        href="mailto:info@profxleague.com">info@profxleague.com</a>.</p>

                <p class="tcpara">By participating in <strong>PROFXSPORTSCLUB</strong>, you acknowledge that you have read,
                    understood, and agree to these terms and conditions. We’re excited to have you on board and wish you
                    the best of luck as you showcase your skills to the world!</p>
                <p>
                    Welcome to PROFXSPORTSCLUB. By creating an account you agree to the following terms and conditions.
                    Please read them carefully. <strong>Key definitions</strong> and <strong>your obligations</strong> are
                    highlighted.
                </p>

            </div>

            <div class="modal-checkbox pt-4">
                <input type="checkbox" id="accept_terms_checkbox" required>
                <label for="accept_terms_checkbox" class="text-white">I have read and accept the Terms &
                    Conditions</label>
            </div>

            <div class="terms-actions d-flex flex-wrap align-items-center gap-2 justify-content-center">
                <button type="button" class="th-btn md:w-auto" id="termsAgreeBtn">I Agree</button>
                <button type="button" class="th-btn md:w-auto terms-cancel" data-close="btn">Cancel</button>
            </div>
        </div>
    </div>





@endsection
@push('before-styles')
    <link rel="stylesheet"
        href="{{ URL::asset('assets/frontend/vendor/intl-tel-input/css/intlTelInput.min.css') }}?v={{ Helper::system_version() }}" />
    {{-- integrate your custom css code/files here --}}
@endpush
@push('after-styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css?v=2&" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@1.5.2/dist/select2-bootstrap4.min.css?v=2&"
        rel="stylesheet" />
    {{-- integrate your custom css code/files here --}}

    <style>
        a {
            color: #45F882;
        }

        a:hover {
            color: #45F882;
            /* Replace with the color you want */
        }
    </style>
    <style>
        /* ===== Scrollbar (WebKit browsers: Chrome, Edge, Safari) ===== */
        .terms-body::-webkit-scrollbar {
            width: 8px;
            /* slim scrollbar */
        }

        .terms-body::-webkit-scrollbar-track {
            background: #0b0e13;
            /* dark background */
            border-radius: 8px;
        }

        .terms-body::-webkit-scrollbar-thumb {
            background: linear-gradient(180deg, var(--themebrandclr), #28b463);
            border-radius: 8px;
        }

        .terms-body::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(180deg, #28b463, var(--themebrandclr));
        }

        /* ===== Firefox ===== */
        .terms-body {
            scrollbar-width: thin;
            /* makes scrollbar smaller */
            scrollbar-color: var(--themebrandclr) #0b0e13;
        }


        /* Modal shell */
        .terms-modal {
            position: fixed;
            inset: 0;
            z-index: 1050;
            display: none;
        }

        .terms-modal.is-open {
            display: block;
        }

        .terms-backdrop {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, .6);
        }

        .terms-dialog {
            position: relative;
            margin: 24px auto;
            max-width: 720px;
            width: calc(100% - 24px);
            background: #0b0e13;
            color: #fff;
            border: 2px solid var(--themebrandclr);
            border-radius: 16px;
            padding: 18px 16px 16px;
            box-shadow: 0 12px 40px rgba(0, 0, 0, .45);
        }

        .terms-title {
            margin: 0 40px 12px 0;
            font-size: 1.25rem;
            color: #fff;
        }

        .terms-close {
            position: absolute;
            right: 10px;
            top: 10px;
            border: 1px solid var(--themebrandclr);
            background: transparent;
            color: #fff;
            border-radius: 999px;
            width: 32px;
            height: 32px;
            line-height: 30px;
            text-align: center;
            cursor: pointer;
        }

        .terms-close:hover {
            background: rgba(69, 248, 130, .12);
        }

        .terms-body {
            border: 1px solid var(--themebrandclr);
            border-radius: 12px;
            padding: 12px 14px;
            max-height: min(70vh, 640px);
            overflow: auto;
            scrollbar-gutter: stable both-edges;
        }

        .terms-body strong {
            color: var(--themebrandclr);
        }

        .terms-body h4 {
            margin: 14px 0 6px;
            font-size: 1rem;
            color: #fff;
        }

        .terms-body p,
        .terms-body li {
            color: #ffffff;
            line-height: 1.55;
        }

        .terms-actions {
            display: flex;
            gap: 10px;
            justify-content: flex-end;
            margin-top: 12px;
            flex-wrap: wrap;
        }

        .terms-actions .th-btn {
            padding: .6rem 1.2rem;
            border-radius: 12px;
        }

        .terms-actions .terms-cancel {
            background: #ffbe18;
            /* border: 1px solid var(--themebrandclr); */
            color: #0b0e13;
        }

        .terms-actions .terms-cancel:hover {
            background: #fff;
        }

        /* Responsive tweaks */
        @media (max-width: 640px) {
            .terms-dialog {
                width: calc(100% - 16px);
                margin: 12px auto;
                padding: 14px;
            }

            .terms-actions {
                flex-direction: column;
                align-items: stretch
            }
        }

        /* Prevent body scroll when modal open */
        .no-scroll {
            overflow: hidden !important;
            height: 100vh;
        }

        #termsAgreeBtn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }
    </style>
@endpush
@push('after-scripts')
    <script
        src="{{ URL::asset('assets/frontend/vendor/intl-tel-input/js/intlTelInput.min.js') }}?v={{ Helper::system_version() }}">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#fx-register-form").validate({
                ignore: [],
                rules: {
                    firstname: {
                        required: true
                    },
                    lastname: {
                        required: true
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    contact_phone: {
                        required: true,
                        digits: true,
                        minlength: 6,
                        maxlength: 15
                    },
                    password: {
                        required: true,
                        minlength: 6
                    },
                    password_confirmation: {
                        required: true,
                        equalTo: "[name='password']"
                    },
                    registration_mode: {
                        required: true
                    },
                    terms_and_conditions: {
                        required: true
                    }
                },
                errorElement: "div",
                errorPlacement: function(error, element) {
                    error.addClass("invalid-feedback");
                    element.closest(".form-group").append(error);
                },
                highlight: function(element) {
                    $(element).addClass("is-invalid");
                },
                unhighlight: function(element) {
                    $(element).removeClass("is-invalid");
                },
                submitHandler: function(form) {
                    $('#loadingOverlay').show();
                    $('.th-btn[type="submit"]').prop('disabled', true);
                    form.submit();
                }
            });
        });
        document.getElementById('nationalities').addEventListener('change', function() {
            let selectedOption = this.options[this.selectedIndex];
            let code = selectedOption.getAttribute('data-code');

            if (code) {
                let countryCodeSelect = document.getElementById('country_code');
                for (let i = 0; i < countryCodeSelect.options.length; i++) {
                    if (countryCodeSelect.options[i].value === code) {
                        countryCodeSelect.selectedIndex = i;
                        break;
                    }
                }
            }
        });
        window.addEventListener('pageshow', function() {
            // Re-enable submit button if back/redirect with validation errors
            document.querySelector('#fx-register-form button[type=submit]').disabled = false;
        });
    </script>


    {{--  Terms & Conditions Popup Modal --}}

    <!--<script>
        -- >
        <
        !--document.addEventListener("DOMContentLoaded", function() {
            -- >
            <
            !--
            const modal = document.getElementById("termsModal");
            -- >
            <
            !--
            const agreeBtn = document.getElementById("termsAgreeBtn");
            -- >
            <
            !--
            const checkbox = document.getElementById("terms_and_conditions");
            -- >
            <
            !--
            const label = document.querySelector("label[for='terms_and_conditions']");
            -- >

            <
            !-- function openModal() {
                -- >
                <
                !--modal.classList.add("is-open");
                -- >
                <
                !--document.body.classList.add("no-scroll");
                -- >
                <
                !--setTimeout(() => agreeBtn.focus(), 50);
                -- >
                <
                !--
            }-- >

            <
            !-- function closeModal() {
                -- >
                <
                !--modal.classList.remove("is-open");
                -- >
                <
                !--document.body.classList.remove("no-scroll");
                -- >
                <
                !--
            }-- >

            // ✅ Catch BEFORE browser toggles (on both checkbox and label)
            <
            !-- function intercept(e) {
                -- >
                if (!checkbox.checked) { // only when trying to check
                    e.preventDefault(); // stop it from auto-checking
                    openModal(); // show modal
                    <
                    !--
                }-- >
                // if already checked → allow normal uncheck
                <
                !--
            }-- >

            <
            !--checkbox.addEventListener("mousedown", intercept);
            -- >
            <
            !--label.addEventListener("mousedown", intercept);
            -- >

            // ✅ Agree → check the box and close modal
            <
            !--agreeBtn.addEventListener("click", function() {
                -- >
                <
                !--checkbox.checked = true;
                -- >
                <
                !--checkbox.dispatchEvent(new Event("change", {
                    -- >
                    <
                    !--bubbles: true-- >
                        <
                        !--
                }));
                -- >
                <
                !--closeModal();
                -- >
                <
                !--
            });
            -- >

            // ✅ Cancel/backdrop/ESC
            <
            !--modal.addEventListener("click", function(e) {
                -- >
                <
                !--
                if (e.target.closest("[data-close='btn']") || e.target.matches("[data-close='backdrop']")) {
                    -- >
                    <
                    !--closeModal();
                    -- >
                    <
                    !--
                }-- >
                <
                !--
            });
            -- >
            <
            !--document.addEventListener("keydown", function(e) {
                -- >
                <
                !--
                if (e.key === "Escape" && modal.classList.contains("is-open")) closeModal();
                -- >
                <
                !--
            });
            -- >
            <
            !--
        });
        -- >
        <
        !--
    </script>-->

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const modal = document.getElementById("termsModal");
            const agreeBtn = document.getElementById("termsAgreeBtn");
            const checkbox = document.getElementById("terms_and_conditions");
            const label = document.querySelector("label[for='terms_and_conditions']");
            const acceptTermsCheckbox = document.getElementById("accept_terms_checkbox");

            function openModal() {
                modal.classList.add("is-open");
                document.body.classList.add("no-scroll");
                setTimeout(() => agreeBtn.focus(), 50);
            }

            function closeModal() {
                modal.classList.remove("is-open");
                document.body.classList.remove("no-scroll");
            }

            //Catch BEFORE browser toggles (on both checkbox and label)
            function intercept(e) {
                if (!checkbox.checked) { // only when trying to check
                    e.preventDefault(); // stop it from auto-checking
                    openModal(); // show modal
                }
                // if already checked → allow normal uncheck
            }

            checkbox.addEventListener("mousedown", intercept);
            label.addEventListener("mousedown", intercept);

            // Inside modal: enable Agree button only when modal checkbox is ticked
            acceptTermsCheckbox.addEventListener("change", function() {
                agreeBtn.disabled = !this.checked;
            });

            // Agree → check the form checkbox, close modal
            agreeBtn.addEventListener("click", function() {
                checkbox.checked = true;
                checkbox.dispatchEvent(new Event("change", {
                    bubbles: true
                }));
                closeModal();
            });

            //Cancel/backdrop/ESC
            modal.addEventListener("click", function(e) {
                if (e.target.closest("[data-close='btn']") || e.target.matches("[data-close='backdrop']")) {
                    closeModal();
                }
            });
            document.addEventListener("keydown", function(e) {
                if (e.key === "Escape" && modal.classList.contains("is-open")) closeModal();
            });

            //Sync: if user unchecks the main form checkbox → reset modal checkbox
            checkbox.addEventListener("change", function() {
                if (!this.checked) {
                    acceptTermsCheckbox.checked = false;
                    agreeBtn.disabled = true;
                }
            });
        });
    </script>
@endpush
@section('footInclude')
    {{-- integrate your custom js code/files here --}}
@endsection
