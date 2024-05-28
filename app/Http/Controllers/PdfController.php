<?php

namespace App\Http\Controllers;

use App\Services\PdfService;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    public function __construct
    (
        protected PdfService $pdfService,
    ){}

    public function download(Request $request) {
        try {
            $queries = $request->query();

            $res = $this->pdfService
                ->setDateFrom($queries['from_date'] ?? null )
                ->setDateto($queries['to_date'] ?? null )
                ->download();

            return response()->json($res, 200);
        }
        catch (\Exception $e){
            return response()->json([
                "data" => [],
                "code" => $e->getCode(),
                "message" => $e->getMessage(),
            ], 400);
        }
    }
}
