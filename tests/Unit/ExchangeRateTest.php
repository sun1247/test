<?php

namespace Tests\Unit;

use Tests\TestCase;

class ExchangeRateTest extends TestCase
{
    /**
     * 測試成功
     *
     * @return void
     */
    public function testSuccess()
    {
        $response = $this->get('/api/exchangeRate?source=TWD&target=USD&amount=10');
        $response->assertStatus(200);
        $response->assertExactJson(
            [
                'msg' => 'success',
                'amount' => '$0.33',
            ]
        );
    }

    /**
     * 測試未帶入source
     *
     * @return void
     */
    public function testInvalidSource()
    {
        $response = $this->get('/api/exchangeRate?target=USD&amount=10');
        $response->assertStatus(200);
        $response->assertExactJson(
            [
                'msg' => 'error',
                'errorMsg' => '未帶入參數source',
            ]
        );
    }

    /**
     * 測試帶入source不支援幣別
     *
     * @return void
     */
    public function testNotSupportCurrencySource()
    {
        $response = $this->get('/api/exchangeRate?source=CNY&target=USD&amount=10');
        $response->assertStatus(200);
        $response->assertExactJson(
            [
                'msg' => 'error',
                'errorMsg' => '不支援CNY',
            ]
        );
    }

    /**
     * 測試未帶入target
     *
     * @return void
     */
    public function testInvalidTarget()
    {
        $response = $this->get('/api/exchangeRate?source=TWD&amount=10');
        $response->assertStatus(200);
        $response->assertExactJson(
            [
                'msg' => 'error',
                'errorMsg' => '未帶入參數target',
            ]
        );
    }

    /**
     * 測試帶入target不支援幣別
     *
     * @return void
     */
    public function testNotSupportCurrencyTarget()
    {
        $response = $this->get('/api/exchangeRate?source=JPY&target=CNY&amount=10');
        $response->assertStatus(200);
        $response->assertExactJson(
            [
                'msg' => 'error',
                'errorMsg' => '不支援CNY',
            ]
        );
    }

    /**
     * 測試未帶入amount
     *
     * @return void
     */
    public function testInvalidAmount()
    {
        $response = $this->get('/api/exchangeRate?source=TWD&target=USD');
        $response->assertStatus(200);
        $response->assertExactJson(
            [
                'msg' => 'error',
                'errorMsg' => '未帶入參數amount',
            ]
        );
    }
}
