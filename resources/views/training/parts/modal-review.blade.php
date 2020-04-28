<div class="modal modal--hidden modal-review">
  <div class="modal-window">
      <div class="modal-inner">
        @php $review = $user->reviews->where("course_id", $course->id)->first(); @endphp
        @if($review !=null)
          <form action="{{route("training.updateReview", $review->id)}}" method="POST">
        @else 
          <form action="{{route("training.createReview")}}" method="POST">
        @endif
            @csrf
            
            <input type="hidden" name="course_id" value="{{$course->id}}">
            <h2 class="title center">@lang('main.your_feedback')</h2>
            <div class="form-field form-field-rating">
             
                <p class="">@lang('main.your_mark')</p>
                @php $currentRating = ($review !=null) ? $review->stars : null;@endphp
                <div class="rating">
                  @for ($i = 5; $i > 0; $i--)
                    <input type="radio" id="star-{{$i}}" name="stars" value="{{$i}}" @if ($currentRating == $i) checked @endif>
                    <label for="star-{{$i}}" title="Оценка «{{$i}}»"><i class="fas fa-star"></i></label>	
                  @endfor
                </div>
            </div>
            <div class="form-field">
                <label for="text"></label>
                <textarea name="text" id="text" rows="10" placeholder="@lang('main.your_comment')">{{($review !=null) ? $review->text : ""}}</textarea>
            </div>
            <button class="btn" type="submit">@lang('main.save')</button>
          </form>
          <button class="modal-close" type="button"><i class="fas fa-times"></i></button>
      </div>
  </div>
</div>