<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>PROFXSPORTSCLUB Certificate</title>
    <style>
        @page {
            margin: 0px;
        }

        body {
            margin: 0;
            padding: 0;
            background-image: url('{{ asset('uploads/league_certificate/1761045529_Certificate_of_Participation.png') }}');
            background-repeat: no-repeat;
            background-position: center center;
            background-size: cover;
            font-family: 'DejaVu Sans', sans-serif;
            position: relative;
            height: 100vh;
            width: 100vw;
        }

        .name {
            position: absolute;
            top: 340px;
            left: 310px;
            font-size: 20px;
            font-weight: 600;
            color: #000;
        }

        .rank {
            position: absolute;
            top: 340px;
            right: 250px;
            font-size: 20px;
            font-weight: 600;
            color: #000;
        }

        .start-date {
            position: absolute;
            top: 390px;
            left: 280px;
            font-size: 18px;
            font-weight: 600;
            color: #000;
        }

        .end-date {
            position: absolute;
            top: 390px;
            right: 280px;
            font-size: 18px;
            font-weight: 600;
            color: #000;
        }
    </style>
</head>

<body>
    <div class="name">{{ $user->name }}</div>
    <div class="rank">{{ $league->rank ?? '-' }}</div>
    <div class="start-date">{{ \Carbon\Carbon::parse($league->start_date)->format('d M Y') }}</div>
    <div class="end-date">{{ \Carbon\Carbon::parse($league->end_date)->format('d M Y') }}</div>
</body>

</html>
