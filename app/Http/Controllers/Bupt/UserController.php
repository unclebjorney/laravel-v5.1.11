<?php
/**
 * Created by PhpStorm.
 * User: LJ
 * Date: 2015/11/30
 * Time: 16:24
 */

namespace App\Http\Controllers\Bupt;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\User;

class UserController extends Controller {

    public function __construct() {
        $this->middleware('user.login', ['except' => 'anyLogin']);
    }

    public function anyLogin() {
        $all = request()->all();
        if(isset($all['name']) && isset($all['psw'])) {
            $user = User::whereRaw('name = ?', [$all['name']])->first();
            if(isset($user) && $user->psw == $all['psw']) {
                session(['currentUser' => $user]);
                return redirect()->action('Bupt\UserController@anyIndex');
            }
        }
        return view('bupt.user.login', request()->all());
    }

    public function anyIndex() {
        return Group::with(['users'])->get()->toJson();
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