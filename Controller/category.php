<?php

namespace Controller;

use Models\Category as ModelsCategory;

class CategoryController
{
    public function createCategory()
    {
        if (!validator(['title', 'description', 'parent']))
            back();

        if (!(new ModelsCategory)->createCategory(POST('parent'), POST('title'), POST('description'))) {
            $_SESSION['message'] = [
                'title' => 'عملیات ناموفق',
                'type' => 'error',
                'text' => 'عملیات با خطا مواجه شد!!',
            ];

            back();
        }
        
        $_SESSION['message'] = [
            'title' => 'عملیات موفق',
            'type' => 'success',
            'text' => 'دسته بندی با موفقیت ثبت شد!',
        ];
    }

    public function updateCategory()
    {
        if (!validator(['title', 'description', 'parent']))
            back();

        if (!(new ModelsCategory)->updateCategory(POST('id'), POST('parent'), POST('title'), POST('description'))) {
            responseJson([
                'status' => 201,
                'message' => [
                    'title' => 'عملیات ناموفق',
                    'text' => 'عملیات با خطا مواجه شد!',
                    'type' => 'error'
                ]
            ]);
        }

        responseJson([
            'status' => 200,
            'message' => [
                'title' => 'عملیات موفق',
                'text' => 'دسته با موفقیت ویرایش شد!',
                'type' => 'success'
            ]
        ]);
    }
}
