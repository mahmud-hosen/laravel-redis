<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;
use DB;


class RedisTestController extends Controller
{
    public function index(){

        // DB::listen(function ($query) {
        //     info("Query time: {$query->time}ms", ['query' => $query->sql, 'bindings' => $query->bindings]);
        // });

        $subscription_infos = DB::table('gen_all_ser_subscription_infos')
            ->select('id','date','msisdn')
            ->get();

        // dd($subscription_infos);

        // Redis::set('subscription_infos', $subscription_infos);
        // $subscription_infos = Redis::get('subscription_infos');
        // count($value);
        // dd($value);


        // SQL Execution Time
        $startMysql = microtime(true);

            $subscriptionInfosMysql = DB::table('gen_all_ser_subscription_infos')
                ->select('id', 'date', 'msisdn')
                ->get();

        $endMysql = microtime(true);

        $mysqlExecutionTime = ($endMysql - $startMysql);

        // Redis Execution Time
        $startRedis = microtime(true);

            $subscriptionInfosRedis = Redis::get('subscription_infos');

        $endRedis = microtime(true);
        $redisExecutionTime = ($endRedis - $startRedis);

        
        $totalRows =  count($subscription_infos);
        
        echo "Total Rows:".$totalRows."<br>";
        echo "SQL Execution Time:    ".$mysqlExecutionTime." micro seconds"."<br>";
        echo "Redis Execution Time:  ".$redisExecutionTime." micro seconds"."<br>";
    }
}
