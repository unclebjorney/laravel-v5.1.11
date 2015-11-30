<?php
/**
 * Created by PhpStorm.
 * User: LJ
 * Date: 2015/11/30
 * Time: 17:54
 */
?>

<table border="1" style="border-collapse:collapse;">
@foreach($table as $row)
    <tr>
    @foreach($row as $cell)
        <td>{{ $cell }}</td>
    @endforeach
    </tr>
@endforeach
</table>