<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;

use App\Models\Log;

class LogController extends Controller
{
    public function export()
    {
        // 用laravel套件
        
        // 取得data
        $data = Log::all();

        // 檔名
        $filename = 'Log.xlsx';

        // csv檔名
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename='.$filename,
        ];

        // 生成內容
        $callback = function () use ($data) {
            $file = fopen('php://output', 'w');

            // 寫入標題
            fputcsv($file, ['Log_id','create_at','update_at','user_id', 'action', 'details']);

            // 寫入內容
            foreach ($data as $row) {
                fputcsv($file, [$row->_id,$row->created_at,$row->updated_at,$row->user_id, $row->action, $row->details]);
            }

            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }

}
