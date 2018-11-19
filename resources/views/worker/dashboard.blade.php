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
                        <form name="timesheet-add" id="addTimesheet" action="{{ route('worker-dashboard') }}" method="post">
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="type">{{ trans('words.select-date') }}</label>
                                           <input id="datepicker" name="c_date" class="date c-input" type="text" />

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
                                        <label class="c-field__label" for="type">{{ trans('words.Workplaces') }}</label>
                                         @php
                                        $count = 1;
                                        @endphp
                                        <select class="c-input" id="workplaces" name="workplaces">
                                        <!--<option value="other">Other</option>-->
                                        @for($i = 0 ;$i < count($workplaces_array);$i++,$count++)
                                        <option value="{{ $workplaces_array[$i] }}">{{ $workplaces_array[$i] }}</option>
                                        @endfor
                                        </select>
                                    </div>
                                </div> 
                                <div class="col-lg-2">
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="type">{{ trans('words.start-time') }}</label>
                                        <input id="start_time" name="start_time" class="c-input" type="text" />
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="type">{{ trans('words.end-time') }}</label>
                                        <input id="end_time" name="end_time" class="c-input" type="text" />
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="type">{{ trans('words.pause-time') }}</label>
                                        <input id="pausetime" name="pause_time" value="01:00" class="c-input" type="text" />
                                    </div>
                                </div>

   
                                <div class="col-lg-6">
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="type">{{ trans('words.wo-reason') }}</label>
                                        <input name="reason" class="c-input" type="text" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="col u-mb-medium">
                                        <input type="submit" class="c-btn c-btn--info c-btn--fullwidth" value="{{ trans('words.add') }}">
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
                        <form name="add-worker" id="addWorker" action="{{ route('workerdash-search-list') }}" method="post">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="c-field u-mb-small">
                                        <h1><b></b></h1>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="type">{{ trans('words.start-date') }}</label>
                                           <input id="datepicker_search1" name="start_date" class="date c-input" type="date" />
                                           <input class="c-input" type="hidden" name="_token" id="_token" value="{{ csrf_token() }}"> 

                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="type">{{ trans('words.end-date') }}</label>
                                           <input id="datepicker_search2" name="end_date" class="date c-input" type="date" />

                                           <input class="c-input" type="hidden" name="worker_id" id="worker_id" value="{{ $detail['id'] }}"/> 
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="col u-mb-medium">
                                        <label class="c-field__label" for="type">&nbsp;</label>
                                        <input type="submit" class="c-btn c-btn--info c-btn--fullwidth" value="{{ trans('words.save') }}">
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
            <div class="c-table-responsive">
                <table class="c-table" id="datatable">
                    <caption class="c-table__title">
                       {{ trans('words.timesheet-list') }}
                    </caption>
                    <thead class="c-table__head c-table__head--slim">
                        <tr class="c-table__row">
                            <th class="c-table__cell c-table__cell--head" style="margin-left: 5px;">{{ trans('words.id') }}</th>
                            <th class="c-table__cell c-table__cell--head">{{ trans('words.date') }}  </th>
                            <th class="c-table__cell c-table__cell--head">{{ trans('words.workerplace') }} &nbsp;&nbsp;</th>
                            <th class="c-table__cell c-table__cell--head">{{ trans('words.start-time') }}&nbsp;&nbsp;</th>
                            <th class="c-table__cell c-table__cell--head">{{ trans('words.end-time') }}&nbsp;&nbsp;</th>
                            <th class="c-table__cell c-table__cell--head">{{ trans('words.pause-time') }}&nbsp;&nbsp;</th>
                            <th class="c-table__cell c-table__cell--head">{{ trans('words.total') }}&nbsp;&nbsp;</th>
                            
                            <th class="c-table__cell c-table__cell--head no-sort">{{ trans('words.wo-reason') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                         @php
                        $count = 1;
                        @endphp
                        @for($i = 0 ;$i < count($arrTimesheet);$i++,$count++)
                        <tr class="c-table__row">
                            <td class="c-table__cell">{{ $count }}</td>
                            <td class="c-table__cell"><?php
                                     $newDate = date("d.m.Y", strtotime($arrTimesheet[$i]->c_date));
                                     ?>{{ $newDate }}</td>
                            <td class="c-table__cell">{{ $arrTimesheet[$i]->workplaces }}</td>
                            <td class="c-table__cell">{{ $arrTimesheet[$i]->start_time }}</td>
                            <td class="c-table__cell">{{ $arrTimesheet[$i]->end_time }}</td>
                            <td class="c-table__cell">{{ $arrTimesheet[$i]->pause_time }}</td>
                            <td class="c-table__cell">{{ $arrTimesheet[$i]->total_time }}</td>
                            
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
            $('#start_time').timepicker('hh:mm:ss');
            $('#end_time').timepicker('hh:mm:ss');
            $('#pausetime').timepicker('hh:mm:ss');
    </script>
<style>
/*    a.c-board__btn.c-tooltip.c-tooltip--top {
        position: absolute;
        margin-left: 743px;
        margin-bottom: 41px;
    }*/
.c-table__title .c-tooltip{
    position: absolute;
}
.c-table-responsive .c-table {
    display: inline-table !important;
    overflow-y: hidden;
}
</style>
@endsection
