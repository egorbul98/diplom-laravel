<div class="select-wrap select-competences">
    <div class="select-custom">
        <div class="select-competences__left">
            <div class="list">
               
                @php $id_competences = []; @endphp
                @forelse ($module_competences as $item)
                {{-- @dump($item->id) --}}
                @php $id_competences[] = $item->title;@endphp
                <div class="select-competences-item">
                    <p class="text"><input type="text" value="{{$item->title}}" class="input-bg" readonly></p>
                </div>
                @empty
                <p>Пока ничего нет, но вы можете добавить новые компетенции</p>
                @endforelse

            </div>
            <div class="select-competences__desc">Компетенции, входящие в модуль</div>
        </div>
        
        <div class="select-competences__right">
            <div class="checkboxes">
              {{-- {{dump($id_competences)}} --}}
                @foreach ($section->competences as $competence)
              {{-- {{dump($competence->id)}} --}}
                <p class="flex-b">
                    <label>
                        <input type="checkbox" class="checkboxes__input" name="complex" value="{{$competence->id}}" @if (in_array($competence->title, $id_competences)) data-checked="true" @endif>
                        <span class="check"></span>
                        <span class="text paragraph">{{$competence->title}}</span>
                    </label>
                    <button class="btn-delete-competence btn-bg" type="button"
                        data-competence-id="{{$competence->id}}"><span class="icon"><i
                                class="fas fa-times"></i></span></button>
                </p>
                @endforeach

            </div>
            <div class="form-row input-add-competences form-field">
                <input type="text" class="input-control" placeholder="Название компетенции">
                <div class="form-field__tooltip">
                    <span class="text">Не более 128 символов</span>
                </div>
                
                <button class="btn btn-add" data-section-id="{{$section->id}}" type="button"><i
                        class="fas fa-plus"></i></button>
            </div>
            <div class="select-competences__desc">Выберите компетенции</div>
        </div>
    </div>
    
</div>
