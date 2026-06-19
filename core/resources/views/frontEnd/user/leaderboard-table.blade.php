            <!--<div class="table-responsive">-->
            <!--    <table class="table tournament-table">-->
            <!--        <thead>-->
            <!--            <tr class="text-center">-->
            <!--               <th>SNo</th>-->
            <!--               <th>Name</th> -->
            <!--			   <th>Country</th>-->
            <!--			   <th>Deposit</th>-->
            <!--               <th>Balance</th> -->
            <!--			   <th>Equity</th>-->
            <!--               <th>Profit(%)</th> -->
            <!--			   <th>#Rank</th> -->
            <!--            </tr>-->
            <!--        </thead>-->
            <!--        <div style="overflow-x:auto; max-width:100%;">-->
            <!--		<tbody>-->
            <!--		    @foreach($liveaccountData as $leader)-->
            <!--		    <tr class="text-center">-->
            <!--                <td class="fontSize">{{ $leader->randuser }}</td>-->
            <!--                <td class="text-start d-flex align-items-center">-->
            <!--				@if($leader->profile_image)-->
            <!--				    <img style="border-radius: 50px;" src="{{ asset($leader->profile_image) }}" width="30" height="30" />-->
            <!--                @else-->
            <!--                    <img style="border-radius: 50px;" src="{{ asset('assets/frontend/img/user.png') }}" width="30" height="30" />-->
            <!--                @endif-->
            <!--				<span class="fontSize">{{ ucfirst($leader->name) }}</span>-->
            <!--			    </td>-->
            <!--                <td><img src="https://flagcdn.com/24x18/{{ strtolower($leader->ccode) }}.png" alt="{{ $leader->ccode }}" /></td>-->
            <!--                <td class="fontSize">$10000</td>-->
            <!--                <td class="fontSize">${{ $leader->Balance }}</td>-->
            <!--				<td class="fontSize">${{ $leader->equity }}</td>-->
            <!--				<td class="fontSize">{{ $leader->profit_percent }}</td>-->
            <!--				<td class="text-start">-->
            <!--                    @if(!empty($leader->rank))-->
            <!--                        <img src="{{ asset('assets/winnercup.png') }}" alt="" />-->
            <!--                        <span class=fontSize>{{ $leader->rank }}</span>-->
            <!--                    @else-->
            <!--                        --->
            <!--                    @endif-->
            <!--                </td>-->
            <!--            </tr>-->
            <!--            @endforeach-->
            <!--		</tbody>-->
            <!--		</div>-->
            <!--   </table>-->
            <!--</div>-->
            <div class="table-responsive">
    <table class="table tournament-table">
        <thead>
            <tr class="text-center">
               <th>SNo</th>
               <th>Name</th> 
               <th>Country</th>
               <th>Deposit</th>
               <th>Balance</th> 
               <th>Equity</th>
               <th>Profit(%)</th> 
               <th>#Rank</th> 
            </tr>
        </thead>
        <tbody>
            @forelse($liveaccountData as $leader)
                <tr class="text-center">
                    <td class="fontSize">{{ $leader->randuser }}</td>
                    <td class="text-start d-flex align-items-center">
                        @if($leader->profile_image)
                            <img style="border-radius: 50px;" src="{{ asset($leader->profile_image) }}" width="30" height="30" />
                        @else
                            <img style="border-radius: 50px;" src="{{ asset('assets/frontend/img/user.png') }}" width="30" height="30" />
                        @endif
                        <span class="fontSize ms-2">{{ ucfirst($leader->name) }}</span>
                    </td>
                    <td>
                        <img src="https://flagcdn.com/24x18/{{ strtolower($leader->ccode) }}.png" alt="{{ $leader->ccode }}" />
                    </td>
                    <td class="fontSize">$10000</td>
                    <td class="fontSize">${{ $leader->Balance }}</td>
                    <td class="fontSize">${{ $leader->equity }}</td>
                    <td class="fontSize">{{ $leader->profit_percent }}</td>
                    <td class="text-start">
                        @if(!empty($leader->rank))
                            <img src="{{ asset('assets/winnercup.png') }}" alt="" />
                            <span class="fontSize">{{ $leader->rank }}</span>
                        @else
                            -
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                  <td colspan="8" class="text-center text-muted text-white">
                    🚀 The <strong>{{ $latestleague->leagurTitle }}</strong> tournament is starting soon.<br>
                    The leaderboard will be visible once the tournament begins.
                </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
            <style>
                @media (max-width: 1000px) {
                  .fontSize {
                    font-size: 1rem !important;
                  }
                }
            </style>
