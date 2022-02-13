<?php

namespace App\Repositories;

use App\Models\CrawlerRecord;

class CrawlerRecordRepository extends BaseRepository
{
    protected $crawlerRecord;

    public function __construct(CrawlerRecord $crawlerRecord)
    {
        parent::__construct($crawlerRecord);
        $this->crawlerRecord = $crawlerRecord;
    }

    public function getCrawlerRecordsByUserId(int $userId)
    {
        return $this->crawlerRecord
                    ->where('user_id', $userId)
                    ->orderBy('created_at', 'desc')
                    ->paginate(6);
    }
}
