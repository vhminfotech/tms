@extends('layouts.app')
@section('content')
@include('layouts.include.body_header')
<div class="container">
    <div class="row u-mb-large">
        <div class="col-12">
            <div class="c-tabs">
                <div class="c-tabs__content tab-content" id="nav-tabContent">
                    <div class="c-tabs__pane active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <form name="add-worker" id="addWorker" action="{{ route('worker-add') }}" method="post">
                            <div class="row">
                                <div class="col-lg-6">
                                    @php
                                    $count = 1;
                                    $oldstaffnumber = 0;
                                    @endphp
                                    @for($i = 0 ;$i < count($arrUser);$i++,$count++)
                                    <td class="c-table__cell">
                                        <input type="hidden" id="cstaffnumber" name="cstaffnumber" value="{{ $oldstaffnumber  = $arrUser[$i]->staffnumber  + 1}}" /></td>
                                    @endfor
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="staffnumber">Staff Number</label>   
                                        <input class="c-input" type="text" name="staffnumber" id="staffnumber" value="{{ $oldstaffnumber }}" placeholder="Enter Staffnumber" readonly> 
                                    </div>  
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="type">Member</label>
                                        <select class="c-input" id="type" name="type">
                                                <option value="WORKER">Worker</option>
                                                <option value="ADMIN">Administrator</option>
                                                <option value="SUPERVISOR">Supervisor</option>
                                        </select>
                                        <input class="c-input" type="hidden" name="_token" id="_token" value="{{ csrf_token() }}"> 
                                    </div>

                                    <div class="c-field u-mb-medium">
                                        <label class="c-field__label" for="select3">Workplaces</label>
                                         @php
                                        $count = 1;
                                        @endphp
                                        <!-- Select2 jquery plugin is used -->
                                        <select class="c-select c-select--multiple" id="select3" name="workplaces[]">
                                             @for($i = 0 ;$i < count($arrWorkplaces);$i++,$count++)
                                                <option value="{{ $arrWorkplaces[$i]->company }}">{{    $arrWorkplaces[$i]->company }}</option>
                                            @endfor
                                        </select>
                                    </div>

                                </div>

                                <div class="col-lg-6">
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="name">Name</label>   
                                        <input class="c-input" type="text" name="name" id="name" placeholder="Enter Name"> 
                                    </div>
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="productName">Surname</label> 
                                        <input class="c-input" type="text" name="surname" id="surname" placeholder="Enter Surname"> 
                                    </div>
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="password">Password</label>   
                                        <input class="c-input" type="text" name="password" id="password" placeholder="Enter Password"> 
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
<style>
    input.has-error {
        border-color: red;
    }
</style>
@endsection
