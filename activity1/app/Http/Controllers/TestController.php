<?php

namespace App\Http\Controllers;

use App\Http\Service\OrderService;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function test() {
        return "Hello World from Test Controller";
    }

    public function test2() {
        return view('hello');
    }

    public function testCustomerProduct() {
        $customer = OrderService::createOrder('Josiah', 'Williamson', 'Cat Widget');
        return "<pre>".print_r($customer, true)."</pre>";
    }
}
