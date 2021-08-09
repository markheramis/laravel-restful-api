<?php

namespace tests\Benchmark;

use App\Models\User;

class HashBench
{
    public function benchMd5()
    {
        hash('md5', 'Hello World!');
    }

    public function benchSha1()
    {
        hash('sha1', 'Hello World!');
    }

    public function benchTest()
    {
        $users = User::all();
    }
}
