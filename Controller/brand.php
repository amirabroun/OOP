<?php

namespace Controller;

use Controller\Controller;
use Models\Brand;

class BrandController extends Controller
{
    use Controller;

    public function createBrand()
    {
        if (!validator(['title', 'description']))
            back();

        if (!(new Brand)->createBrand(POST('title'), POST('description'))) {
            $_SESSION['message'] = [
                'title' => 'عملیات ناموفق',
                'type' => 'error',
                'text' => 'عملیات با خطا مواجه شد!!',
            ];
        } else {
            $_SESSION['message'] = [
                'title' => 'عملیات موفق',
                'type' => 'success',
                'text' => 'سطر جدید درج شد!!',
            ];

            back();
        }
    }

    public function updateBrand()
    {
        if (!validator(['title_brand', 'description_brand']))
            back();

        if (!(new Brand)->updateBrand(POST('id_brand'), POST('title_brand'), POST('description_brand'))) {
            responseJson([
                'status' => 201,
                'message' => [
                    'title' => 'عملیات ناموفق',
                    'text' => 'عملیات ویرایش ناموفق بود!',
                    'type' => 'danger'
                ]
            ]);

            back();
        } else {
            responseJson([
                'status' => 200,
                'message' => [
                    'title' => 'عملیات موفق',
                    'text' => 'برند ویرایش گردید!',
                    'type' => 'success'
                ]
            ]);
        }
    }
}