<?php

namespace App\Http\Controllers\api;

use App\Constant\Constant;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExchangeRateController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        if (!$request->get('source')) {
            return response()->json(['msg' => 'error', 'errorMsg' => '未帶入參數source']);
        }

        if (!in_array($request->get('source'), ['TWD', 'JPY', 'USD'])) {
            return response()->json(['msg' => 'error', 'errorMsg' => '不支援' . $request->get('source')]);
        }

        $soruce = $request->get('source');

        if (!$request->get('target')) {
            return response()->json(['msg' => 'error', 'errorMsg' => '未帶入參數target']);
        }

        if (!in_array($request->get('target'), ['TWD', 'JPY', 'USD'])) {
            return response()->json(['msg' => 'error', 'errorMsg' => '不支援' . $request->get('target')]);
        }

        $target = $request->get('target');
        
        if (!$request->get('amount')) {
            return response()->json(['msg' => 'error', 'errorMsg' => '未帶入參數amount']);
        }

        $amount = $request->get('amount');

        $exchangeRate = Constant::EXCHANGE_RATE;

        $afterAmount = number_format($exchangeRate[$soruce][$target] * $amount, 2, '.', ',');

        return response()->json(['msg' => 'success', 'amount' => '$' . (string)$afterAmount]);
    }
}
