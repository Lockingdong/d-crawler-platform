<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CrawlerRecordService;

class HomeController extends Controller
{

    protected $crawlerRecordService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        CrawlerRecordService $crawlerRecordService
    )
    {
        $this->middleware('auth');
        $this->crawlerRecordService = $crawlerRecordService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $userId = auth()->user()->id;

        $crawlerRecords = $this->crawlerRecordService->getCrawlerRecordsByUserId($userId);

        return view('home', compact(
            'crawlerRecords'
        ));
    }

    public function showCrawlerRecord(Request $request)
    {
        $crawlerRecord = $this->crawlerRecordService->find($request->crawler_record_id);

        if($crawlerRecord->user_id !== auth()->user()->id) {
            abort(401, '權限不足');
        }

        return view('homeShowRecord', compact(
            'crawlerRecord'
        ));        
    }

    public function deleteCrawlerRecord(Request $request)
    {
        try {
            
            $crawlerRecord = $this->crawlerRecordService->find($request->crawler_record_id);

            if($crawlerRecord->user_id !== auth()->user()->id) {
                abort(401, '權限不足');
            }

            $this->crawlerRecordService->destroy($crawlerRecord->id);
            
            return redirect()->back()->with('status', '刪除成功');

        } catch (\Throwable $th) {

            \Log::error($th->getMessage());

            return redirect()->back()->with('status', '刪除失敗');
        }
        
    }
}
