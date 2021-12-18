<?php
namespace App\Http\Service;

use Illuminate\Support\Facades\DB;

class OrderService {
    public static function createOrder($first_name, $last_name, $product) {
        try {
            DB::beginTransaction();
            $customer = CustomerDAO::addCustomer($first_name, $last_name);
            $order = OrderDAO::addOrder($customer->id, $product);
            $customer->order = $order;
            DB::commit();

            return $customer;
        } catch (\Exception $e) {
            DB::rollBack();
        }
    }
}
