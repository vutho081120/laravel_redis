<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use App\Models\Post;
use Illuminate\Support\Facades\Cache;
use GuzzleHttp\Client;

class RedisController extends Controller
{
    public function index()
    {
        // Redis::set('user:1:first_name', 'Mike');
        // Redis::set('user:2:first_name', 'John');
        // Redis::set('user:3:first_name', 'Kat');
        // Redis::set('user:4:hash', json_encode(['user_hash' => md5('Mike')]));

        // var_dump(Redis::get('chanel'));

        // $post = Post::first();
        // Cache::put('cache', 'value');

        // return var_dump(Cache::get('cache', null));
        $client = new Client();

        $response = $client->request('GET', 'https://jsonplaceholder.typicode.com/posts');

        $data = json_decode($response->getBody()->getContents(), true);

        //dd($data);

        foreach ($data as $post) {
            $newPost = new Post();
            $newPost->title = $post['title'];
            $newPost->body = $post['body'];
            $newPost->save();
        }

        return 'get api data';
    }
}
