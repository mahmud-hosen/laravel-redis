## Introduction to Redis

Redis is an open source in-memory data structure store used as a database, cache, message broker, and streaming engine.

Redis provides data structures such as strings, hashes, lists, sets, sorted sets 

## Install Redis

Before using Redis with Laravel, we need to install and use the phpredis PHP extension.

If you are unable to install the phpredis extension, you may install the predis/predis package via Composer. Predis is a Redis client

To Install Predis/Predis Package via Composer:

`composer require predis/predis`

### Update .env File

`REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379`

### Update database.php File

`'redis' => [

        'client' => env('REDIS_CLIENT', 'predis'),

        'default' => [
            'url' => env('REDIS_URL'),
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'password' => env('REDIS_PASSWORD', null),
            'port' => env('REDIS_PORT', '6379'),
            'database' => env('REDIS_DB', '0'),
        ],
    ],`

### RedisTestController file

`    use Illuminate\Support\Facades\Redis;
`

`    public function index(){

            Redis::set('test_key', 'Hello, Redis!');
            $value = Redis::get('test_key');
            dd($value);
    }`

