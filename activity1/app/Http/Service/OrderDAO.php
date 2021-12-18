<?php
namespace App\Http\Service;

use App\Models\Order;

class OrderDAO {
    public static function addOrder($customer_id, $product) {
        $order = new Order();
        $order->product = $product;
        $order->customer_id = $customer_id;
        $order->save();
        return $order;
    }
}
