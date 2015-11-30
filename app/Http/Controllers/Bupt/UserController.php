<?php
/**
 * Created by PhpStorm.
 * User: LJ
 * Date: 2015/11/30
 * Time: 16:24
 */

namespace App\Http\Controllers\Bupt;


use App\Http\Controllers\Controller;

class UserController extends Controller {

    public function anyIndex() {
        $params = request()->only(['id']);
        $users = \DB::table('tbl_user')
            ->leftJoin('tbl_course', function($join) {
                $join->on('course_id', '=', 'tbl_course.id');
            })
            ->selectRaw('tbl_user.id as user_id, tbl_user.name as user_name, tbl_course.id as course_id, tbl_course.name as course_name')
            ->whereRaw('tbl_user.id = :id', $params)
            ->take(1)->get();
        return response()->json($users);
    }

    public function anyExcel() {
        $pFile = iconv('utf-8', 'gbk', 'C:/Users/LJ/Desktop/北邮/灾难恢复方案评估表-关.xlsx');
        $reader = new \PHPExcel_Reader_Excel2007();
        $workbook = $reader->load($pFile);
        $sheet = $workbook->getSheet(0);
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();
        $table = [];
        for($row = 1; $row < $highestRow; $row++) {
            $table[] = [];
            for($column = 'A'; $column < $highestColumn; $column++) {
                $coordinate = $column . $row;
                $table[$row - 1][] = $sheet->getCell($coordinate)->getValue();
            }
        }
        return view('bupt.user.excel', ['table' => $table]);
    }
}