<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use App\VO\CrawlerRspVO;
use App\Models\CrawlerRecord;
use App\Services\CrawlerRecordService;
use Validator;

class CrawlerController extends Controller
{

    protected $crawlerRecordService;

    public function __construct(
        CrawlerRecordService $crawlerRecordService
    )
    {
        $this->crawlerRecordService = $crawlerRecordService;
    }

    public function fetchUrlData(Request $request)
    {

        try {
            
            $validator = Validator::make($request->all(), [
                'url' => 'required|url',
            ]);

            if($validator->fails()) {
                return response()->json([
                    'status' => 'fail',
                    'data' => $validator->errors()->all()
                ], 400);
            }

            $client = new Client();
            $res = $client->request('GET', config('app.crawler_url') . '/page/' . urlencode($request->url));

            return response()->json([
                'status' => 'fail',
                'data' => json_decode($res->getBody(), true)['data']
            ], 200);

        } catch (\Throwable $th) {

            Log::error($th->getMessage());
            
            return response()->json([
                'status' => 'fail',
                'data' => ''
            ], 500);
        }
        
        
    }

    public function storeUrlData(Request $request)
    {
        
        try {
            $data = $request->all();
            $validator = Validator::make($data['fetchedData'], [
                'screenshot' => 'required',
                'title' => 'required',
                'url' => 'required',
                'description' => '',
                'body' => 'required',
            ]);

            if($validator->fails()) {
                return response()->json([
                    'status' => 'fail',
                    'data' => $validator->errors()->all()
                ], 400);
            }

            $crawlerRecord = new CrawlerRecord($data['fetchedData']);
            $crawlerRecord->user_id = auth()->user()->id;

            $this->crawlerRecordService->create($crawlerRecord);

            return response()->json([
                'status' => 'succ',
                'data' => ''
            ], 200);

        } catch (\Throwable $th) {

            Log::error($th->getMessage());
            
            return response()->json([
                'status' => 'fail',
                'data' => ''
            ], 500);
        }

    }
}
