@extends('frontEnd.layouts.master')
@section('content')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Marcellus&display=swap" rel="stylesheet">

    <style>
        /* Hero Section */
        .hero {
            background: linear-gradient(rgba(0, 0, 0, 0.55), rgba(0, 0, 0, 0.55)), url('{{ asset('assets/frontend/images/banner/blog.png') }}') center/cover no-repeat;
            padding: 120px 20px;
            text-align: center;
            color: white;
        }

        .hero h1 {
            font-size: 50px;
            font-family: "Marcellus", serif;
            margin-bottom: 14px;
            color: #fff;
        }

        .hero h3 {
            font-size: 22px;
            margin-bottom: 18px;
            font-weight: 400;
            color: #fff;
        }

        .hero p {
            max-width: 760px;
            margin: 0 auto 28px;
            font-size: 18px;
            line-height: 1.6;
            color: #fff;
        }

        .hero a {
            background: linear-gradient(90deg, #AF3336, #EF7E35);
            padding: 14px 32px;
            border-radius: 40px;
            color: white;
            font-weight: 700;
            text-decoration: none;
        }

        /* Wrapper */
        .utract-wrapper {
            max-width: 1350px;
            margin: 0 auto;
            padding: 20px 18px;
            display: flex;
            gap: 30px;
        }

        /* Left Blog Area */
        .utract-main {
            flex: 1;
            min-width: 0;
        }

        .utract-header {
            display: flex;
            flex-direction: column;
            margin-bottom: 20px;
        }

        .utract-eyebrow {
            color: #66788a;
            font-size: 16px;
            font-weight: 600;
        }

        .utract-h1 {
            font-size: 38px;
            font-weight: 700;
            color: #1C3D40;
            margin-top: 6px;
        }

        .utract-controls {
            display: flex;
            gap: 14px;
            flex-wrap: wrap;
            margin-top: 14px;
        }

        .utract-search {
            display: flex;
            align-items: center;
            background: #f3f7fb;
            padding: 8px 14px;
            border-radius: 999px;
        }

        .utract-search input {
            border: none;
            background: transparent;
            padding: 6px;
            outline: none;
            width: 220px;
            font-size: 14px;
        }

        .utract-chip {
            background: #f7f9fc;
            padding: 8px 14px;
            border-radius: 999px;
            font-size: 16px;
            color: #66788a;
            border: 1px solid #e5e9f0;
            cursor: pointer;
            transition: .2s;
        }

        .utract-chip--active {
            background: linear-gradient(90deg, #AF3336 0%, #EF7E35 100%);
            color: #fff;
            border-color: transparent;
        }

        /* Blog Grid */
        .utract-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-top: 20px;
        }

        .utract-card {
            background: white;
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, .05);
            transition: .2s;
        }

        .utract-card:hover {
            transform: translateY(-6px);
        }

        .utract-card img {
            width: 100%;
            aspect-ratio: 16/9;
            object-fit: cover;
        }

        .utract-body {
            padding: 16px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .utract-meta {
            font-size: 13px;
            color: #66788a;
            display: flex;
            gap: 6px;
        }

        .utract-title {
            margin: 0;
            font-size: 16px;
            font-weight: 500;
        }

        .utract-excerpt {
            font-size: 14px;
            color: #011C32;
        }

        .utract-tags {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .utract-tag {
            background: linear-gradient(90deg, #AF3336 0%, #EF7E35 100%);
            color: #fff;
            padding: 5px 9px;
            border-radius: 15px;
            font-size: 13px;
            font-weight: 700;
        }

        .utract-btn {
            background: var(--theme-color);
            border: none;
            padding: 8px 12px;
            color: #fff;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 700;
            font-size: 13px;
        }

        .card-actions {
            margin-top: auto;
            display: flex;
            gap: 8px;
            justify-content: center;
        }

        /* Right Sidebar */
        .utract-sidebar {
            width: 350px;
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
            gap: 22px;
            position: sticky;
            top: 20px;
            height: max-content;
        }

        .utract-form {
            background: white;
            padding: 18px;
            border-radius: 14px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, .05);
        }

        .utract-form h3 {
            margin: 0 0 8px;
            font-size: 18px;
            font-weight: 700;
            color: #1C3D40;
        }

        .utract-row {
            display: flex;
            flex-direction: column;
            margin-bottom: 16px;
        }

        label {
            font-size: 13px;
            color: #EF7E35;
            font-weight: 600;
            margin-bottom: 5px;
        }

        input,
        textarea,
        select {
            border: 1px solid #e5e9f2;
            padding: 10px;
            border-radius: 10px;
            outline: none;
            background: white;
            font-size: 14px;
        }

        textarea {
            min-height: 120px;
        }

        .utract-notice {
            background: #fff3d6;
            padding: 8px;
            border-left: 4px solid #ffc463;
            border-radius: 6px;
            font-size: 13px;
            color: #7a5b00;
        }

        .utract-imgpreview {
            width: 100%;
            height: 100px;
            object-fit: cover;
            border-radius: 10px;
            margin-top: 8px;
            display: none;
        }

        .select-wrap {
            position: relative
        }

        .select-wrap::after {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            pointer-events: none;
            color: #66788a;
            font-weight: 700
        }

        .form-card {
            background: #fff;
            padding: 22px;
            border-radius: 14px;
            box-shadow: 0 8px 26px rgba(0, 0, 0, .06)
        }

        .form-card label {
            display: block;
            font-weight: 700;
            margin: 12px 0 6px
        }

        .form-control {
            width: 100%;
            padding: 12px;
            border-radius: 10px;
            border: 1px solid #d6e0ec;
            font-size: 15px;
            background: #fff
        }

        .form-control:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(239, 126, 53, 0.08);
            border-color: var(--accent2)
        }

        /* Responsive */
        @media(max-width:1100px) {
            .utract-grid {
                grid-template-columns: 1fr;
            }
        }

        @media(max-width:900px) {
            .utract-wrapper {
                flex-direction: column;
            }

            .utract-sidebar {
                width: 100%;
                position: relative;
            }
        }
    </style>

    <!-- Hero -->
    <section class="hero">
        <div class="container">
            <h1>Blog: Forex & Sports</h1>
            <h3>Insights for Pros</h3>
            <p> Tips: Cricket lessons, PUBG parallels. Guest posts welcome.</p>
            <a href="{{ url('/membership') }}">Browse</a>
        </div>
    </section>

    <div class="utract-wrapper">

        <!-- LEFT: Blog Posts -->
        <section class="utract-main">
            <div class="utract-header">
                <div class="utract-h1">Forex-Focused Feeds: Latest Entries</div>
            </div>

            <!-- Controls -->
            <div class="utract-controls">
                <div class="utract-search">
                    <input id="utr-search" type="search" placeholder="Search posts…">
                    <button id="utr-clear" class="utract-chip">Clear</button>
                </div>

                <div class="utract-chiplist">
                    <button class="utract-chip utract-chip--active" data-filter="all">All</button>
                    <button class="utract-chip" data-filter="physical">Physical</button>
                    <button class="utract-chip" data-filter="e-sports">E-Sports</button>
                    <button class="utract-chip" data-filter="indoor">Indoor</button>
                    <button class="utract-chip" data-filter="tips">Tips</button>
                    <button class="utract-chip" data-filter="stories">Stories</button>
                </div>
            </div>

            <!-- Blog Grid -->
            <section id="utr-grid" class="utract-grid"></section>

            <div style="margin-top:18px; display:flex; justify-content:center;">
                <button id="utr-loadmore" class="utract-btn">Load More</button>
            </div>
        </section>

        <!-- RIGHT: Sidebar Form -->
        <aside class="utract-sidebar">
            <form class="utract-form" id="utr-guest">
                <h3>Submit Forex Blog Idea</h3>

                <div class="utract-row">
                    <label for="utr-title">Title *</label>
                    <input id="utr-title" type="text" required placeholder="Post title">
                </div>

                <div class="utract-row">
                    <label for="utr-content">Content * (500+ words)</label>
                    <textarea id="utr-content" placeholder="Write your content here..." required></textarea>
                    <div id="utr-content-error" class="utract-notice" style="display:none;">
                        Minimum 500 words required.
                    </div>
                </div>

                <div class="utract-row">
                    <label for="utr-bio">Author Bio</label>
                    <textarea id="utr-bio" placeholder="Short author bio (optional)"></textarea>
                </div>

                <div class="utract-row">
                    <label for="utr-image">Image Upload (optional)</label>
                    <input id="utr-image" type="file" accept="image/*">
                    <img id="utr-preview" class="utract-imgpreview" alt="Preview image">
                </div>

                <div class="utract-row">
                    <label for="utr-tags">Tags </label>
                    <div class="select-wrap">
                        <select id="utr-tags" multiple size="4"
                            class="form-control form-control-lg form-control-select">
                            <option value="physical">Physical</option>
                            <option value="e-sports">E-Sports</option>
                            <option value="tips">Tips</option>
                            <option value="stories">Stories</option>
                        </select>
                    </div>
                </div>

                <div class="utract-row" style="display:flex; gap:10px; flex-wrap:wrap;">
                    <button type="submit" class="utract-btn"
                        style="background: linear-gradient(90deg, #AF3336 0%, #EF7E35 100%); color:#fff;">Submit</button>
                </div>

                <div id="utr-guest-msg" class="utract-small" aria-live="polite"></div>
            </form>
        </aside>
    </div>

    <script>
        /* ----------------- POSTS DATA ----------------- */
        const UTR_POSTS = [{
                id: 1,
                date: "March 15, 2025",
                title: "Top Forex Trading Strategies for 2025",
                subheading: "Adaptive strategies for a volatile, AI-driven forex market.",
                author: "Dawood S, Marketing Manager at Profx Sports Club",
                readTime: "8 Min Read",
                tags: ["forex strategies 2025", "trading tips", "sports analogies"],

                image: "{{ asset('assets/frontend/images/players/blogsmallbox/1.png') }}",
                bg: "{{ asset('assets/frontend/images/players/blogbigbox/1.png') }}",
                introduction: "As forex markets evolve in 2025 with AI-driven volatility and global economic shifts, successful traders need adaptive strategies like never before. At Profx Sports Club, we've seen firsthand how sports—cricket derbies, PUBG squads—teach the discipline behind trendfollowing and breakouts. Research from FOREX.com highlights trend trading as a top performer, capturing 60% of major moves. For forex pros, blending these with athletic mindset yields consistent pips. This post breaks down five key strategies, drawing parallels to sports for real-world application. Whether you're a broker eyeing EUR/USD swings or a prop trader in volatile pairs, these insights, inspired by our sponsored events, will sharpen your game.",
                section1title: "Trend-Following – Ride the Momentum Like a Cricket Batsman",
                section1content: "Trend-following remains a cornerstone for 2025, thriving in AI-boosted markets where tools like MACD and moving averages spot directional biases. Enter trades aligning with the trend—buy in uptrends, sell in downtrends—aiming for 2:1 risk–reward ratios. Like a batsman riding loose deliveries for boundaries, timing is crucial. UAE derbies teach this discipline: Spot the trend, commit, and exit on reversal signals.",
                section2title: "Breakout Trading – Capitalize on Volatility Like a FIFA Counterattack",
                section2content: "Breakouts thrive in event-driven forex. Wait for a breach of support/resistance with volume confirmation. Like FIFA counterattacks, explosiveness post-consolidation is key. GBP/USD’s breakout above 1.30 in April 2025 delivered 200 pips with 1:3 RR setups.",
                section3title: "Swing Trading – Balance Like a Fitness Circuit",
                section3content: "Swing trading suits part-time traders, blending technicals with fundamentals. Similar to HIIT bursts, swings involve controlled entries on pullbacks and exits at extensions. AUD/USD delivered 150 pips in May 2025 on RBA-driven swings.",
                section4title: "Risk Management – The Athlete's Recovery",
                section4content: "Risk rules—1% max per trade and diversification—mirror athlete recovery. Review and adjust quarterly for long-term consistency."
            },

            {
                id: 2,
                date: "February 28, 2025",
                title: "Esports Trends 2025: How Mobile Gaming Boosts Forex Trader Focus",
                subheading: "Explore rising mobile esports and their parallels to quick-decision trading skills.",
                author: "Rajkumar, E-Sports Manager",
                readTime: "7 Min Read",
                image: "{{ asset('assets/frontend/images/players/blogsmallbox/2.png') }}",
                bg: "{{ asset('assets/frontend/images/players/blogbigbox/2.png') }}",
                tags: ["esports trends 2025", "mobile gaming forex", "trader focus"],
                introduction: "2025 marks esports maturation, with mobile titles like PUBG Mobile leading a 27.6% CAGR surge. For forex traders, these trends mirror high-stakes decision making. At Profx, our private PUBG tourneys sharpen squad tactics similar to pair correlations. This post explores mobile growth, creator teams, and Olympic esports—revealing how they boost trading agility.",
                section1title: "Mobile Esports Explosion – Scalping Parallels",
                section1content: "Mobile esports is growing fastest due to accessibility. PUBG Mobile's 500M+ view hours highlight dominance. For traders, this mimics scalping: Quick entries and exits on low-timeframe charts. Profx Warzone sessions show how fast thinking builds trading discipline.",
                section2title: "Creator-Backed Teams – Networking in Leagues",
                section2content: "Influencers like Disguised Toast launching esports teams signals a shift toward content-led competition. Similar to forex expos, these spaces amplify networking opportunities. Profx events harness this momentum for prop firm partnership building.",
                section3title: "Olympic Esports – Global Discipline",
                section3content: "IOC’s 2025 Esports Games legitimize competitive gaming. This discipline mirrors forex’s 24/7 intensity, building endurance that traders can apply during volatile market periods."
            },

            {
                id: 3,
                date: "April 10, 2025",
                title: "Cricket Lessons for Forex Traders: Mastering Patience and Momentum",
                subheading: "Draw strategic parallels between T20 tactics and trend trading for better pips.",
                author: "Yuraj, Physical Coordinator",
                readTime: "6 Min Read",
                image: "{{ asset('assets/frontend/images/players/blogsmallbox/3.png') }}",
                bg: "{{ asset('assets/frontend/images/players/blogbigbox/3.png') }}",
                tags: ["cricket trading analogies", "forex patience", "momentum strategies"],
                introduction: "Cricket's strategic depth—patience in Tests and momentum in T20s—mirrors forex's long holds vs scalps. In 2025’s volatile markets, Profx derbies teach traders to read conditions like cricket pitches. This blog connects wickets, overs, and innings to stop-losses, trends, and long-term trades.",
                section1title: "Patience in Tests – Position Trading",
                section1content: "Test cricket teaches endurance and avoiding impulsive shots, just like position trading relies on fundamentals over months. Holding GBP/USD through political cycles reflects this long-game strategy.",
                section2title: "T20 Momentum – Breakout Plays",
                section2content: "T20 cricket thrives on rapid momentum shifts. Breakouts mirror this aggression—entering right after consolidation. EUR/USD’s 2025 ECB breakout delivered clean pips using trailing stops.",
                section3title: "Injury Recovery – Risk Management",
                section3content: "Injuries remind athletes to manage risks. Traders replicate this through stop-losses and post-trade analysis to ensure resilience."
            },

            {
                id: 4,
                date: "June 5, 2025",
                title: "Fitness Routines for Busy Forex Traders: 20-Min Workouts for Sharp Focus",
                subheading: "Quick HIIT and yoga sessions to combat screen fatigue and boost decision-making.",
                author: "Wided A, Event Manager - Dubai",
                readTime: "7 Min Read",
                image: "{{ asset('assets/frontend/images/players/blogsmallbox/4.png') }}",
                bg: "{{ asset('assets/frontend/images/players/blogbigbox/4.png') }}",
                tags: ["fitness routines forex traders", "trader workouts", "mental clarity trading"],
                introduction: "Forex’s 24/7 nature drains mental clarity, but 20-min routines reduce stress by over 40%. Profx combines HIIT and yoga frameworks tailored for traders. This blog reveals how physical routines improve emotional balance and precision during trading hours.",
                section1title: "HIIT for High-Volatility Days",
                section1content: "HIIT mimics volatile markets—explosive, intense, and quick. Morning circuits boost dopamine and accelerate mental sharpness before major sessions.",
                section2title: "Yoga for Emotional Control",
                section2content: "Yoga reduces cortisol levels and helps traders overcome FOMO, tilt, and emotional overtrading. Even 10-minute desk flows improve breathing and calmness.",
                section3title: "Tracking Progress – Trader's Journal",
                section3content: "Tracking workouts like trades builds habit momentum. Weekly reviews help maintain consistency."

            },

            {
                id: 5,
                date: "July 22, 2025",
                title: "Networking Through Sports: Building Forex Alliances at Profx Events",
                subheading: "How cricket mixers and esports chats turn rivals into trading partners.",
                author: "Stanlis, IT Coordinator",
                readTime: "6 Min Read",
                image: "{{ asset('assets/frontend/images/players/blogsmallbox/5.png') }}",
                bg: "{{ asset('assets/frontend/images/players/blogbigbox/5.png') }}",
                tags: ["networking through sports finance", "forex events", "trader connections"],
                introduction: "70% of finance deals spark through sports networking. Profx events—from UAE cricket derbies to Gulf PUBG nights—create powerful alliance-building environments. Learn how traders convert friendships into partnerships.",

                section1title: "Post-Match Mixers – Deal Ignition",
                section1content: "Cricket gatherings strengthen relationships. At Profx Dubai events, over 50% of attendees report new trading leads.",
                section2title: "Esports Voice Chats – Instant Rapport",
                section2content: "PUBG squads create natural conversation channels. Many virtual teammates convert to real-world trading partners.",
                section3title: "Measuring ROI – Follow-Ups",
                section3content: "Tracking contacts like trades increases conversions. Aim for three follow-ups annually for strong alliances."
            },

            {
                id: 6,
                date: "May 12, 2025",
                title: "PUBG Strategies for Forex Traders: Survival Tactics for Volatile Markets",
                subheading: "From squad drops to stop-losses, PUBG hones trader instincts.",

                author: "Kailash, E Gaming Expert",
                readTime: "7 Min Read",
                tags: ["PUBG strategies traders", "battle royale forex", "risk tactics"],
                image: "{{ asset('assets/frontend/images/players/blogsmallbox/6.png') }}",
                bg: "{{ asset('assets/frontend/images/players/blogbigbox/6.png') }}",
                introduction: "PUBG’s 2025 boom teaches survival tactics ideal for forex volatility. Research shows gaming boosts decision-making speed. Profx lobbies simulate risk conditions similar to market entries, trends, and portfolio hedges.",
                section1title: "Hot Drops – Scalping Entries",
                section1content: "Hot drops mirror scalping during fast opens. Quick grabs and fast exits define both PUBG rushes and 5-minute forex setups.",
                section2title: "Circle Management – Trend Adaptation",
                section2content: "Shrinking circles force strategic pivots. Traders adapt similarly when volatility squeezes charts.",
                section3title: "Squad Synergy – Portfolio Diversification",
                section3content: "Coordinated squads mirror diversified trading portfolios. Journal reviews strengthen long-term consistency."
            },

            {
                id: 7,
                date: "August 18, 2025",
                title: "Mental Health for Forex Traders: Sports as Your Stress Shield",
                subheading: "Combat trading anxiety with cricket zen and esports endorphins.",
                author: "Safi M, Business Development Manager at Profx Sports",
                readTime: "8 Min Read",
                tags: ["mental health forex traders", "sports stress relief", "trader wellbeing"],
                image: "{{ asset('assets/frontend/images/players/blogsmallbox/7.png') }}",
                bg: "{{ asset('assets/frontend/images/players/blogbigbox/7.png') }}",
                introduction: "Forex stress affects nearly 80% of traders, but sports integration reduces anxiety by 30%. Profx events show how physical activity and gaming boosts mood and reduces cortisol. This blog highlights routines to manage trading anxiety.",
                section1title: "Stress Triggers – Market Parallels",
                section1content: "Drawdowns mimic sports losses. Post-event debriefs act as emotional resets to prevent tilt trading.",
                section2title: "Sports Endorphins – Mood Boosters",
                section2content: "Sports release dopamine and reduce cortisol. FIFA goals or cricket wins mirror the emotional highs traders feel after profitable trades.",
                section3title: "Building Resilience – Athlete Mindset",
                section3content: "Journaling failures and seeking expert feedback builds mental resilience similar to athletes' recovery protocols."


            },

            {
                id: 8,
                date: "September 3, 2025",
                title: "Sponsorships in Forex: How Profx Media Powers Trader Sports Events",
                subheading: "Unlock rewards from gear to trials via our exclusive partnerships.",
                author: "Dilavar D, Marketing Head",
                readTime: "6 Min Read",
                tags: ["sports sponsorships forex", "trader rewards", "profx partners"],
                image: "{{ asset('assets/frontend/images/players/blogsmallbox/8.png') }}",
                bg: "{{ asset('assets/frontend/images/players/blogbigbox/8.png') }}",
                introduction: "2025 sponsorship revenue surged 21%, empowering Profx’s forex-exclusive sports events. From jerseys to national esports trials, our partnerships support traders with gear, visibility, and career opportunities.",
                section1title: "Gear & Logistics – Zero-Cost Play",
                section1content: "Profx covers venues, kits, and logistics—allowing traders to focus purely on performance. Customized jerseys boost brand retention.",
                section2title: "Trials & Rewards – Career Catalysts",
                section2content: "Top performers earn sponsorships, media features, and event invitations. Mumbai FIFA trials expanded our scouting pipeline significantly.",
                section3title: "Partner Perks – Mutual Growth",
                section3content: "Co-branded events with brokers create dual growth pathways. Inquiry-based partnerships unlock perks for traders."
            }
        ];


        /* ----------------- CARDS SUBSET (5 POSTS ONLY) ----------------- */
        const CARD_POSTS = UTR_POSTS.slice(0, 8);

        /* ----------------- STATE ----------------- */
        let UTR_PAGE = {
            size: 8,
            visible: 8,
            filtered: CARD_POSTS.slice()
        };
        const UTR_ROOT = document.getElementById('utr-grid');
        const UTR_SEARCH = document.getElementById('utr-search');
        const UTR_LOAD = document.getElementById('utr-loadmore');
        const UTR_CHIPS = Array.from(document.querySelectorAll('.utract-chip'));

        /* ----------------- RENDER ----------------- */
        function renderUtract() {
            UTR_ROOT.innerHTML = '';
            const toShow = UTR_PAGE.filtered.slice(0, UTR_PAGE.visible);
            if (toShow.length === 0) {
                UTR_ROOT.innerHTML =
                    '<div style="grid-column:1/-1;padding:18px;text-align:center;color:#66788a">No posts found.</div>';
            } else {
                toShow.forEach(p => {
                    const el = document.createElement('article');
                    el.className = 'utract-card';
                    const query = new URLSearchParams({
                        title: p.title,
                        subheading: p.subheading || '',
                        author: p.author || '',
                        readTime: p.readTime || '',
                        date: p.date || '',
                        introduction: p.introduction || '',
                        section1title: p.section1title || '',
                        section1content: p.section1content || '',
                        section2title: p.section2title || '',
                        section2content: p.section2content || '',
                        section3title: p.section3title || '',
                        section3content: p.section3content || '',
                        image: p.image || '',
                        bg: p.bg || '',
                        tags: (p.tags || []).join(',')
                    });
                    el.innerHTML = `
        <img src="${p.image}" alt="${p.title}" class="utract-image">
        <div class="utract-body">
          <div class="utract-meta"><span>${p.date}</span><span>•</span><span>${p.readTime} reads</span></div>
          <h3 class="utract-title"><a href="/blogdetails?${query.toString()}" style="color:#011C32">${p.title}</a></h3>
          <div class="utract-excerpt">${p.author}</div>
          <div class="utract-tags">${p.tags.map(t=>`<span class="utract-tag">${t}</span>`).join('')}</div>
        <div class="card-actions" style="text-align:center; margin-top: 15px;">
    
</div>

      `;
                    UTR_ROOT.appendChild(el);
                });
            }

            UTR_LOAD.style.display = (UTR_PAGE.visible < UTR_PAGE.filtered.length) ? 'inline-block' : 'none';
        }

        /* ----------------- FILTER ----------------- */
        function applyUtractFilters() {
            const q = (UTR_SEARCH.value || '').trim().toLowerCase();
            const activeChip = document.querySelector('.utract-chip--active')?.dataset?.filter || 'all';

            // Filter only CARD_POSTS
            UTR_PAGE.filtered = CARD_POSTS.filter(p => {
                if (activeChip !== 'all' && !p.tags.includes(activeChip)) return false;
                if (!q) return true;
                return (p.title + ' ' + p.author + ' ' + p.tags.join(' ')).toLowerCase().includes(q);
            });

            UTR_PAGE.visible = UTR_PAGE.size;
            renderUtract();
        }

        /* ----------------- EVENTS ----------------- */
        UTR_CHIPS.forEach(ch => {
            ch.addEventListener('click', e => {
                UTR_CHIPS.forEach(c => c.classList.remove('utract-chip--active'));
                e.currentTarget.classList.add('utract-chip--active');
                applyUtractFilters();
            });
        });

        UTR_SEARCH.addEventListener('input', () => applyUtractFilters());
        document.getElementById('utr-clear').addEventListener('click', () => {
            UTR_SEARCH.value = '';
            applyUtractFilters();
        });

        UTR_LOAD.addEventListener('click', () => {
            UTR_PAGE.visible += UTR_PAGE.size;
            renderUtract();
        });

        /* ----------------- FORM ----------------- */
        const UTR_GUEST = document.getElementById('utr-guest');
        const UTR_CONTENT = document.getElementById('utr-content');
        const UTR_ERROR = document.getElementById('utr-content-error');
        const UTR_PREV = document.getElementById('utr-preview');
        const UTR_IMAGE = document.getElementById('utr-image');
        const UTR_GMSG = document.getElementById('utr-guest-msg');

        function wordCount(text) {
            return text.trim().split(/\s+/).filter(Boolean).length;
        }

        UTR_CONTENT.addEventListener('input', () => {
            const n = wordCount(UTR_CONTENT.value);
            if (n >= 500) UTR_ERROR.style.display = 'none';
        });

        UTR_IMAGE.addEventListener('change', e => {
            const f = e.target.files[0];
            if (!f) {
                UTR_PREV.style.display = 'none';
                return;
            }
            const r = new FileReader();
            r.onload = () => {
                UTR_PREV.src = r.result;
                UTR_PREV.style.display = 'block';
            }
            r.readAsDataURL(f);
        });

        UTR_GUEST.addEventListener('submit', e => {
            e.preventDefault();
            if (wordCount(UTR_CONTENT.value) < 500) {
                UTR_ERROR.style.display = 'block';
                UTR_GMSG.textContent = '';
                return;
            }
            const formData = {
                title: document.getElementById('utr-title').value,
                content: UTR_CONTENT.value,
                bio: document.getElementById('utr-bio').value,
                tags: Array.from(document.getElementById('utr-tags').selectedOptions).map(o => o.value),
                image: UTR_IMAGE.files[0] || null
            };
            console.log('Form Submitted:', formData);
            UTR_GMSG.textContent = 'Thank you — your post has been submitted for review.';
            UTR_GMSG.style.color = 'green';
            UTR_GUEST.reset();
            UTR_PREV.style.display = 'none';
            UTR_ERROR.style.display = 'none';
        });

        /* ----------------- INITIAL RENDER ----------------- */
        applyUtractFilters();
    </script>
@endsection
