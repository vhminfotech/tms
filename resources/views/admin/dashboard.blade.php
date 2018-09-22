@extends('layouts.app')
@section('content')
@include('layouts.include.body_header')



<div class="container-fluid">

        @if ( Session::has('flash_message') )
            <div class="c-alert c-alert--success alert fade show">
                <i class="c-alert__icon fa fa-times-circle"></i> {{ Session::get('flash_message') }}
                <button class="c-close" data-dismiss="alert" type="button">×</button>
            </div>
        @endif
<form name="timesheet-add" id="addTimesheet" action="{{ route('admin-dashboard') }}" method="post">
    <div class="row">

        <div class="col-xl-4">
            <div class="c-graph-card" data-mh="graph-cards">
                <div class="c-graph-card__content">
                    <h3 class="c-graph-card__title">Best Staff</h3>
                    <div class="col-lg-12">
                        <div class="c-field u-mb-small">
                            <label class="c-field__label" for="type">Start Date</label>
                               <input id="datepicker_search1" name="start_date" class="date c-input"type="date" />
                               <input class="c-input" type="hidden" name="_token" id="_token" value="{{ csrf_token() }}"> 

                        </div>
                    </div>
                   <div class="col-lg-12">
                        <div class="c-field u-mb-small">
                            <label class="c-field__label" for="type">End Date</label>
                               <input id="datepicker_search2" name="end_date" class="date c-input" type="date" />
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="col u-mb-medium">
                             <label class="c-field__label" for="type">Action</label>
                            <input type="submit" class="c-btn c-btn--info c-btn--fullwidth" value="Search">
                        </div>
                    </div>
                    <h4 class="c-graph-card__number center">{{$arrBeststaff[0]->name}}</h4>
                    <p class="c-graph-card__date center"><h4><b>Staffnumber</b>:{{ $arrBeststaff[0]->staffnumber }}</h4></p>
                    <p class="c-graph-card__date center"><h4><b>{{ $arrBeststaff[0]->total_houres }}</b>: hours</h4></p>
                </div>
                <div class="c-graph-card__chart">
                    <!-- <canvas id="js-chart-payout" width="300" height="74"></canvas> -->
                </div>
            </div>
        </div>	
        <div class="col-xl-4">
            <div class="c-graph-card" data-mh="graph-cards">
                <div class="c-graph-card__content">
                    <h3 class="c-graph-card__title">Design office</h3>
                    <div class="col-lg-12">
                        <div class="c-field u-mb-small">
                            <label class="c-field__label" for="type">Start Date</label>
                               <input id="datepicker_search3" name="start_date" class="date c-input"type="date" />
                               <input class="c-input" type="hidden" name="_token" id="_token" value="{{ csrf_token() }}"> 

                        </div>
                    </div>
                   <div class="col-lg-12">
                        <div class="c-field u-mb-small">
                            <label class="c-field__label" for="type">End Date</label>
                               <input id="datepicker_search4" name="end_date" class="date c-input" type="date" />
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="col u-mb-medium">
                             <label class="c-field__label" for="type">Action</label>
                            <input type="submit" class="c-btn c-btn--info c-btn--fullwidth" value="Search">
                        </div>
                    </div>
                    <h4 class="c-graph-card__number center">Design office</h4>
                    <p class="c-graph-card__date center"><h4><b>Gotzkowskystrabe 10, 47559 Kranenburg</b></h4></p>
                    <p class="c-graph-card__date center"><h4><b>874</b>: hours</h4></p>
                </div>
                <div class="c-graph-card__chart">
