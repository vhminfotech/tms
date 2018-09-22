var Information = function() {

     var list = function() {

        $('.delete').click(function() {
            var dataid = $(this).attr('data-id');
            var dataurl = $(this).attr('data-url');
            $('.yes-sure').attr('data-id', dataid);
            $('.yes-sure').attr('data-url', dataurl);
        });

        $('.yes-sure').click(function() {
            var id = $(this).attr('data-id');
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "admin/timesheet/ajaxAction",
                data: {'action': 'deleteTimesheet', 'data': {'id': id }},
                success: function(data) {
                    handleAjaxResponse(data);
//                    var data = JSON.parse(data);
                }
            });
        });
    };

    var add_information = function() {

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
        listInit: function() {
            list();
        },
        addInit: function() {
            add_information();
        },
    };
}();