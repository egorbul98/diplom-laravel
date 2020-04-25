<?php

return [
    'online_courses' => 'Онлайн курсы',
    'categories' => 'Категории',
    'all_courses' => 'Все курсы',
    'news' => 'Новости',
    'search' => 'Искать',
    'login' => 'Войти',
    'logout' => 'Выйти',
    'personal_area' => 'Личный кабинет',

    "reset" => "Сбросить",
    "save" => "Сохранить",
    "сreate" => "Создать",
    "title" => "Название",
    "there_is_nothing" => "Здесь ничего нет",
    "delete" => "Удалить",
    "menu" => "Меню",
    'registration'=>"Регистрация",
    'catalog'=>'Каталог',
    'new_courses'=>'Новые курсы',
    'popular_courses'=>'Популярные курсы',
    'recommended_for_study'=>'Рекомендуем к изучению',
    'home'=>'Главная',
    'about'=>'О нас',
    'we_are_in_social_networks'=>'Мы в социальных сетях',
    'section'=>'Раздел',
    'sections'=>'Разделы',


    //profile
    'show_module_trees'=>'Показать деревья модулей',
    'edit_description'=>'Редактировать описание',
    'edit_sections'=>'Редактировать разделы',
    'course_editing'=>'Редактирование курса',
    'creating_a_new_course'=>'Создание нового курса',
    'edit'=>'Редактировать',
    'module_trees'=>'Деревья модулей',
    'edit_course_sections'=>'Редактировать разделы курса',
    'secitions_modules'=>'модуль|модуля|модулей',
    'short_description'=>'Краткое описание',
    'about_the_course'=>'О курсе',
    'select_a_category'=>'Выберите категорию',
    'picture'=>'Изображение',
    'the_percentage_of_knowledge_at_which_the_module_will_repeat'=>'Процент знаний, при котором будет повторение модуля',
    'go_to_section_editing'=>'Перейти к редактированию разделов',
    'go_to_course_list'=>'Перейти к списоку курсов',
    'your_created_courses'=>'Ваши созданные курсы',

    'training'=>'Обучение',
    'learning-path'=>'Траектория обучения',
    'leave_feedback_about_this_course'=>'Оставить отзыв о данном курсе',
    'course_progress'=>'Прогресс по курсу',
    'recent_achievements'=>'Последние достижения',
    
    'rating'=>'Оценки',
    'the_course_includes'=>'В курс входят',
    'theoretical_modules'=>'Теоретических модулей',
    'text_tasks'=>'Текстовых задач',
    'numerical_tasks'=>'Числовых задач',
    'last_update'=>'Последнее обновление',
    'social_networks'=>'Социальные сети',

    'filter'=>[
        "filter"=>'Фильтр',
        "rating"=>'Рейтинг',
        "apply_filter"=>'Применить фильтр',
    ],
    
    "tooltips" => [
        "characters_max"=>"Не более :num символов",
        "at_least_characters"=>"Не менее :num символов",
    ],

    "ru" => "Русский",
    "en" => "English",
];
// @lang('main.welcome')

// <p class="course-sections-item__count-models"><span>{{$section->modules->count()}}</span> {{Lang::choice('main.secitions_modules', $section->modules->count(), [], ($locale==null)? "ru" : $locale)}}</p>