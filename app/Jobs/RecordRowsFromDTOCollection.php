<?php

namespace App\Jobs;

use App\Collections\Excel\ExcelRowDTOCollection;
use App\Contracts\Repositories\RowRepositoryContract;
use App\DataTransferObjects\Rows\RowDTO;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Redis;

class RecordRowsFromDTOCollection implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private ExcelRowDTOCollection $excelRowDTOCollection;
    private RowRepositoryContract $rowRepository;

    /**
     * Create a new job instance.
     */
    public function __construct(ExcelRowDTOCollection $excelRowDTOCollection)
    {
        $this->excelRowDTOCollection = $excelRowDTOCollection;
    }

    /**
     * Execute the job.
     */
    public function handle(RowRepositoryContract $rowRepository): void
    {
        /**
         * @var RowDTO $rowDTO
         */
        foreach ($this->excelRowDTOCollection->all() as $id => $rowDTO){
            $this->setProgressOnRedis($id + 1);
            $rowRepository->store($rowDTO);
            dump("Задача {$this->job->uuid()}:". Redis::command("get", [$this->job->uuid()]));
        }
    }

    private function setProgressOnRedis(int $count): void
    {
        Redis::command("set", [$this->job->uuid(), $count]);
    }
}
