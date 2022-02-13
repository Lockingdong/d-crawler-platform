<?php

namespace App\Services;

use App\Repositories\CrawlerRecordRepository;

class CrawlerRecordService extends BaseService
{
    protected $crawlerRecordRepository;

    public function __construct(
        CrawlerRecordRepository $crawlerRecordRepository
    )
    {
        parent::__construct($crawlerRecordRepository);
        $this->crawlerRecordRepository = $crawlerRecordRepository;
    }

    public function getCrawlerRecordsByUserId(int $userId)
    {
        return $this->crawlerRecordRepository->getCrawlerRecordsByUserId($userId);
    }
}
