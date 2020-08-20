<?php

namespace App\Http\Controllers;

use App\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function listStock(){
        $stocks = Stock::where('active', 1)
            ->where('from','<=', date("Y-m-d",time()))
            ->orwherenull('from')
            ->where('to','>=', date("Y-m-d",time()))
            ->orwherenull('to')
            ->get();
        return view('stock.list', ['stocks' => $stocks]);
    }

    public function stock($id){
        $stock = Stock::find($id);
        return view('stock.stock', ['stock' => $stock]);
    }
}
