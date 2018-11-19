var Worker = function() {
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
                url: baseurl + "admin/worker/ajaxAction",
                data: {'action': 'deleteWorker', 'data': {'id': id }},
                success: function(data) {
                    handleAjaxResponse(data);
//                    var data = JSON.parse(data);
                }
            });
        });
    };

     var edit_worker = function() {

        var form = $('#editWorker');
        var rules = {
            type: {required: true},
            name: {required: true},
            password: {required: true},
            surname: {required: true},
            staffnumber: {required: true}
        };
        handleFormValidate(form, rules, function(form) {
            handleAjaxFormSubmit(form);
        });

    };

    var add_worker = function() {

        var form = $('#addWorker');
        var rules = {
            type: {required: true},
            name: {required: true},
            workplaces: {required: true},
            password: {required: true},
            surname: {required: true},
            staffnumber: {required: true}
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
            add_worker();
        },
        editInit: function() {
            edit_worker();
        },
    };
}();