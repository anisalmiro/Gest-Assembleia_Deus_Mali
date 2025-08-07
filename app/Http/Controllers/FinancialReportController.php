<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exports\FinancialReportExport;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class FinancialReportController extends Controller
{
    public function export(Request $request)
    {
        $format = $request->get('format', 'excel');

        if ($format === 'excel') {
            return Excel::download(new FinancialReportExport(), 'relatorio.xlsx');
        }

        // Aqui você pode implementar exportação PDF ou outro formato

        abort(404);
    }
}
