<?php

namespace App\Models;

use App\DataBase\DataBase;
use PDO;

class Product extends Model
{
    public static function createProduct($title, $price, $price_discounted, $stock, $brand_id, $description)
    {
        $title = sanitise($title);
        $price = sanitise($price);
        $price_discounted = (int)($price_discounted);
        $description = sanitise($description);
        $stock = (!(int)$stock) ? null : (int)$stock;
        $brand_id = (!(int)$brand_id) ? null : (int)$brand_id;
        $slug = sluggable($title);
        $tracking_code = 'DSP-' . generateDigit(8);

        $action = new Model("INSERT INTO `products` (`brand_id`, `title`, `slug`, `price`, `price_discounted`, `stock`, `description`, `tracking_code`) VALUES (?,?,?,?,?,?,?,?);");

        $action->bindValue($brand_id, $title, $slug, $price, $price_discounted, $stock, $description, $tracking_code);

        if (!$action->execute()) {
            return false;
        }

        return $action->lastInsertId();
    }

    public static function getProducts()
    {
        $action = new Model("SELECT products.*, brands.title as brand_title 
                    From `products`
                        left join brands 
                            on products.brand_id = brands.id");

        $action->execute();

        if (!$action->rowCount() > 0) {
            return false;
        }

        return $action->fetchAllObject();
    }

    public static function updateProduct($id, $brand_id, $title, $description)
    {
        $title = sanitise($title);
        $description = sanitise($description);
        $brand_id = (!(int)$brand_id) ? null : (int)$brand_id;
        $id = (int)$id;
        $slug = sluggable($title);

        $action = new Model("update products set title = ?, description = ?, slug = ?, brand_id = ? where id = ?;");

        $action->execute([$title, $description, $slug, $brand_id, $id]);
    }

    public static function createPhotoProduct($photo_id, $product_id, $sort)
    {
        $photo_id = (int)$photo_id;
        $product_id = (int)$product_id;
        $sort = (int)$sort;

        $action = new Model("INSERT into photo_product (photo_id, product_id, sort) values (?, ?, ?);");

        return $action->execute([$photo_id, $product_id, $sort]);
    }

    public static function deletePhotoProduct($product_id, $sort)
    {
        $product_id = (int)$product_id;
        $sort = (int)$sort;

        $action = new Model("DELETE FROM photo_product where product_id = ? and sort = ?;");

        return $action->execute([$product_id, $sort]);
    }

    public static function createCategoryProduct($category_id, $product_id)
    {
        $category_id = (int)$category_id;
        $product_id = (int)$product_id;

        $action = new Model("INSERT into category_product (category_id, product_id) values (?, ?);");

        return $action->execute([$category_id, $product_id]);
    }
}
