<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

use App\Models\Log;

class LogController extends Controller
{
    public function export()
    {
        // 取得data
        $data = Log::all();

        // 檔名
        $filename = 'Log.csv';

        // csv檔名
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename='.$filename,
        ];

        // 生成內容
        $callback = function () use ($data) {
            $file = fopen('php://output', 'w');

            // 寫入標題
            fputcsv($file, ['user_id', 'action', 'details']);

            // 寫入內容
            foreach ($data as $row) {
                fputcsv($file, [$row->user_id, $row->action, $row->details]);
            }

            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }

}
