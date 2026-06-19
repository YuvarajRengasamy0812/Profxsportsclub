@php
    $hasChildren = $user->referrals->isNotEmpty();
    $collapseId = 'collapse-' . $user->id;
@endphp
@php
    $level = $level ?? 1;
@endphp
<div class="mt-2">
	<?PHP 
		if($user->photo != ''){
			$imagepath = URL::to('uploads/users/'.$user->photo);
		} else {
			$imagepath = URL::asset('assets/frontend/img/icon.png');
		}
	?>

    <div class="user-node">
	@if($hasChildren && $level < 4)
        <i class="bi bi-caret-down-fill toggle-icon me-2"
		   data-bs-toggle="collapse"
		   data-bs-target="#{{ $collapseId }}"
		   aria-expanded="true"
		   aria-controls="{{ $collapseId }}"></i>
    @else 
		<i class="bi me-4" aria-expanded="true">&nbsp;</i>
	@endif
        <img src="{{ $imagepath }}" class="user-img" alt="{{ $user->name }}">
        <span class="user-name">{{ $user->name }} </span>
    </div>

    @if($hasChildren && $level < 4)
        <div class="collapse tree-branch show" id="{{ $collapseId }}">
            @foreach($user->referrals as $referral)
				@include('frontEnd.user.referrednode', ['user' => $referral, 'level' => $level + 1])
            @endforeach
        </div>
    @endif
</div>
