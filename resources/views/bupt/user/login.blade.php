<?php
/**
 * Created by PhpStorm.
 * User: LJ
 * Date: 2015/12/2
 * Time: 11:06
 */
?>

<form action="{{ action('Bupt\UserController@anyLogin') }}" method="post">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <table>
        <tr>
            <td>用户名：</td>
            <td><input type="text" name="name" value="{{ $name or '' }}"></td>
        </tr>
        <tr>
            <td>密码：</td>
            <td><input type="password" name="psw" value="{{ $psw or '' }}"></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" value="登录"></td>
        </tr>
    </table>
</form>
