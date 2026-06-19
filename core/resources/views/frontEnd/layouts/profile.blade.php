@extends('frontEnd.layouts.master')

@section('content')
    @php
        $user = Auth::user();
    @endphp

    <style>
        /* Premium Profile CSS with prefix up- */
        body {
            /* background-color: #f5f7fa; */
        }

        .up-profile-container {
            max-width: 1000px;
            margin: 40px auto;
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 30px;
            padding-inline: 24px;
            /* 👈 ensures side spacing */
            position: relative;
        }

        @media (max-width: 576px) {
            .up-profile-container {
                margin: 20px 12px;
                /* 👈 side margin */
                padding: 20px 16px;
                /* 👈 inner padding */
                border-radius: 12px;
            }
        }

        @media (max-width: 576px) {
            .up-premium-badge {
                position: relative;
                display: inline-block;
                margin-bottom: 12px;
                top: 0;
                right: 0;
            }
        }



        .up-premium-badge {
            position: absolute;
            top: -15px;
            right: -15px;
            background: linear-gradient(45deg, #ce3a38, #ef7e35);
            color: white;
            padding: 10px 20px;
            font-weight: 700;
            border-radius: 50px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            font-size: 0.9rem;
        }

        .up-profile-header {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 30px;
        }

        .up-profile-header img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 4px solid transparent;
            background:
                linear-gradient(#fff, #fff) padding-box,
                linear-gradient(90deg, #ef7e35 0%, #ce3a38 100%) border-box;
            object-fit: cover;
        }

        .up-profile-header .up-user-info h2 {
            margin: 0;
            color: #011c32;
            font-weight: 700;
        }

        .up-profile-header .up-user-info p {
            color: #555;
            margin: 5px 0;
        }

        .up-edit-btn {
            background: linear-gradient(90deg, #ef7e35 0%, #ce3a38 50%, #ef7e35 100%);
            background-size: 200% 100%;
            background-position: 0% 50%;
            color: #fff;
            border: none;
            padding: 8px 20px;
            border-radius: 50px;
            margin-top: 10px;
            transition: background-position 0.6s ease-in-out;
        }

        .up-edit-btn:hover {
            background-position: 100% 50%;
        }


        /* Stats cards */
        .up-stats-cards {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
            margin-bottom: 30px;
        }

        .up-stats-card {
            flex: 1 1 200px;
            background: #fff;
            color: #011c32;
            border-radius: 12px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }

        .up-stats-card:hover {
            transform: translateY(-5px);
        }

        .up-stats-card h3 {
            font-size: 1.5rem;
            margin: 10px 0 5px;
            color: #ef7e35;
        }

        .up-stats-card p {
            font-family: var(--text-font);
            margin: 0;
            font-weight: 500;
            color: #011c32;
        }

        /* Events Section */
        .up-events-section h4 {
            color: #ce3a38;
            margin-bottom: 15px;
            font-weight: 600;
        }

        .up-event-card {
            background: #f5f7fa;
            border-left: 5px solid #ce3a38;
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-weight: 600;
            color: #011c32;
        }

        /* Highlight Sections */
        .up-highlight-section {
            display: flex;
            gap: 15px;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }

        .up-highlight-card {
            flex: 1 1 250px;
            border-radius: 15px;
            overflow: hidden;
            position: relative;
            text-align: center;
            color: white;
            padding: 20px;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.3s;
        }

        .up-highlight-card img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 15px;
            margin-bottom: 10px;
        }

        .up-highlight-card:hover {
            transform: translateY(-5px);
        }

        .up-highlight-physical {
            /* background: linear-gradient(45deg, #ce3a38, #ef7e35); */
            background: linear-gradient(90deg, #ef7e35 0%, #ce3a38 50%, #ef7e35 100%);
        }

        .up-highlight-esports {
            /* background: linear-gradient(45deg, #011c32, #af3336); */
            background: linear-gradient(90deg, #ef7e35 0%, #ce3a38 50%, #ef7e35 100%);
        }

        .up-highlight-indoor {
            /* background: linear-gradient(45deg, #ef7e35, #011c32); */
            background: linear-gradient(90deg, #ef7e35 0%, #ce3a38 50%, #ef7e35 100%);
        }

        /* Activity Timeline */
        .up-activity-section h4 {
            color: #ce3a38;
            margin-bottom: 15px;
            font-weight: 600;
        }

        .up-activity-feed {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .up-activity-feed li {
            position: relative;
            padding-left: 30px;
            margin-bottom: 20px;
            color: #011c32;
        }

        .up-activity-feed li::before {
            content: '';
            position: absolute;
            left: 0;
            top: 3px;
            width: 12px;
            height: 12px;
            background: #ce3a38;
            border-radius: 50%;
        }

        @media (max-width: 768px) {
            .up-profile-header {
                flex-direction: column;
                text-align: center;
            }

            .up-stats-cards {
                flex-direction: column;
            }

            .up-stats-card {
                flex: 1 1 100%;
            }

            .up-highlight-section {
                flex-direction: column;
            }
        }
    </style>

    <section>
        <div class="up-profile-container">
            <div class="up-premium-badge">Profile</div>

            <!-- Profile Header -->
            <div class="up-profile-header">
                {{-- <img src="{{ asset('assets/images/resources/user-placeholder.png') }}" alt="Profile Image"> --}}
                <img src="https://avatar.iran.liara.run/public" alt="Profile Image">
                <div class="up-user-info">
                    <h2>{{ $user->name }}</h2>
                    <p>{{ $user->email }}</p>
                    <button class="up-edit-btn" data-bs-toggle="modal" data-bs-target="#upEditProfileModal">Edit
                        Profile</button>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="up-stats-cards">
                <div class="up-stats-card">

                    <p>Matches Played</p>
                    <h3>12</h3>
                </div>
                <div class="up-stats-card">
                    <p>Wins</p>
                    <h3>8</h3>
                </div>
                <div class="up-stats-card">
                    <p>XP Points</p>
                    <h3>1,250</h3>
                </div>
                <div class="up-stats-card">
                    <p>Leaderboard Position</p>
                    <h3>#5</h3>
                </div>
            </div>

            <!-- Highlights -->
            <div class="up-highlight-section">
                <div class="up-highlight-card up-highlight-physical">
                    <img src="{{ asset('assets/frontend/images/physicalsports.png') }}" alt="Physical Sports">
                    Physical Sports
                </div>
                <div class="up-highlight-card up-highlight-esports">
                    <img src="{{ asset('assets/frontend/images/esports.png') }}" alt="E-Gaming">
                    E-Gaming
                </div>
                <div class="up-highlight-card up-highlight-indoor">
                    <img src="{{ asset('assets/frontend/images/indoor.png') }}" alt="Indoor Sports">
                    Indoor Sports
                </div>
            </div>

            <!-- Upcoming Events -->
            <div class="up-events-section">
                <h4>Upcoming Events</h4>
                <div class="up-event-card">
                    Cricket Showdown - Mumbai <small>Jan 25, 2025</small>
                </div>
                <div class="up-event-card">
                    Warzone Battle - Abu Dhabi <small>Feb 10, 2025</small>
                </div>
            </div>

            <!-- Activity Timeline -->
            <div class="up-activity-section">
                <h4>Recent Activity</h4>
                <ul class="up-activity-feed">
                    <li>Joined PUBG Tournament</li>
                    <li>Won Cricket Match - Team Alpha</li>
                    <li>Voted for Fortnite Event</li>
                    <li>Completed Professional Development Training</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Edit Profile Modal -->
    <div class="modal fade" id="upEditProfileModal" tabindex="-1" aria-labelledby="upEditProfileModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header"
                    style="background: linear-gradient(90deg, #ef7e35 0%, #ce3a38 50%, #ef7e35 100%); color:white;">
                    <h5 class="modal-title text-white" id="upEditProfileModalLabel">Edit Profile</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="upProfileForm" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="upName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="upName" value="{{ $user->name }}" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="upEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="upEmail" value="{{ $user->email }}" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="upProfileImage" class="form-label">Profile Image</label>
                            <input class="form-control" type="file" id="upProfileImage" name="profile_image"
                                accept="image/*">
                        </div>
                        <button type="submit" class="up-edit-btn">Save Changes</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
    
@endsection
