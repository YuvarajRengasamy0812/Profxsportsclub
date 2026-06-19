@props([
  'side' => 'right', // or left
  'items' => []
])

@push('styles')
<style>
  .fx-float {
    position: fixed;
    top: 50%;
    transform: translateY(-50%);
    z-index: 9999;
  }
  .fx-float--right { right: 20px; }
  .fx-float--left  { left: 20px; }

  .fx-float__toggle {
    width: 52px; height: 52px;
    display: flex; align-items: center; justify-content: center;
    border-radius: 50%;
    background: #0B1220;
    color: #fff; font-size: 24px;
    cursor: pointer;
    box-shadow: 0 8px 22px rgba(0,0,0,.28);
  }

  .fx-float__list {
    list-style: none; margin: 0; padding: 0;
    display: flex; flex-direction: column; gap: 12px;
    opacity: 0; pointer-events: none;
    transform: translateX({{ $side === 'right' ? '20px' : '-20px' }});
    transition: all .25s ease;
  }

  .fx-float.open .fx-float__list {
    opacity: 1; pointer-events: auto;
    transform: translateX(0);
  }

  .fx-float__item { position: relative; }
  .fx-float__link {
    width: 48px; height: 48px;
    display: flex; align-items: center; justify-content: center;
    border-radius: 50%;
    background: #0B1220;
    color: #fff; font-size: 20px;
    text-decoration: none;
    transition: transform .15s ease;
  }
  .fx-float__link:hover { transform: scale(1.1); }

  .fx-tip {
    position: absolute; top: 50%;
    transform: translateY(-50%);
    {{ $side === 'right' ? 'right:60px;' : 'left:60px;' }}
    background: #0B1220; color: #fff;
    padding: .35rem .6rem; border-radius: .35rem;
    opacity: 0; white-space: nowrap;
    transition: opacity .2s ease;
    font-size: .8rem;
  }
  .fx-float__item:hover .fx-tip { opacity: 1; }

  @media (max-width:768px){
    .fx-float { top:auto; bottom:18px; left:50%; right:auto; transform:translateX(-50%); }
    .fx-float__list { flex-direction: row; gap:14px; }
    .fx-tip { display:none; }
  }
</style>
@endpush

<nav class="fx-float fx-float--{{ $side }}" aria-label="Quick Links">
  <div class="fx-float__toggle" onclick="this.parentElement.classList.toggle('open')">
    <i class="bi bi-chat-dots"></i> <!-- main toggle icon -->
  </div>
  <ul class="fx-float__list">
    @foreach($items as $i)
      <li class="fx-float__item">
        <a href="{{ $i['href'] }}" class="fx-float__link" target="_blank" aria-label="{{ $i['label'] }}">
          <i class="{{ $i['icon'] }}"></i>
        </a>
        <span class="fx-tip">{{ $i['label'] }}</span>
      </li>
    @endforeach
  </ul>
</nav>
