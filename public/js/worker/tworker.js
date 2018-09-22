var TWorker = function() {
    
    var add_timesheet = function() {

        var form = $('#addTimesheet');
        var rules = {
            c_date: {required: true},
            workplaces: {required: true},
            password: {required: true},
            start_time: {required: true},
            end_time: {required: true},
            pause_time: {required: true}
        };
        handleFormValidate(form, rules, function(form) {
            handleAjaxFormSubmit(form);
        });

    };
    


    return{
        addInit: function() {
            add_timesheet();
        },
    };
}();