<table class="c-table" id="datatable">
    <thead class="c-table__head c-table__head--slim">
        <tr class="c-table__row">
            <th class="c-table__cell c-table__cell--head" style="margin-left: 5px;">Worker Name</th>
            <th class="c-table__cell c-table__cell--head">Date</th>
            <th class="c-table__cell c-table__cell--head">Start Time&nbsp;&nbsp;</th>
            <th class="c-table__cell c-table__cell--head">End Time&nbsp;&nbsp;</th>
            <th class="c-table__cell c-table__cell--head">Pause Time&nbsp;&nbsp;</th>
            <th class="c-table__cell c-table__cell--head">Total Time&nbsp;&nbsp;</th>
            <th class="c-table__cell c-table__cell--head" style="max-width: 10%;">Address&nbsp;&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        @if(count($arrTimeheet) > 0)
        @for($i = 0 ;$i < count($arrTimeheet);$i++)
        <tr class="c-table__row">
            <td class="c-table__cell">{{ $arrTimeheet[$i]['name'] }}</td>
            <td class="c-table__cell">{{ date('d.m.Y',strtotime($arrTimeheet[$i]['c_date'])) }}</td>
            <td class="c-table__cell">{{ $arrTimeheet[$i]['start_time'] }}</td>
            <td class="c-table__cell">{{ $arrTimeheet[$i]['end_time'] }}</td>
            <td class="c-table__cell">{{ $arrTimeheet[$i]['pause_time'] }}</td>
            <td class="c-table__cell">{{ $arrTimeheet[$i]['total_time'] }}</td>
            <td class="c-table__cell" style="max-width: 10% !important;width: 10% !important;">{!! wordwrap($arrTimeheet[$i]['adresses'],30,"<br>\n")  !!}</td>
        </tr>
        @endfor
        <tr>
            <td class="c-table__cell" colspan="7" style="text-align: right">Total Time : {{ $totaltime }}</td>
        </tr>
        @else
        <tr class="c-table__row">
            <td colspan="7" class="c-table__cell center" style="color: red;">No Record Found</td>
        </tr>
        @endif
    </tbody>
</table>