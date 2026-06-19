@extends('frontEnd.layouts.master')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

   <section class="page-title centred pt_190 pb_190">
            <div class="bg-layer" style="background-image:url('{{ asset('assets/frontend/images/banner/banner-1.jpg') }}'"></div>
            <div class="auto-container">
                <div class="content-box">
                    <h1>Contact Us</h1>
                    <ul class="bread-crumb clearfix">
                        <li><a href="index-2.html">Home</a></li>
                        <li>Contact Us</li>
                    </ul>
                </div>
            </div>
        </section>
        <!-- page-title end -->


        <!-- contact-info-section -->
        <section class="contact-info-section centred pt_150">
            <div class="auto-container">
                <div class="sec-title centred mb_40">
                    <span class="sub-title">Contact us</span>
                    <h2>Contact Informations</h2>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-4 col-md-6 col-sm-12 info-block">
                        <div class="info-block-one">
                            <div class="inner-box">
                                <div class="icon-box"><i class="icon-41"></i></div>
                                <h3>Our Location</h3>
                                <p>Business Center 03<br>
RAKEZ Business Zone-FZRAK, UAE</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 info-block">
                        <div class="info-block-one">
                            <div class="inner-box">
                                <div class="icon-box"><i class="icon-42"></i></div>
                                <h3>Email Address</h3>
                                <p><a href="info@profxmedia.com">info@profxsportsclub.com</a> </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 info-block">
                        <div class="info-block-one">
                            <div class="inner-box">
                                <div class="icon-box"><i class="icon-43"></i></div>
                                <h3>Phone Number</h3>
                                <p><a href="tel:+971 588845033">971 58 884 5033</a> </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- contact-info-section end -->

 @if(session('success'))

        <?php    echo '1';
        ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
                confirmButtonText: 'OK'
            });
        </script>
    @endif

    @if(session('error'))

        <?php    echo '3';
        ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '{{ session('error') }}',
                confirmButtonText: 'OK'
            });
        </script>
    @endif
        <!-- contact-style-two -->
        <section class="contact-style-two pt_120 pb_150">
            <div class="auto-container">
                <div class="row clearfix">
                    <div class="col-lg-6 col-md-12 col-sm-12 content-column">
                        <div class="content-box mr_10">
                            <div class="sec-title mb_55">
                                <span class="sub-title">Get in touch</span>
                                <h2>Send a Message</h2>
                            </div>
                            <div class="form-inner">
  <form class="form-card reveal" method="POST" action="{{ route('profx.profx') }}">
    @csrf
                                    <div class="row clearfix">
                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                            <input type="text" name="name" placeholder="Your name" required>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                            <input type="email" name="email" placeholder="Your email" required>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                            <input type="text" name="phone" placeholder="Phone" required>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                            <input type="text" name="subject" placeholder="Subject" required>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                            <textarea name="comments" placeholder="Type message"></textarea>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 form-group message-btn">
                                            <button type="submit" class="theme-btn btn-one" name="submit-form">Send Message</button>
                                        </div>
                                    </div>
                                </form>                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12 form-column">
                        <div class="map-inner ml_10">
<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14369.811367795328!2d55.9762389!3d25.7886304!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ef677493230cdbf%3A0x7ec0eb41aebcca90!2sRAKEZ!5e0!3m2!1sen!2sae!4v1720102380640!5m2!1sen!2sae" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                       </div>
                    </div>
                </div>
            </div>
        </section>

@endsection


