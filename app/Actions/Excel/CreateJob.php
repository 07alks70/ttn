<?php

namespace App\Actions\Excel;

use App\Collections\Excel\ExcelRowDTOCollection;
use App\Contracts\Action\Excel\CreateJobContract;
use App\DataTransferObjects\Rows\RowDTO;
use App\Jobs\RecordRowsFromDTOCollection;
use App\Services\Excel\Interface\ExcelFileInterface;
use App\Services\Excel\Interface\ExcelInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Response;

class CreateJob implements CreateJobContract
{
    private ExcelInterface $excelService;
    public function __construct(ExcelInterface $excelService)
    {
        $this->excelService = $excelService;
    }

    public function handle(string $path): void
    {
        $excelFile = $this->excelService->loadFromFile($path);

        $rows = $excelFile->getAllRows();
        if ($rows[0][0] == 'id') {
            unset($rows[0]);
        }
        $chunkRows = array_chunk($rows, 1000);

        foreach ($chunkRows as $chunk)
        {
            $rowDTOCollection = new ExcelRowDTOCollection();
            foreach ($chunk as $item){
                $date = Carbon::createFromFormat("Y-m-d", explode(' ', $item[2])[0]);
                $rowDTOCollection->add(new RowDTO(
                    name: $item[1],
                    date: $date
                ));
            }
            RecordRowsFromDTOCollection::dispatch($rowDTOCollection);
        }
    }
}