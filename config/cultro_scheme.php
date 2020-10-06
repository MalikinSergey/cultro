<?php

return [

    'about' => [

        'name' => 'О сайте',

        'heading_field' => 'title',

        'multiple' => false,

        'fields' => [

            'title' => [
                'name' => 'Заголовок',
            ],

            'content' => [
                'name' => 'Текст',
                'type' => 'text',
            ],

        ]

    ],

    'news' => [

        'name_plural' => 'Новости',

        'name' => 'Новость',

        'heading_field' => 'title',

        'multiple' => true,

        'fields' => [

            'date' => [
                'name' => 'Дата',
                'type' => 'date',
            ],

            'title' => [
                'name' => 'Заголовок',
            ],

            'exc' => [
                'name' => 'Выдержка',
                'type' => 'exc',
            ],

            'content' => [
                'name' => 'Текст',
                'type' => 'text',
            ],

        ],

        'list' => [
            'fields' => ['date', 'title', 'content'],
            'order' => ['key' => 'date', 'direction' => 'desc']
        ]

    ],

    'articles' => [

        'name_plural' => 'Статьи',

        'name' => 'Статья',

        'heading_field' => 'title',

        'multiple' => true,

        'fields' => [

            'image' => [
                'type' => 'image',
                'name' => 'Изображение PNG 360х240',
                'format' => 'png',
                'width' => 360,
                'height' => 240,
            ],

            'date' => [
                'name' => 'Дата',
                'type' => 'date',
            ],

            'title' => [
                'name' => 'Заголовок',
            ],

            'link' => [
                'name' => 'Ссылка',
            ]

        ],

        'list' => [

            'fields' => ['date', 'title'],
            'order' => ['key' => 'date', 'direction' => 'desc']
        ]

    ],

];
