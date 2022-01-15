<?php

namespace App\Http\Controllers;

use App\Http\Service\SecurityDAO;
use Illuminate\Http\Request;
use App\Models\UserModel;

class UsersRestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return SecurityDAO::findAllUsers();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return SecurityDAO::getUserById($id);
    }
}
