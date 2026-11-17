<?php

return [
    'accepted' => 'Необходимо принять «:attribute».',
    'after' => 'Поле «:attribute» должно быть датой после :date.',
    'after_or_equal' => 'Поле «:attribute» должно быть датой не раньше :date.',
    'array' => 'Поле «:attribute» должно быть массивом.',
    'before' => 'Поле «:attribute» должно быть датой до :date.',
    'before_or_equal' => 'Поле «:attribute» должно быть датой не позже :date.',
    'between' => [
        'array' => 'Количество элементов в поле «:attribute» должно быть от :min до :max.',
        'file' => 'Размер файла в поле «:attribute» должен быть от :min до :max КБ.',
        'numeric' => 'Значение поля «:attribute» должно быть от :min до :max.',
        'string' => 'Количество символов в поле «:attribute» должно быть от :min до :max.',
    ],
    'boolean' => 'Поле «:attribute» должно быть логическим значением.',
    'confirmed' => 'Подтверждение поля «:attribute» не совпадает.',
    'current_password' => 'Неверный пароль.',
    'date' => 'Поле «:attribute» не является корректной датой.',
    'date_format' => 'Поле «:attribute» не соответствует формату :format.',
    'different' => 'Поля «:attribute» и «:other» должны различаться.',
    'digits' => 'Поле «:attribute» должно содержать :digits цифр.',
    'distinct' => 'Поле «:attribute» содержит повторяющееся значение.',
    'email' => 'Поле «:attribute» должно быть корректным email-адресом.',
    'exists' => 'Выбранное значение поля «:attribute» не существует.',
    'file' => 'Поле «:attribute» должно быть файлом.',
    'filled' => 'Поле «:attribute» должно быть заполнено.',
    'image' => 'Поле «:attribute» должно быть изображением.',
    'in' => 'Выбранное значение поля «:attribute» недопустимо.',
    'integer' => 'Поле «:attribute» должно быть целым числом.',
    'max' => [
        'array' => 'Количество элементов в поле «:attribute» не может превышать :max.',
        'file' => 'Размер файла в поле «:attribute» не может быть больше :max КБ.',
        'numeric' => 'Значение поля «:attribute» не может быть больше :max.',
        'string' => 'Количество символов в поле «:attribute» не может превышать :max.',
    ],
    'mimes' => 'Поле «:attribute» должно быть файлом одного из типов: :values.',
    'min' => [
        'array' => 'Количество элементов в поле «:attribute» должно быть не меньше :min.',
        'file' => 'Размер файла в поле «:attribute» должен быть не меньше :min КБ.',
        'numeric' => 'Значение поля «:attribute» должно быть не меньше :min.',
        'string' => 'Количество символов в поле «:attribute» должно быть не меньше :min.',
    ],
    'not_in' => 'Выбранное значение поля «:attribute» недопустимо.',
    'numeric' => 'Поле «:attribute» должно быть числом.',
    'present' => 'Поле «:attribute» должно присутствовать.',
    'regex' => 'Поле «:attribute» имеет неверный формат.',
    'required' => 'Поле «:attribute» обязательно для заполнения.',
    'required_if' => 'Поле «:attribute» обязательно, когда «:other» равно :value.',
    'required_with' => 'Поле «:attribute» обязательно, когда указано :values.',
    'required_without' => 'Поле «:attribute» обязательно, когда не указано :values.',
    'same' => 'Значения полей «:attribute» и «:other» должны совпадать.',
    'string' => 'Поле «:attribute» должно быть строкой.',
    'unique' => 'Такое значение поля «:attribute» уже занято.',
    'uploaded' => 'Не удалось загрузить файл «:attribute».',
    'url' => 'Поле «:attribute» имеет неверный формат ссылки.',

    /*
     | Свои сообщения для конкретных полей и правил.
     */
    'custom' => [
        'spent_at' => [
            'before_or_equal' => 'Дата траты не может быть в будущем.',
            'after_or_equal' => 'Дата траты не может быть раньше начала текущего года.',
        ],
    ],

    /*
     | Русские названия полей, подставляются вместо :attribute.
     */
    'attributes' => [
        'amount' => 'Количество токенов',
        'category_id' => 'Категория',
        'description' => 'Описание',
        'spent_at' => 'Дата траты',
        'name' => 'Имя',
        'email' => 'Email',
        'password' => 'Пароль',
        'password_confirmation' => 'Подтверждение пароля',
    ],
];
