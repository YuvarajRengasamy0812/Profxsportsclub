@extends('frontEnd.layouts.master')

@section('content')
    <?php
    $user = auth()->user();
    ?>
    <style>
        .card-body.box-profile.fx-userpro-box {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .fx-avatar {
            position: relative;
            display: inline-block;
        }

        .fx-avatar .edit-icon {
            position: absolute;
            bottom: 0;
            right: 0;
            color: #45F882;
            border-radius: 50%;
            padding: 5px;
            font-size: 25px;
            transition: 0.3s;
        }

        .modal-dialog {
            max-width: 500px;
        }

        .modal-content {
            max-height: 600px;
            overflow-y: auto;
            padding: 1.5rem;
        }

        #bankModal .modal-body::-webkit-scrollbar {
            width: 10px;
        }

        #bankModal .modal-body::-webkit-scrollbar-track {
            background: #0b0e13;
            border-radius: 5px;
        }

        #bankModal .modal-body::-webkit-scrollbar-thumb {
            background-color: #45F882;
            border-radius: 5px;
            border: 2px solid #0b0e13;
        }

        #bankModal .modal-body {
            scrollbar-width: thin;
            scrollbar-color: #45F882 #0b0e13;
        }

        .th-btn-close {
            position: relative;
            width: 32px;
            height: 32px;
            background-color: #45F882;
            border: none;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background-color 0.3s, transform 0.2s;
        }

        .th-btn-close:hover {
            background-color: #3ac06f;
            transform: scale(1.1);
        }

        .th-btn-close:before,
        .th-btn-close:after {
            content: '';
            position: absolute;
            width: 16px;
            height: 2px;
            background-color: #fff;
            top: 50%;
            left: 50%;
            transform-origin: center;
        }

        .th-btn-close:before {
            transform: translate(-50%, -50%) rotate(45deg);
        }

        .th-btn-close:after {
            transform: translate(-50%, -50%) rotate(-45deg);
        }

        .error-msg {
            color: red;
            font-size: 13px;
            margin-top: 5px;
            display: block;
        }
    </style>

    <div class="overflow-hidden space position-relative z-index-common" style="margin-top:100px;">
        <div class="container">
            {{-- Success Message --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- Error Message --}}
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="row">
                <div id="sidebar-overlay" class="overlay w-100 vh-100 d-none position-fixed"></div>
                @include('frontEnd.user.usermenu')

                <div class="col-lg-10 col-sm-12">
                    <div class="row">
                        <div class="col-lg-12">
                            <h2 class="widget_title">PROFXSPORTSCLUB <span class="text-theme">Certificate List!</span> </h2>
                        </div>

                        <div class="col-lg-12 col-md-12 mt-3">
                            <div class="bg-transparent">
                                <div
                                    class="card-header h5 mb-0 text-white d-flex justify-content-between align-items-center">
                                    League Certificate Details!

                                </div>
                                <div class="card-body pb-0 text-white">
                                    <div style="width: 100%; overflow-x: auto;">
                                        <table class="table table-striped table-bordered text-white vertical-middle"
                                            style="min-width: 700px;">
                                            <thead>
                                                <tr>
                                                    <th class="text-white">#</th>
                                                    <th class="text-white">League Name</th>
                                                    <th class="text-white">Trade ID</th>
                                                    <th class="text-white">Register Date</th>
                                                    <th class="text-white">Deposit</th>
                                                    <th class="text-white">Profit</th>
                                                    <th class="text-white">Rank</th>
                                                    <th class="text-white">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($leaguedata as $index => $league)
                                                    <tr class="text-white text-center">
                                                        <td>{{ $index + 1 }}</td>
                                                        <td>{{ $league->leagurTitle ?? 'N/A' }}</td>
                                                        <td>{{ $league->trade_id ?? 'N/A' }}</td>
                                                        <td>{{ $league->Registered_Date ? date('d M Y', strtotime($league->Registered_Date)) : 'N/A' }}
                                                        </td>
                                                        <td>{{ $league->deposit ?? '0' }}</td>
                                                        <td>{{ $league->profit ?? '0' }}</td>
                                                        <td>{{ $league->rank ?? '-' }}</td>
                                                        <td>
                                                            <a href="{{ route('league.certificate.download', $league->tournament_id) }}"
                                                                class="th-btn" style="min-width:100px">
                                                                Download
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="8" class="text-center text-muted">No League
                                                            Certificates found.</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@push('after-scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
@endpush
