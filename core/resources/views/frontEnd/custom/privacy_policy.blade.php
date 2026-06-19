@extends('frontEnd.layouts.master')

@section('content')
    <link rel='stylesheet' href="{{ asset('wp-content/uploads/elementor/css/post-94e09.css?v=2&?ver=1714300778') }}"
        media='all' />
    <link rel='stylesheet' href="{{ asset('wp-content/uploads/elementor/css/post-5054b1.css?v=2&?ver=1714310689') }}"
        media='all' />
    <link rel='stylesheet' href="{{ asset('wp-content/themes/profx/style8a54.css?v=2&?ver=1.0.0') }}" media='all' />

    <style>
        .privacy-container {
            margin: auto;
            padding: 50px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .privacy-container .main-head {
            font-size: 30px !important;
            color: #fff;
        }

        .privacy-container .sub-head {
            font-size: 25px !important;
            margin-top: 20px;
            color: #fff;
        }

        .head {
            font-size: 15px !important;
            margin-top: 20px;
            color: #fff;
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
                <h1 class="breadcumb-title">Privacy Policy</h1>
                <ul class="breadcumb-menu">
                    <li><a href="{{ Helper::homeURL() }}">Home</a></li>
                    <li class="active">Privacy Policy</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="overflow-hidden space position-relative z-index-common">
        <div class="gr-bg1 overlay"></div>
        <div class="container">
            <h2 class="sec-title">PROFXSPORTSCLUB Privacy Policy</h2>
            <p>Welcome to PROFXSPORTSCLUB. We are committed to protecting your privacy. This Privacy Policy outlines how we
                collect, use, disclose, and safeguard your information when you visit our website <a
                    href="http://www.profxleague.com">www.profxleague.com</a> (the "Site") and participate in our forex
                trading competition. Please read this policy carefully to understand our views and practices regarding your
                personal data and how we will treat it.</p>

            <span class="sub-title style2">1. Information We Collect</span>

            <h3 class="head">1.1 Personal Information</h3>
            <p>We may collect personal information that you provide directly to us when you register for an account,
                participate in the competition, or communicate with us. This information may include:</p>
            <ul>
                <li>Name</li>
                <li>Email address</li>
                <li>Telephone number</li>
                <li>Date of birth</li>
                <li>Payment information (for registration and fees)</li>
                <li>Trading account details</li>
            </ul>

            <h3 class="head">1.2 Usage Data</h3>
            <p>We automatically collect certain information about your device and how you interact with our Site. This
                information may include:</p>
            <ul>
                <li>IP address</li>
                <li>Browser type</li>
                <li>Operating system</li>
                <li>Pages visited on our Site</li>
                <li>Time and date of visits</li>
                <li>Referring website</li>
            </ul>

            <h3 class="head">1.3 Cookies and Tracking Technologies</h3>
            <p>We use cookies and similar tracking technologies to track activity on our Site and hold certain information.
                You can instruct your browser to refuse all cookies or to indicate when a cookie is being sent. However, if
                you do not accept cookies, you may not be able to use some portions of our Site.</p>

            <span class="sub-title style2">2. How We Use Your Information</span>

            <h3 class="head">2.1 To Provide and Maintain Our Services</h3>
            <ul>
                <li>Process your registration and participation in the PROFXSPORTSCLUB</li>
                <li>Manage your account and provide customer support</li>
            </ul>

            <h3 class="head">2.2 To Improve Our Services</h3>
            <ul>
                <li>Analyze how you use our Site to improve functionality and user experience</li>
                <li>Develop new products, services, and features</li>
            </ul>

            <h3 class="head">2.3 To Communicate with You</h3>
            <ul>
                <li>Send administrative information, such as updates and changes to our terms, conditions, and policies</li>
                <li>Respond to your inquiries and requests</li>
            </ul>

            <h3 class="head">2.4 For Marketing and Promotional Purposes</h3>
            <ul>
                <li>Send you promotional materials and newsletters</li>
                <li>Inform you about special offers, upcoming events, and other news</li>
            </ul>

            <h3 class="head">2.5 To Enforce Our Terms and Conditions</h3>
            <ul>
                <li>Prevent and detect fraud, abuse, and other harmful activities</li>
                <li>Ensure compliance with our terms and policies</li>
            </ul>

            <span class="sub-title style2">3. Sharing Your Information</span>

            <h3 class="head">3.1 With Service Providers</h3>
            <p>We may share your information with third-party service providers who perform services on our behalf, such as
                payment processing, data analysis, email delivery, hosting services, and customer service.</p>

            <h3 class="head">3.2 With Sponsors and Partners</h3>
            <p>We may share your information with our sponsors and partners to facilitate their provision of services
                related to the competition, including prize distribution and marketing activities.</p>

            <h3 class="head">3.3 For Legal and Compliance Reasons</h3>
            <p>We may disclose your information if required to do so by law or in response to valid requests by public
                authorities (e.g., a court or a government agency).</p>

            <h3 class="head">3.4 Business Transfers</h3>
            <p>We may share or transfer your information in connection with, or during negotiations of, any merger, sale of
                company assets, financing, or acquisition of all or a portion of our business to another company.</p>

            <span class="sub-title style2">4. Data Security</span>
            <p>We use administrative, technical, and physical security measures to help protect your personal information.
                While we have taken reasonable steps to secure the personal information you provide to us, please be aware
                that no security measures are perfect or impenetrable, and we cannot guarantee the absolute security of your
                information.</p>

            <span class="sub-title style2">5. Your Data Protection Rights</span>

            <h3 class="head">5.1 Access</h3>
            <p>You have the right to request copies of your personal data.</p>

            <h3 class="head">5.2 Correction</h3>
            <p>You have the right to request that we correct any information you believe is inaccurate or complete
                information you believe is incomplete.</p>

            <h3 class="head">5.3 Deletion</h3>
            <p>You have the right to request that we delete your personal data, under certain conditions.</p>

            <h3 class="head">5.4 Restriction of Processing</h3>
            <p>You have the right to request that we restrict the processing of your personal data, under certain
                conditions.</p>

            <h3 class="head">5.5 Data Portability</h3>
            <p>You have the right to request that we transfer the data that we have collected to another organization, or
                directly to you, under certain conditions.</p>

            <h3 class="head">5.6 Objection to Processing</h3>
            <p>You have the right to object to our processing of your personal data, under certain conditions.</p>

            <p>To exercise any of these rights, please contact us at <a
                    href="mailto:info@profxleague.com">info@profxleague.com</a>.</p>

            <span class="sub-title style2">6. Third-Party Links</span>
            <p>Our Site may contain links to third-party websites and services that are not owned or controlled by us. We
                are not responsible for the privacy practices or the content of these third-party websites. We encourage you
                to review the privacy policies of any third-party websites you visit.</p>

            <span class="sub-title style2">7. Children's Privacy</span>
            <p>Our services are not directed to individuals under the age of 18. We do not knowingly collect personal
                information from children under 18. If we become aware that we have inadvertently received personal
                information from a user under the age of 18, we will delete such information from our records.</p>

            <span class="sub-title style2">8. Changes to This Privacy Policy</span>
            <p>We may update our Privacy Policy from time to time. We will notify you of any changes by posting the new
                Privacy Policy on this page and updating the "Last Updated" date at the top of this Privacy Policy. You are
                advised to review this Privacy Policy periodically for any changes. Changes to this Privacy Policy are
                effective when they are posted on this page.</p>

            <span class="sub-title style2">9. Contact Us</span>
            <p>If you have any questions or concerns about this Privacy Policy, please contact us at:</p>
            <ul>
                <li>Email: <a href="mailto:info@profxleague.com">info@profxleague.com</a></li>
                <li>Website: <a href="http://www.profxleague.com">www.profxleague.com</a></li>
            </ul>

            <p>By using our Site and participating in the PROFXSPORTSCLUB, you acknowledge that you have read, understood,
                and agreed to this Privacy Policy.</p>
        </div>
    </div>
@endsection