<!--                     <canvas id="js-chart-earnings" width="300" height="74"></canvas> -->
                </div>
            </div>
        </div><div class="col-xl-4">
                        <div class="c-progress-card" data-mh="graph-cards">
                            <h3 class="c-progress-card__title">New Information</h3>
                            <!-- <p class="c-progress-card__date">Next 4 Weeks</p> -->
                                                <div class="col-lg-12">
                            <div class="c-field u-mb-small">
                                <label class="c-field__label" for="type">Start Date</label>
                                   <input id="datepicker_search5" name="start_date" class="date c-input"type="date" />
                                   <input class="c-input" type="hidden" name="_token" id="_token" value="{{ csrf_token() }}"> 

                            </div>
                            </div>
                           <div class="col-lg-12">
                                <div class="c-field u-mb-small">
                                    <label class="c-field__label" for="type">End Date</label>
                                       <input id="datepicker_search6" name="end_date" class="date c-input" type="date" />
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="col u-mb-medium">
                                     <label class="c-field__label" for="type">Action</label>
                                    <input type="submit" class="c-btn c-btn--info c-btn--fullwidth" value="Search">
                                </div>
                            </div>
                            <div class="c-progress-card__item">
                                <div class="c-progress-card__labels">Information 1</div>
                                <button class="c-btn c-btn--success u-float-right">View</button>
                            </div><!-- // .c-progress-card__item -->

                            <div class="c-progress-card__item">
                                <div class="c-progress-card__labels">Information 2</div>
                                <button class="c-btn c-btn--success u-float-right">View</button>
                            </div><!-- // .c-progress-card__item -->
                         
                        </div>
                    </div>
    </div>
    <div class="row">
        <div class="col-xl-4">
            <div class="c-graph-card" data-mh="graph-cards">
                <div class="c-graph-card__content">
                    <h3 class="c-graph-card__title">Information</h3>
                     <div class="col-lg-12">
                        <div class="c-field u-mb-medium">
                            <label class="c-field__label" for="select1">Workplaces Select</label>
                            <!-- Select2 jquery plugin is used -->
                            <select class="c-select" id="select1">
                                <option>All</option>
                                <option>Ahemdabad</option>
                                <option>Gandhinagar</option>
                                <option>Baroda</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="c-field u-mb-small">
                            <label class="c-field__label" for="type">Select Date</label>
                               <input id="datepicker_search7" name="end_date" class="date c-input" type="date" />
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="col u-mb-medium">
                             <label class="c-field__label" for="type">Action</label>
                            <input type="submit" class="c-btn c-btn--info c-btn--fullwidth" value="Search">
                        </div>
                    </div>
                    
                    <div class="col u-mb-medium">
                        <div class="c-btn-group">
                            <a class="c-btn c-btn--success" href="#!">
                                View
                            </a>

                            <a class="c-btn c-btn--success" href="#!">
                                Print
                            </a>

                            <a class="c-btn c-btn--success" href="#!">
                                </i>Download
                            </a>
                        </div>
                    </div>
                </div>
               
            </div>
        </div>

        <div class="col-xl-4">
            <div class="c-graph-card" data-mh="graph-cards">
                <div class="c-graph-card__content">
                    <h3 class="c-graph-card__title">Workplaces</h3>
                     <div class="col-lg-12">
                        <div class="c-field u-mb-medium">
                            <label class="c-field__label" for="select2">Workplaces Select</label>
                            <!-- Select2 jquery plugin is used -->
                            <select class="c-select" id="select2">
                                <option>All</option>
                                <option>Ahemdabad</option>
                                <option>Gandhinagar</option>
                                <option>Baroda</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="c-field u-mb-small">
                            <label class="c-field__label" for="type">Select Date</label>
                               <input id="datepicker_search8" name="end_date" class="date c-input" type="date" />
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="col u-mb-medium">
                             <label class="c-field__label" for="type">Action</label>
                            <input type="submit" class="c-btn c-btn--info c-btn--fullwidth" value="Search">
                        </div>
                    </div>
                    
                    <div class="col u-mb-medium">
                        <div class="c-btn-group">
                            <a class="c-btn c-btn--success" href="#!">
                                View
                            </a>

                            <a class="c-btn c-btn--success" href="#!">
                                Print
                            </a>

                            <a class="c-btn c-btn--success" href="#!">
                                </i>Download
                            </a>
                        </div>
                    </div>
                </div>
               
            </div>
        </div>

                <div class="col-xl-4">
            <div class="c-graph-card" data-mh="graph-cards">
                <div class="c-graph-card__content">
                    <h3 class="c-graph-card__title">Staff</h3>
                     <div class="col-lg-12">
                        <div class="c-field u-mb-medium">
                            <label class="c-field__label" for="select3">Staff Select</label>
                            <!-- Select2 jquery plugin is used -->
                            <select class="c-select" id="select3">
                                <option>All</option>
                                <option>Mayank</option>
                                <option>Rahul</option>
                                <option>Arun</option>
                                <option>Kartik</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="c-field u-mb-small">
                            <label class="c-field__label" for="type">Select Date</label>
                               <input id="datepicker_search9" name="end_date" class="date c-input" type="date" />
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="col u-mb-medium">
                             <label class="c-field__label" for="type">Action</label>
                            <input type="submit" class="c-btn c-btn--info c-btn--fullwidth" value="Search">
                        </div>
                    </div>
                    
                    <div class="col u-mb-medium">
                        <div class="c-btn-group">
                            <a class="c-btn c-btn--success" href="#!">
                                View
                            </a>

                            <a class="c-btn c-btn--success" href="#!">
                                Print
                            </a>

                            <a class="c-btn c-btn--success" href="#!">
                                </i>Download
                            </a>
                        </div>
                    </div>
                </div>
               
            </div>
        </div>


        
    </div>
</form>
</div><!-- // .container -->
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
