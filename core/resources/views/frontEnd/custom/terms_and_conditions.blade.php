@extends('frontEnd.layouts.master')

@section('content')
    <link rel='stylesheet' href="{{ asset('wp-content/uploads/elementor/css/post-94e09.css?v=2&?ver=1714300778') }}"
        media='all' />
    <link rel='stylesheet' href="{{ asset('wp-content/uploads/elementor/css/post-5054b1.css?v=2&?ver=1714310689') }}"
        media='all' />
    <link rel='stylesheet' href="{{ asset('wp-content/themes/profx/style8a54.css?v=2&?ver=1.0.0') }}" media='all' />

    <style>
        .terms-container {
            margin: auto;
            padding: 50px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .terms-container .main-head {
            font-size: 30px !important;
            color: #fff;
        }

        .terms-container .sub-head {
            font-size: 25px !important;
            margin-top: 20px;
            color: #fff;
        }

        .terms-container .head {
            font-size: 15px !important;
            margin-top: 20px;
            color: var(--body-color);
        }

        p {
            margin: 0 0 10px;
            color: var(--body-color);
        }

        ul {
            margin: 0 0 10px 20px;
        }

        a {
            color: #0044cc;
        }
    </style>


    <div class="breadcumb-wrapper " data-bg-src="{{ URL::asset('assets/frontend/img/breadcumb-bg.png') }}">
        <div class="container">
            <div class="breadcumb-content">
                <h1 class="breadcumb-title">Terms & Conditions</h1>
                <ul class="breadcumb-menu">
                    <li><a href="{{ Helper::homeURL() }}">Home</a></li>
                    <li class="active">Terms & Conditions</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="overflow-hidden space position-relative z-index-common">
        <div class="gr-bg1 overlay"></div>
        <div class="container">
            <h2 class="sec-title">PROFXSPORTSCLUB Terms and Conditions</h2>
            <p>Welcome to PROFXSPORTSCLUB! We’re thrilled to have you join our forex trading competition. These Terms and
                Conditions outline the rules for using our website and participating in our competition. By accessing
                our site and joining the PROFXSPORTSCLUB, you agree to abide by these terms in full. If you disagree with
                any part of these terms, please refrain from using our website or participating.</p>

            <span class="sub-title style2">1. Introduction</span>
            <p><strong>Company Information:</strong> PROFXSPORTSCLUB is proudly organized and managed by ProFX Media. For
                any inquiries, feel free to reach out to us at <a
                    href="mailto:info@profxleague.com">info@profxleague.com</a>.</p>
            <p><strong>Purpose:</strong> PROFXSPORTSCLUB is a global forex trading competition aimed at letting
                participants showcase their trading skills, vie for prizes, and benefit from educational resources.</p>

            <span class="sub-title style2">2. Eligibility</span>
            <p><strong>Age Requirement:</strong> Participants must be 18 years or older.</p>
            <p><strong>Legal Compliance:</strong> Participants need to follow all applicable local, state, and national
                laws and regulations.</p>
            <p><strong>Account Registration:</strong> You must create an account on our website and provide accurate,
                complete information during registration.</p>

            <span class="sub-title style2">3. Registration and Fees</span>
            <p><strong>Registration Fee:</strong> A non-refundable fee of $50 is required to enter the competition.</p>
            <p><strong>Wild Card Entry Fee:</strong> If you’re eliminated after Round 3, you can rejoin in Round 4 by
                purchasing a Wild Card for $50.</p>
            <p><strong>Membership Fee:</strong> A ProFX Club membership is required, which is non-refundable.</p>
            <p><strong>Payment Methods:</strong> All fees must be paid using the methods specified on our website.</p>

            <span class="sub-title style2">4. Competition Structure</span>
            <p><strong>Rounds:</strong> The competition includes five rounds with distinct tasks and goals.</p>
            <p><strong>Demo Accounts:</strong> You will receive demo accounts for each round.</p>
            <p><strong>Evaluation Criteria:</strong> Your performance will be judged based on criteria set for each
                round.</p>
            <p><strong>Elimination:</strong> Participants with the lowest scores may be eliminated after each round.</p>

            <span class="sub-title style2">5. Wild Card</span>
            <p><strong>Eligibility:</strong> Only those eliminated after Round 3 can buy a Wild Card.</p>
            <p><strong>Re-entry:</strong> Wild Card holders can re-enter the competition in Round 4.</p>
            <p><strong>Non-transferable:</strong> Wild Cards cannot be transferred and are only valid for the original
                participant.</p>

            <span class="sub-title style2">6. Prizes and Rewards</span>
            <p><strong>Cash Prizes:</strong> There is a prize pool of $250,000 with guaranteed cash rewards for 500
                winners.</p>
            <p><strong>Other Rewards:</strong> Additional prizes like iPhones and Duke bikes will be given to top
                performers in pre-event tasks and practice sections.</p>
            <p><strong>Distribution:</strong> Prizes will be awarded based on final rankings and performance.</p>

            <span class="sub-title style2">7. Pre-Event Tasks</span>
            <p><strong>Schedule:</strong> Tasks will be conducted over six weeks before the competition begins.</p>
            <p><strong>Participation:</strong> All registered participants can join pre-event tasks.</p>
            <p><strong>Rewards:</strong> Top performers in pre-event tasks will receive various giveaways.</p>

            <span class="sub-title style2">8. ProFX Club Membership</span>
            <p><strong>Inclusion:</strong> All competition participants receive a free ProFX Club membership.</p>
            <p><strong>Benefits:</strong> Enjoy market analysis, trading signals, educational resources, webinars with
                industry experts, exclusive tools, and priority support. For more information, visit <a
                    href="http://www.ProFxClub.com">ProFX Club</a>.</p>
            <p><strong>Non-transferable:</strong> ProFX Club memberships are non-transferable.</p>

            <span class="sub-title style2">9. Sponsorship and Marketing</span>
            <p><strong>Sponsorship Packages:</strong> Various packages are available, starting at $25,000.</p>
            <p><strong>Brand Visibility:</strong> Sponsors will benefit from extensive branding opportunities and access
                to participant data.</p>
            <p><strong>Referral Program:</strong> Earn up to 10% commission for each new registration through your
                referral link.</p>

            <span class="sub-title style2">10. Participant Conduct</span>
            <p><strong>Integrity:</strong> Uphold the highest standards of integrity and honesty.</p>
            <p><strong>Prohibited Actions:</strong> Fraud, cheating, and dishonest behavior are strictly prohibited and
                will result in instant bans and wallet freezes.</p>
            <p><strong>Compliance:</strong> Follow all competition rules and guidelines provided by PROFXSPORTSCLUB.</p>

            <span class="sub-title style2">11. Data Privacy</span>
            <p><strong>Data Collection:</strong> We collect personal information during registration and participation.
            </p>
            <p><strong>Data Use:</strong> Your data will be used for managing the competition, marketing, and
                communication.</p>
            <p><strong>Data Sharing:</strong> Your data may be shared with sponsors and partners per our Privacy Policy.
            </p>

            <span class="sub-title style2">12. Limitation of Liability</span>
            <p><strong>Disclaimer:</strong> PROFXSPORTSCLUB is not liable for any financial losses or damages resulting
                from participation.</p>
            <p><strong>No Guarantees:</strong> Participation does not ensure financial gain or success in forex trading.
            </p>

            <span class="sub-title style2">13. Amendments</span>
            <p><strong>Changes:</strong> We reserve the right to amend these terms at any time.</p>
            <p><strong>Notification:</strong> Any changes will be communicated via our website and email.</p>

            <span class="sub-title style2">14. Governing Law</span>
            <p><strong>Jurisdiction:</strong> These terms are governed by applicable laws.</p>
            <p><strong>Dispute Resolution:</strong> Disputes will be resolved through binding arbitration.</p>

            <span class="sub-title style2">15. Contact Information</span>
            <p><strong>Inquiries:</strong> For any questions or concerns, please contact us at <a
                    href="mailto:info@profxleague.com">info@profxleague.com</a>.</p>

            <p>By participating in PROFXSPORTSCLUB, you acknowledge that you have read, understood, and agree to these
                terms and conditions. We’re excited to have you on board and wish you the best of luck in the
                competition!</p>
        </div>
    </div>
@endsection
