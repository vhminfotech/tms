<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <style>
            #datatable {
                border-collapse: collapse;
            }
            td,th{
                border: 1px solid #000;
            }
        </style>
    </head>
    <body>
        <table class="c-table" id="datatable">
            <thead class="c-table__head c-table__head--slim">
                <tr class="c-table__row">
                    <th class="c-table__cell c-table__cell--head" style="margin-left: 5px;">ID</th>
                    <th class="c-table__cell c-table__cell--head">Date&nbsp;&nbsp;</th>
                    <th class="c-table__cell c-table__cell--head">Staffnumber&nbsp;&nbsp;</th>
                    <th class="c-table__cell c-table__cell--head">Worker&nbsp;&nbsp;</th>
                    <th class="c-table__cell c-table__cell--head">Workplace</th>
                    <th class="c-table__cell c-table__cell--head">Missing Time</th>
                    <th class="c-table__cell c-table__cell--head no-sort">Reason</th>
                </tr>

            <tbody>
                @php
                $count = 1;
                @endphp
                @if(count($arrInformation) > 0)
                @for($i = 0 ;$i < count($arrInformation);$i++,$count++)
                <tr class="c-table__row">
                    <td class="c-table__cell">{{ $count }}</td>
                    <td class="c-table__cell">{{ $arrInformation[$i]->c_date }}</td>
                    <td class="c-table__cell">{{ $arrInformation[$i]->staffnumber }}</td>
                    <td class="c-table__cell">{{ $arrInformation[$i]->name }}</td>
                    <td class="c-table__cell">{{ $arrInformation[$i]->workplaces }}</td>
                    <td class="c-table__cell">{{ $arrInformation[$i]->missing_hour }}</td>
                    <td class="c-table__cell">{{ $arrInformation[$i]->reason }}</td>
                </tr>
                @endfor
                @else
                <tr class="c-table__row">
                    <td colspan="7" class="c-table__cell center" style="color: red;">No Record Found</td>
                </tr>
                @endif
            </tbody>

        </table>
    </body>
</html>
