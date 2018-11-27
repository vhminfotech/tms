
var Superviseor = function() {
    
    var add_timesheet = function() {
        
        var form = $('#addTimesheet');
        var rules = {
            select_date: {required: true},
            workplaces: {required: true},
            start_time: {required: true},
            end_time: {required: true},
            pause_time: {required: true}
        };
        handleFormValidate(form, rules, function(form) {
            handleAjaxFormSubmit(form);
        });

    };
    
    var edit_timesheet = function() {
       
        var form = $('#editInformation');
        var rules = {
            reason: {required: false}
        };
        handleFormValidate(form, rules, function(form) {
            handleAjaxFormSubmit(form);
        });
    };
    
    var edit_information=function(){
        var form = $('#editInformation');
        var rules = {
            timesheet_edit_start_time: {required: true},
            timesheet_edit_end_time: {required: true},
            timesheet_edit_push_time: {required: true},
            
        };
        handleFormValidate(form, rules, function(form) {
            handleAjaxFormSubmit(form);
        });
    };
    
    return{
      
        editInit: function(){
            edit_timesheet();
        },
        informationInit:function(){
            edit_information();
        },
    };
}();