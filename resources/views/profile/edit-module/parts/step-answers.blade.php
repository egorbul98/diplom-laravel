@if($step->type->id!=1)

<div class="wrap-step-answer">
    @if ($step->type->id==2){{-- "Текстовая задача" --}}
        @php $answers = $step->answersString; @endphp
    @elseif($step->type->id==3){{-- "Числовая" --}}
        @php $answers = $step->answersNum; @endphp
    @endif

    @foreach ($answers as $answer)
    <div class="step-answer">
        <div class="step-answer-inner">
            <div class="step-answer__item">
                <p>Правильный ответ: {{$answer->value}}</p>
            </div>
            @if($step->type->id==3){{-- "Числовая" --}}
            <div class="step-answer__item">
                <p>Допустимая погрешность: {{$answer->error}}</p>
            </div>
            @endif

        </div>
        <button class="btn btn-del" data-answer-id="{{$answer->id}}">Удалить</button>
    </div>
    @endforeach
</div>
<div class="step-answer-form">
    <div class="form">
        <div class="form-row">
            <div class="form-row__left">
                <p>Правильный ответ</p>
            </div>
            <div class="form-row__right form-field ">
                <input type="text" name="answer[]" class="@if($step->type->id==3) num-only @endif  value">
                <div class="form-field__tooltip">
                    <span class="text">Только [0-9] . - </span>
                </div>
            </div>
        </div>

        @if ($step->type->id==3)
        <div class="form-row">
            <div class="form-row__left">
                <p>Допустимая погрешность</p>
            </div>
            <div class="form-row__right form-field">
                <input type="text" name="error[]" class="num-only error">
                <div class="form-field__tooltip">
                    <span class="text">Только [0-9] . - </span>
                </div>
            </div>
        </div>
        @endif


    </div>
</div>
<button class="btn" id="btn-add-answer" data-step-id="{{$step->id}}" data-type-step-id="{{$step->type->id}}">Добавить
    правильный ответ</button>

@endif
