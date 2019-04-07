<?php
/**
 * Created by PhpStorm.
 * User: Osama
 * Date: 12/2/2016
 * Time: 10:18 PM
 */

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class ImportController extends Controller
{

    public function get(Request $request)
    {
        $this->deleteAll();
        $this->insert();

        return 200;
    }

    private function deleteAll()
    {
        DB::table('tweets')
            ->delete();
        DB::table('users')
            ->delete();
        DB::table('hashtags')
            ->delete();
        DB::table('urls')
            ->delete();
    }

    /*
     * Insert data inside the database
     * */
    private function insert()
    {
        for ($i = 1; $i < 7; ++$i) {
            $this->insertFile(storage_path("data/" . $i . ".json"));
        }
    }

    private function insertFile($path)
    {
        $json = file_get_contents($path);
        $json_data = json_decode($json);
        $tweets = [];
        $users = [];
        $hashtags = [];
        $urls = [];
        foreach ($json_data as $obj) {
            $tweet = $this->getTweet($obj);
            $tweets[] = $tweet;
            $users[] = $this->getUser($obj->user);

            foreach ($obj->entities->hashtags as $hashtag) {
                $hashtags[] = [
                    'text' => $hashtag->text,
                    'tweet_id' => $tweet['id'],
                ];
            };
            foreach ($obj->entities->urls as $url) {
                $urls[] = [
                    'url' => $url->url,
                    'expanded_url' => $url->expanded_url,
                    'tweet_id' => $tweet['id'],
                ];
            };
        }
        DB::table('tweets')
            ->insert($tweets);
        DB::table('users')
            ->insert($users);
        DB::table('hashtags')
            ->insert($hashtags);
        DB::table('urls')
            ->insert($urls);
    }

    private function getTweet($obj)
    {
        return [
            'id' => $obj->id_str,
            'text' => $obj->text,
            'source' => $obj->source,
            'created_at' => Carbon::parse($obj->created_at),
            'user_id' => $obj->user->id_str,
            'retweet_count' => $obj->retweet_count,
            'reply_count' => $obj->reply_count,
            'parent_id' => isset($obj->retweeted_status) ? $obj->retweeted_status->id_str : null,
            'parent_user_id' => isset($obj->retweeted_status) ? $obj->retweeted_status->user->id_str : null,
            'active' => $this->getTweetType($obj),
        ];


    }

    private function getTweetType($obj)
    {
        if (isset($obj->retweeted_status)) {
            return 0;
        }
        $words = ['diabetes', 'insulin', 'blodsocker', 'hypogly', 'diabulimi', 'hba1c'];

        $count = 0;
        foreach ($words as $word) {
            if (strpos($obj->text, $word) === false) {
                continue;
            }
            ++$count;
        }
        if ($count > 1) {
            return 1;
        } else {
            return -1;
        }


    }

    private function getUser($obj)
    {
        return [
            'id' => $obj->id_str,
            'name' => $obj->name,
            'location' => $obj->location,
            'created_at' => Carbon::parse($obj->created_at),
            'lang' => $obj->lang,
            'followers_count' => $obj->followers_count,
            'friends_count' => $obj->friends_count,
            'favorites_count' => $obj->favourites_count,
        ];
    }


    // isset($obj->favorites_count) ?


}