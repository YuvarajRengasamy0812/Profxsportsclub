@extends('frontEnd.layouts.master')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
                confirmButtonText: 'OK'
            });
        </script>
    @endif
    <div class="home-page">
        <?php
        $title_var = 'title_' . @Helper::currentLanguage()->code;
        $title_var2 = 'title_' . config('smartend.default_language');
        $details_var = 'details_' . @Helper::currentLanguage()->code;
        $details_var2 = 'details_' . config('smartend.default_language');
        ?>

        @include('frontEnd.layouts.slider')
        @include('frontEnd.homepage.sliderad1')
        @include('frontEnd.homepage.counter')
        @include('frontEnd.homepage.faq')
        <!-- @include('frontEnd.homepage.aboutour') -->
        <!--@include('frontEnd.homepage.gallery')-->

        <!-- @include('frontEnd.homepage.travelplan') -->
        @include('frontEnd.homepage.upcomingevents')
        @include('frontEnd.homepage.joinmember')

        @include('frontEnd.homepage.sponsors')
        @include('frontEnd.homepage.blogs')
    </div>
@endsection
@push('after-styles')
    @if (Helper::GeneralSiteSettings('style_header') && Helper::GeneralSiteSettings('style_bg_type'))
        <style>
            .fixed-top-margin {
                margin-top: 0 !important;
            }


            .header-bg,
            .header-bg a {
                color: #444444;
            }

            @media (min-width: 968px) {

                .header-no-bg,
                .header-no-bg a,
                .topbar-no-bg,
                .topbar-no-bg a {
                    color: #fff;
                }

                .header-no-bg .navbar a,
                .topbar-no-bg .header-dropdown .btn {
                    color: #fff;
                }

                .dropdown-item {
                    color: #212529 !important;
                }

                .header-scrolled .navbar a,
                .header-scrolled .header-dropdown .btn {
                    color: #444444;
                }
            }

            .topbar-no-bg {
                box-shadow: 0 0 1px rgba(255, 255, 255, 0.5) !important;
            }
        </style>
    @endif
@endpush
