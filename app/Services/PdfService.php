<?php
namespace App\Services;

use App\Models\Task;
use Carbon\Carbon;
use PHPUnit\Exception;
use Elibyy\TCPDF\Facades\TCPDF;
use Illuminate\Support\Facades\View;

class PdfService
{
    private string $id;
    private ?string $toDate;
    private ?string $fromDate;

    public function setId( string $id) {
        $this->id = $id;
        return $this;
    }

    public function setDateTo(?string $to_date) {
        $this->toDate = $to_date;
        return $this;
    }

    public function setDateFrom(?string $from_date) {
        $this->fromDate = $from_date;
        return $this;
    }


    public function download() {
        // variables
        $to_date = $this->toDate ?? Carbon::now();
        $from_date = $this->fromDate;

        try {
            $tasks = Task::when((isset($from_date) && !empty($from_date)), function ($query) use ($from_date, $to_date) {
                return $query
                    ->whereDate('created_at', '>=', $from_date)
                    ->whereDate('created_at', '<=', $to_date);
            })->orderBy('created_at', 'desc')->get();

            $pdf_output_name = 'task-manager_'.time().'.pdf';

            $view = View::make('pdf.taskPdf', ['tasks' => $tasks]);
            $html = $view->render();

            $pdf = new TCPDF();
            $pdf::SetTitle('Task Manager');
            $pdf::AddPage();
            $pdf::writeHTML($html, true, false, true, false, '');
            $pdf::Output($pdf_output_name, 'D');

            return [
                "code" => 200,
                "message" => "Task created successfully",
                "data" => [],
            ];
        }
        catch (Exception $e) {
            throw new \Exception($e->getMessage(), $e->getCode());
        }
    }
}
