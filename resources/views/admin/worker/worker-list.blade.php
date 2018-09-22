@extends('layouts.app')
@section('content')
@include('layouts.include.body_header')


<div class="container">
    <div class="row u-mb-large">
        <div class="col-12">
            <div class="c-tabs">
                <div class="c-tabs__content tab-content" id="nav-tabContent">
                    <div class="c-tabs__pane active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <form name="add-worker" id="addWorker" action="{{ route('worker-list-search') }}" method="post">
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
                       Worker List

                        <a class="c-table__title-action c-tooltip c-tooltip--top" href="{{ route('worker-add') }}" aria-label="Add Worker">
                            <i class="fa fa-plus"></i>
                        </a>
                    </caption>
                    <thead class="c-table__head c-table__head--slim">
                        <tr class="c-table__row">
                            <th class="c-table__cell c-table__cell--head" style="margin-left: 5px;">ID</th>
                            <th class="c-table__cell c-table__cell--head">Staff Number</th>
                            <th class="c-table__cell c-table__cell--head">Name&nbsp;&nbsp;</th>
                            <th class="c-table__cell c-table__cell--head">Surname&nbsp;&nbsp;</th>
                            <th class="c-table__cell c-table__cell--head">Work Time&nbsp;&nbsp;</th>
                            <th class="c-table__cell c-table__cell--head">Pause Time&nbsp;&nbsp;</th>
                            <th class="c-table__cell c-table__cell--head">Last Login&nbsp;&nbsp;</th>
                            <th class="c-table__cell c-table__cell--head">Total&nbsp;&nbsp;</th>
                            <th class="c-table__cell c-table__cell--head no-sort">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $count = 1;
                        @endphp
                        @for($i = 0 ;$i < count($arrWorker);$i++,$count++)

                        <tr class="c-table__row">
                            <td class="c-table__cell">{{ $count }}</td>
                            
                                @php 
                                    if($arrWorker[$i]->worker_id == null ) 
                                    {
                                @endphp
                                    <td class="c-table__cell">{{ $arrWorker[$i]->staffnumber }}</td>
                                @php
                                    }
                                    else
                                    {
                                @endphp 
                                    <td class="c-table__cell">{{ $arrWorker[$i]->staffnumber }}</td>
                                @php
                                    }
                                @endphp

                                 @php 
                                    if($arrWorker[$i]->worker_id == null ) 
                                    {
                                @endphp
                                    <td class="c-table__cell">{{ $arrWorker[$i]->name }}</td>
                                @php
                                    }
                                    else
                                    {
                                @endphp 
                                    <td class="c-table__cell">{{ $arrWorker[$i]->name }}</td>
                                @php
                                    }
                                @endphp


                                @php 
                                    if($arrWorker[$i]->worker_id == null ) 
                                    {
                                @endphp
                                    <td class="c-table__cell">{{ $arrWorker[$i]->surname }}</td>
                                @php
                                    }
                                    else
                                    {
                                @endphp 
                                    <td class="c-table__cell">{{ $arrWorker[$i]->surname }}</td>
                                @php
                                    }
                                @endphp

                                @php 
                                    if($arrWorker[$i]->worker_id == null ) 
                                    {
                                @endphp
                                    <td class="c-table__cell">
                                {{ $arrWorker[$i]->total_houres +  $arrWorker[$i]->pause_houres }}</td>
                                @php
                                    }
                                    else
                                    {
                                @endphp 
                                    <td class="c-table__cell">{{ $arrWorker[$i]->total_time }}</td>
                                @php
                                    }
                                @endphp


                                @php 
                                    if($arrWorker[$i]->worker_id == null ) 
                                    {
                                @endphp
                                     <td class="c-table__cell">{{ $arrWorker[$i]->pause_houres }}</td>
                                @php
                                    }
                                    else
                                    {
                                @endphp 
                                    <td class="c-table__cell">{{ $arrWorker[$i]->pause_time }}</td>
                                @php
                                    }
                                @endphp

                                
                                @php 
                                    if($arrWorker[$i]->worker_id == null ) 
                                    {
                                @endphp
                                     <td class="c-table__cell">{{ $arrWorker[$i]->c_dates }}</td>
                                @php
                                    }
                                    else
                                    {
                                @endphp 
                                    <td class="c-table__cell">{{ $arrWorker[$i]->c_date }}</td>
                                @php
                                    }
                                @endphp

                                 @php 
                                    if($arrWorker[$i]->worker_id == null ) 
                                    {
                                @endphp
                                     <td class="c-table__cell">{{ $arrWorker[$i]->total_houres }}</td>
                                @php
                                    }
                                    else
                                    {
                                @endphp 
                                    <td class="c-table__cell">{{ $arrWorker[$i]->total_time }}</td>
                                @php
                                    }
                                @endphp

                                 @php 
                                    if($arrWorker[$i]->worker_id == null ) 
                                    {
                                @endphp
                                    <td class="c-table__cell">
                                <a href=" {{ route('worker-edit',[$arrWorker[$i]->id])}} "><span class="c-tooltip c-tooltip--top"  aria-label="Edit">
                                    <i class="fa fa-edit" ></i></span>
                                </a>
                                <a href="javascript:;" class="delete"  data-id="{{ $arrWorker[$i]->id }}"><span class="c-tooltip c-tooltip--top" data-toggle="modal" data-target="#deleteModel" aria-label="Delete">
                                        <i class="fa fa-trash-o" ></i></span>
                                </a>
                            </td>
                                @php
                                    }
                                    else
                                    {
                                @endphp 
                                    <td class="c-table__cell">--</td>
                                @php
                                    }
                                @endphp
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
