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


class ChartsController extends Controller
{

    public function getTweets(Request $request)
    {
        $items = DB::table('tweets')
            ->groupBy(DB::raw('date(created_at)'))
            ->select(DB::raw('count(*) as value'), DB::raw('date(created_at) as name'))
            ->get();

        return response()->json([
            'data' => $items,
            'title' => 'Tweets over time',
        ]);
    }

    public function getPopularHashtags(Request $request)
    {
        $items = DB::table('hashtags')
            ->groupBy('text')
            ->select(DB::raw('count(*) as value'), DB::raw('text as name'))
            ->limit(10)
            ->orderBy('value', 'desc')
            ->get();

        return response()->json([
            'data' => $items,
            'title' => 'Popular hashtags',
        ]);
    }

    public function getActive(Request $request)
    {
        $active = DB::table('tweets')
            ->where('active', 1)
            ->count();

        $inactive = DB::table('tweets')
            ->where('active', -1)
            ->count();

        $retweet = DB::table('tweets')
            ->where('active', 0)
            ->count();

        return response()->json([
            'data' => [
                [
                    'name' => 'Active',
                    'value' => $active
                ],
                [
                    'name' => 'Inactive',
                    'value' => $inactive
                ],
                [
                    'name' => 'Retweet',
                    'value' => $retweet
                ]
            ]

        ]);

    }

}