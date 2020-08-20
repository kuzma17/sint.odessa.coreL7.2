<?php
/**
 * Created by PhpStorm.
 * User: kuzma
 * Date: 20.06.17
 * Time: 19:56
 */
?>

<h3>История</h3>

<div class="" >
    @if(count($histories) > 0)
        <table class="table table-striped">
            <tbody>
            <tr>
                <th>Дата:</th><th>Событие:</th><th>Коментарий</th><th>Пользователь</th>
            </tr>
            @foreach($histories as $history)
                <tr>
                    <td>{{ $history->created_at }}</td>
                    <td>{{ $history->status_info }}</td>
                    <td>{{ $history->comment or '' }}</td>
                    <td>{{ $history->admin_user or '' }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
</div>
