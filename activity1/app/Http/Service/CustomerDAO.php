<?php
namespace App\Http\Service;

use App\Models\Customer;

class CustomerDAO {
    public static function addCustomer($first_name, $last_name) {
        $customer = new Customer();
        $customer->first_name = $first_name;
        $customer->last_name = $last_name;
        $customer->save();
        return $customer;
    }
}
