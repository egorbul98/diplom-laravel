<div class="reviews-item">
  <ul class="assessments">
    {{-- @dd( $review) --}}
    @for ($i = 1; $i < 6 ; $i++)
      <li class=" @if($i <= $review->stars) active @endif"><i class="fas fa-star"></i></li>
    @endfor
  </ul>
  <div class="reviews-item__comment">{{$review->text}}</div>
  <div class="reviews-item__footer">
    <a title="Показать профиль пользователя" href="#" class="reviews-item__author"> {{$review->user->fullname()}}
    </a>
     <span class="reviews-item__time">{{$review->updated_at->format("d.m.Y")}}</span>
  </div>
</div>