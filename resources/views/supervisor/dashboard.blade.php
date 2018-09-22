@extends('layouts.app')
@section('content')
@include('layouts.include.body_header')
<div class="container">
        @if ( Session::has('flash_message') )
            <div class="c-alert c-alert--success alert fade show">
                <i class="c-alert__icon fa fa-times-circle"></i> {{ Session::get('flash_message') }}
                <button class="c-close" data-dismiss="alert" type="button">×</button>
            </div>
        @endif
    <div class="row u-mb-large">
        <div class="col-12">
            <div class="c-tabs">
                <div class="c-tabs__content tab-content" id="nav-tabContent">
                    <div class="c-tabs__pane active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <form name="timesheet-add" id="addTimesheet" action="{{ route('customer-dashboard') }}" method="post">
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="type">Select Date</label>
                                           <input id="datepicker" name="c_date" class="date c-input"type="date" />

                                           <input class="c-input" type="hidden" name="worker_id" id="worker_id" value="{{ $detail['id'] }}"> 


                                           <input class="c-input" type="hidden" name="_token" id="_token" value="{{ csrf_token() }}"> 
                                    </div>
                                </div>
                                @php
                                    $count = 1;
                                    $workplaces_array = array();
                                    $workplaces_array = explode(',',$arrWorkplaces);
                                @endphp
                                 <div class="col-lg-3">
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="type">Workplaces</label>
                                         @php
                                        $count = 1;
                                        @endphp
                                        <select class="c-input" id="workplaces" name="workplaces">
                                        <option value="other">Other</option>
                                        @for($i = 0 ;$i < count($workplaces_array);$i++,$count++)
                                        <option value="{{ $workplaces_array[$i] }}">{{ $workplaces_array[$i] }}</option>
                                        @endfor
                                        </select>
                                    </div>
                                </div> 
                                <div class="col-lg-2">
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="type">Start Time</label>
                                        <input id="timepicker1" name="start_time" class="c-input" type="time" />
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="type">End Time</label>
                                        <input id="start_timepicker" name="end_time" class="c-input"type="time" />
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="type">Pause Time</label>
                                       <input id="pausetime" name="pause_time" value="01:00" class="c-input" type="text" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="type">Reason</label>
                                        <input name="reason" class="c-input" type="text" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="col u-mb-medium">
                                        <input type="submit" class="c-btn c-btn--info c-btn--fullwidth" value="Add">
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

<div class="container">
    <div class="row u-mb-large">
        <div class="col-12">
            <div class="c-tabs">
                <div class="c-tabs__content tab-content" id="nav-tabContent">
                    <div class="c-tabs__pane active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <form name="add-worker" id="addWorker" action="{{ route('dash-search-list') }}" method="post">
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
                                           <input class="c-input" type="hidden" name="worker_id" id="worker_id" value="{{ $detail['id'] }}"/> 
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

@php
if( count($arrTimesheet) !=null )
{
@endphp
<input class="c-input" type="hidden" name="_token" id="_token" value="{{ csrf_token() }}"> 
<div class="container">
    <div class="row u-mb-large">
        <div class="col-12">
            <div c-table-responsive>
                <table class="c-table" id="datatable">
                    <caption class="c-table__title">
                       Timesheet List
                    </caption>
                    <thead class="c-table__head c-table__head--slim">
                        <tr class="c-table__row">
                            <th class="c-table__cell c-table__cell--head" style="margin-left: 5px;">ID</th>
                            <th class="c-table__cell c-table__cell--head">Date  </th>
                            <th class="c-table__cell c-table__cell--head">Workplace &nbsp;&nbsp;</th>
                            <th class="c-table__cell c-table__cell--head">Start Time&nbsp;&nbsp;</th>
                            <th class="c-table__cell c-table__cell--head">End Time&nbsp;&nbsp;</th>
                            <th class="c-table__cell c-table__cell--head">Pause Time&nbsp;&nbsp;</th>
                            <th class="c-table__cell c-table__cell--head">Total&nbsp;&nbsp;</th>
                            <th class="c-table__cell c-table__cell--head">Missing Time&nbsp;&nbsp;</th>
                            <th class="c-table__cell c-table__cell--head no-sort">Reason</th>
                        </tr>
                    </thead>
                    <tbody>
                         @php
                        $count = 1;
                        @endphp
                        @for($i = 0 ;$i < count($arrTimesheet);$i++,$count++)
                        <tr class="c-table__row">
                            <td class="c-table__cell">{{ $count }}</td>
                            <td class="c-table__cell">{{ $arrTimesheet[$i]->c_date }}</td>
                            <td class="c-table__cell">{{ $arrTimesheet[$i]->workplaces }}</td>
                            <td class="c-table__cell">{{ $arrTimesheet[$i]->start_time }}</td>
                            <td class="c-table__cell">{{ $arrTimesheet[$i]->end_time }}</td>
                            <td class="c-table__cell">{{ $arrTimesheet[$i]->pause_time }}</td>
                            <td class="c-table__cell">{{ $arrTimesheet[$i]->total_time }}</td>
                            <td class="c-table__cell">{{ $arrTimesheet[$i]->missing_hour }}</td>
                            <td class="c-table__cell">{{ $arrTimesheet[$i]->reason }}</td>
                        </tr>
                         @endfor
                    </tbody>
                </table>

            </div><!-- // .col-12 -->
        </div>
    </div>

</div><!-- // .container -->

@php
}
@endphp

    <script type="text/javascript">
        /* time picker javascript*/
/*            $('#start_time').timepicker();
            $('#end_time').timepicker();*/
            $('#pausetime').timepicker('hh:mm:ss');
    </script>
<style type="text/css">
    .success {
    opacity: 1;
    color: #3c763d;
    background-color: #dff0d8;
    border-color: #ebccd1;
    padding: 15px;
    margin-bottom: 20px;
    border: 1px solid transparent;
    border-radius: 4px;
}
.closebtn {
    padding-left: 15px;
    color: #000;
    font-weight: bold;
    float: right;
    font-size: 20px;
    line-height: 18px;
    cursor: pointer;
    transition: 0.3s;
}
</style>
<script>
$(document).ready(function(){
    $(".closebtn").click(function(){
        $(".success").hide();
    });
});
</script>
@endsection
