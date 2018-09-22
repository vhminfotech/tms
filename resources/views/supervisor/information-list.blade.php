@extends('layouts.app')
@section('content')
@include('layouts.include.body_header')

<div class="container">
    <div class="row u-mb-large">
        <div class="col-12">
            <div class="c-tabs">
                <div class="c-tabs__content tab-content" id="nav-tabContent">
                    <div class="c-tabs__pane active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <form name="add-worker" id="addWorker" action="{{ route('information-search-list') }}" method="post">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="c-field u-mb-small">
                                        <h1><b></b></h1>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="type">Start Date</label>
                                           <input id="datepicker_search1" name="start_date" class="date c-input"type="date" />
                                           <input class="c-input" type="hidden" name="_token" id="_token" value="{{ csrf_token() }}"> 

                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="type">End Date</label>
                                           <input id="datepicker_search2" name="end_date" class="date c-input" type="date" />
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="col u-mb-medium">
                                         <label class="c-field__label" for="type">Action</label>
                                        <input type="submit" class="c-btn c-btn--info c-btn--fullwidth" value="Save">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- // .col-12 -->
    </div>
</div><!-- // .container -->


<input class="c-input" type="hidden" name="_token" id="_token" value="{{ csrf_token() }}"> 
<div class="container">
    <div class="row u-mb-large">
        <div class="col-12">
            <div c-table-responsive>
                <table class="c-table" id="datatable">
                    <caption class="c-table__title">
                       Information List
                    </caption>
                    <thead class="c-table__head c-table__head--slim">
                        <tr class="c-table__row">
                            <th class="c-table__cell c-table__cell--head" style="margin-left: 5px;">ID</th>
                            <th class="c-table__cell c-table__cell--head">Date&nbsp;&nbsp;</th>
                            <th class="c-table__cell c-table__cell--head">Staffnumber&nbsp;&nbsp;</th>
                            <th class="c-table__cell c-table__cell--head">Worker&nbsp;&nbsp;</th>
                            <th class="c-table__cell c-table__cell--head">Workplace</th>
                            <th class="c-table__cell c-table__cell--head">Missing Time</th>
                            <th class="c-table__cell c-table__cell--head">Reason</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $count = 1;
                        @endphp
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
                    </tbody>
                </table>

            </div><!-- // .col-12 -->
        </div>
    </div>

</div><!-- // .container -->
<style>
/*    a.c-board__btn.c-tooltip.c-tooltip--top {
        position: absolute;
        margin-left: 743px;
        margin-bottom: 41px;
    }*/
.c-table__title .c-tooltip{
    position: absolute;
}
</style>

@endsection
