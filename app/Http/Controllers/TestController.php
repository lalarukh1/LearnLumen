<?php

namespace App\Http\Controllers;

use App\Test;
use Illuminate\Http\Request;

class TestController extends Controller
{

    public function showAll()
    {
        return response()->json(Test::all());
    }

    public function showOne($id)
    {
        return response()->json(Test::find($id));
    }
}