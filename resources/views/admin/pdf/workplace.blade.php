<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
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
        <center><h3><b>Arbeitsplatz PDF</b></h3></center>
        <table class="c-table" id="datatable" style="width:100%">
            <thead class="c-table__head c-table__head--slim">
                <tr class="c-table__row">
                    <th class="c-table__cell c-table__cell--head" style="margin-left: 5px;">Mitarbeiter</th>
                    <th class="c-table__cell c-table__cell--head">Datum</th>
                    <th class="c-table__cell c-table__cell--head">Insgesamt Zeit&nbsp;&nbsp;</th>
                    <th class="c-table__cell c-table__cell--head" style="max-width: 10%;">Grund/Erklärung&nbsp;&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                @if(count($arrTimeheet) > 0)
                @for($i = 0 ;$i < count($arrTimeheet);$i++)
                <tr class="c-table__row">
                    <td class="c-table__cell">{{ $arrTimeheet[$i]['name'] }} {{ $arrTimeheet[$i]['surname'] }}</td>
                    <td class="c-table__cell">{{ date("d.m.Y", strtotime($arrTimeheet[$i]['c_date'])) }}</td>
                    <td class="c-table__cell">{{ $arrTimeheet[$i]['total_time'] }}</td>
                    <td class="c-table__cell" style="max-width: 10% !important;width: 10% !important;">{{ $arrTimeheet[$i]['reason'] }}</td>
                </tr>
                
                @endfor
                <tr class="c-table__row">
                    <td colspan="4" class="c-table__cell " style=" text-align: right">Insgesamt Zeit : {{ $totaltime }}</td>
                </tr>
                @else
                <tr class="c-table__row">
                    <td colspan="4" class="c-table__cell center" style="color: red;">No Record Found</td>
                </tr>
                @endif
            </tbody>
        </table>
    </body>
</html>
