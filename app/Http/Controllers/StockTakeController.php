<?php

namespace App\Http\Controllers;

use App\Models\StockTakeTransaction;
use Illuminate\Http\Request;

class StockTakeController extends Controller
{
    //

    public function index()
    {
        //
        return view('stock_take.view');
    }

    public function print_stock_take($id)
    {
        $today = today()->format('d-M-y');
        $stock_take = StockTakeTransaction::with('site')->where('id', $id)->first();
        $status = 'Print Data !';
        return view('stock_take.print', compact('stock_take','today','status'));
    }
}
