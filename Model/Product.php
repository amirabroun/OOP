<?php

namespace Models;

use DataBase\DataBase;
use PDO;

class Product extends Model
{
    function createProduct($title, $price, $price_discounted, $stock, $brand_id, $description)
    {
        $title = sanitise($title);
        $price = sanitise($price);
        $price_discounted = (int)($price_discounted);
        $description = sanitise($description);
        $stock = (!(int)$stock) ? null : (int)$stock;
        $brand_id = (!(int)$brand_id) ? null : (int)$brand_id;
        $slug = sluggable($title);
        $tracking_code = 'DSP-' . generateDigit(8);

        $sql = "INSERT INTO `products` (`brand_id`, `title`, `slug`, `price`, `price_discounted`, `stock`, `description`, `tracking_code`) VALUES (?,?,?,?,?,?,?,?);";

        $result = parent::$cn->prepare($sql);
        $result->bindValue(1, $brand_id);
        $result->bindValue(2, $title);
        $result->bindValue(3, $slug);
        $result->bindValue(4, $price);
        $result->bindValue(5, $price_discounted);
        $result->bindValue(6, $stock);
        $result->bindValue(7, $description);
        $result->bindValue(8, $tracking_code);

        if (!$result->execute()) {
            return false;
        }

        return parent::$cn->lastInsertId();
    }

    function getProducts()
    {
        $sql = "SELECT products.*, brands.title as brand_title 
                    From `products`
                        left join brands 
                            on products.brand_id = brands.id";

        $result = parent::$cn->prepare($sql);
        $result->execute();

        if (!$result->rowCount() > 0) {
            return false;
        }

        return $result->fetchAll(PDO::FETCH_OBJ);
    }

    function updateProduct($id, $brand_id, $title, $description)
    {
        $title = sanitise($title);
        $description = sanitise($description);
        $brand_id = (!(int)$brand_id) ? null : (int)$brand_id;
        $id = (int)$id;
        $slug = sluggable($title);

        $sql = "update products set title = ?, description = ?, slug = ?, brand_id = ? where id = ?;";

        $result = parent::$cn->prepare($sql);
        $result->bindValue(1, $title);
        $result->bindValue(2, $description);
        $result->bindValue(3, $slug);
        $result->bindValue(4, $brand_id);
        $result->bindValue(5, $id);

        if (!$result->execute()) {
            return false;
        }

        return true;
    }

    function createPhotoProduct($photo_id, $product_id, $sort)
    {
        $photo_id = (int)$photo_id;
        $product_id = (int)$product_id;
        $sort = (int)$sort;

        $sql = "insert into photo_product (photo_id, product_id, sort) values (?, ?, ?);";

        $result = parent::$cn->prepare($sql);
        $result->bindValue(1, $photo_id);
        $result->bindValue(2, $product_id);
        $result->bindValue(3, $sort);

        if (!$result->execute()) {
            return false;
        }

        return true;
    }

    function deletePhotoProduct($product_id, $sort)
    {
        $product_id = (int)$product_id;
        $sort = (int)$sort;

        $sql = "delete FROM photo_product where product_id = ? and sort = ?;";

        $result = parent::$cn->prepare($sql);
        $result->bindValue(1, $product_id);
        $result->bindValue(2, $sort);

        if (!$result->execute()) {
            return false;
        }

        return true;
    }

    function createCategoryProduct($category_id, $product_id)
    {
        $category_id = (int)$category_id;
        $product_id = (int)$product_id;

        $sql = "insert into category_product (category_id, product_id) values (?, ?);";
        
        $result = parent::$cn->prepare($sql);
        $result->bindValue(1, $category_id);
        $result->bindValue(2, $product_id);
        
        if (!$result->execute()) {
            return false;
        }
        
        return true;
    }
}
