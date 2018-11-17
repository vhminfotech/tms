@extends('layouts.app')
@section('content')
@include('layouts.include.body_header')

<div class="container">
    <div class="row u-mb-large">
        <div class="col-12">
            <div class="c-tabs">
                <div class="c-tabs__content tab-content" id="nav-tabContent">
                    <div class="c-tabs__pane active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <form name="edit-workplaces" id="editTimeSheet" action="{{ route('timesheet-edit',$timesheetDetail[0]['id']) }}" method="post">
                            <div class="row">
                                <div class="col-lg-6">
                                    <input class="c-input" type="hidden" name="_token" id="_token" value="{{ csrf_token() }}" /> 
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="adresses">{{ trans('words.start-time') }}</label>   
                                        <input id="start_time" name="timesheet_edit_start_time" class="c-input" type="text" value="{{ $timesheetDetail[0]['start_time'] }}"/>
                                    </div>
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="adresses">{{ trans('words.end-time') }}</label>   
                                        <input id="end_time" name="timesheet_edit_end_time" class="c-input" type="text" value="{{ $timesheetDetail[0]['end_time'] }}"/>
                                    </div>
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="adresses">{{ trans('words.pause-time') }}</label>   
                                        <input id="pausetime" name="timesheet_edit_push_time" class="c-input" type="text" value="{{ $timesheetDetail[0]['pause_time'] }}"/>
                                    </div>

                                </div>
								
                            </div>


                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="col u-mb-medium">
                                        <input type="submit" class="c-btn c-btn--info c-btn--fullwidth" value="{{ trans('words.edit') }}">
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
  <script type="text/javascript">
        /* time picker javascript*/
            $('#start_time').timepicker('hh:mm:ss');
            $('#end_time').timepicker('hh:mm:ss');
            $('#pausetime').timepicker('hh:mm:ss');
    </script>
@endsection
