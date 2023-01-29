<?php
class Products
{

    private $db;
    /**
     * Retrieve all products from database
     */
    public static function getAllProducts()
    {
        return DB::connect()->select(
            'SELECT * FROM products ORDER BY id DESC',
            [],
            true
        );
    }
    /**
     * Retrieve post data by id
     */
    public static function getProductsByID ( $products_id )
    {
        return DB::connect()->select(
            'SELECT * FROM products WHERE id = :id',
            [
                'id' => $products_id
            ]
            );
    }
    /**
     * Add new post
     */
    public static function add( $name, $price,  $image_url)
    {
        return DB::connect()->insert(
            'INSERT INTO products(name, price, image_url)
            VALUES (:name, :price, :image_url)',
            [
                'name' => $name,
                'price' => $price,
                // 'products_id' => $products_id,
                'image_url' => $image_url
            ]
        );
    }
    /**
     * Update post details
     */
    public static function update( $id, $name, $price,  $image_url, $status = null  )
    {
        //setup params
        $params = [
            'id' => $id,
            'name' => $name,
            'status' => $status,
            'price' => $price,
            'image_url' => $image_url
        ];
        // update post data into the database
        return DB::connect()->update(
            'UPDATE products SET name = :name, price = :price,  image_url = :image_url,status = :status WHERE id = :id', 
            $params
        );
    }
    /**
     * Delete post
     */
    public static function delete( $post_id )
    {
        return DB::connect()->delete(
            'DELETE FROM products where id = :id',
            [
                'id' => $post_id
            ]
            );
    }

    public function listAllProducts()
    {
        return DB::connect()->select(
            'SELECT * FROM products ORDER BY id DESC',
            [],
            true
        );
    }

    /**
     * Find product by id
     */
public static function findProduct($product_id) {
    return DB::connect()->select(
        'SELECT * FROM products WHERE id = :id',
        [
            'id' => $product_id
        ]
    );
}




}