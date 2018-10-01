var Dashboard = function() {

    var handleGenral = function() {
        $('body').on('click', '.findBestStaff', function() {
            var month = $('.staffMonths option:selected').val();
            var year = $('.staffYears option:selected').val();
        });

        $('body').on('click', '.findBestOfice', function() {
            var month = $('.staffMonths option:selected').val();
            var year = $('.staffYears option:selected').val();
        });

        $('.findBestStaff').click(function() {
            var months = $('.staffMonths').val();
            var year = $('.staffYears').val();
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "admin/dashboard/ajaxAction",
                data: {'action': 'getBestStaffData', 'data': {'months': months, 'year': year}},
                success: function(data) {
                    var data = JSON.parse(data);
                    var Name = (data == '' || data == null ? 'N/A' : data.name)
                    var staffnumber = (data == '' || data == null ? 'N/A' : data.staffnumber)
                    var totalTime = (data == '' || data == null ? 'N/A' : data.totalTime)
                    $('.staffName').text(Name);
                    $('.staffnumber').text(staffnumber);
                    $('.totalHours').text(totalTime);
                }
            });
        });
        
        $('body').on('click', '.findBestOfice', function() {
            restWorkplace();
        });
        
        $('body').on('click', '.getWorkPlaceData', function() {
            var name = $('#workplaceName').val();
            var months = $('#workplaceMonth').val();
            var year = $('#workplaceYear').val();
            $('.wpname').text(name);
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "admin/dashboard/ajaxAction",
                data: {'action': 'getWorkplaceListData', 'data': {'months': months, 'name': name, 'year': year}},
                success: function(data) {
                    $('.c-modal__body').html(data);
                }
            });
        });
        $('body').on('click', '.workplacePDF', function() {
            var name = $('#workplaceName').val();
            var months = $('#workplaceMonth').val();
            var year = $('#workplaceYear').val();
            $('.wpname').text(name);
            var url = baseurl + "admin/workplacepdf?months="+months+"&year="+year+"&name="+name;
           window.open(url, "_blank");
        });
        $('body').on('click', '.staffworkPDF', function() {
            var staffId = $('#staffId option:selected').val();
            var months = $('#staffMonth').val();
            var year = $('#staffYear').val();
            $('.wpname').text(name);
            var url = baseurl + "admin/staffworkpdf?months="+months+"&year="+year+"&staffId="+staffId;
           window.open(url, "_blank");
        });

        function restWorkplace() {
            var months = $('.restMonths').val();
            var year = $('.restYears').val();
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "admin/dashboard/ajaxAction",
                data: {'action': 'getRestWorkPlace', 'data': {'months': months, 'year': year}},
                success: function(data) {
                    var data = JSON.parse(data);
                    var workplaces = (data == '' || data == null ? 'N/A' : data.workplaces)
                    var address = (data == '' || data == null ? 'N/A' : data.adresses)
                    var totalTime = (data == '' || data == null ? 'N/A' : data.totalTime)
                    $('.workplaces').text(workplaces);
                    $('.address').text(address);
                    $('.workplaceHours').text(totalTime);
                }
            });
        }

        $('body').on('click', '.getStaffData', function() {
            var staffId = $('#staffId option:selected').val();
            var months = $('#staffMonth').val();
            var year = $('#staffYear').val();
            $('.staffName').text($('#staffId option:selected').text());
            $.ajax({
                type: "POST",
                headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val(), },
                url: baseurl + "admin/dashboard/ajaxAction",
                data: {'action': 'getStaffListData', 'data': {'months': months, 'staffId': staffId, 'year': year}},
                success: function(data) {
                    $('.staffListAppend').html(data);
                }
            });
        });

        $('body').on('click', '.printDiv', function() {
            var name = $('#workplaceName').val();
            var months = $('#workplaceMonth').val();
            var year = $('#workplaceYear').val();
            $('.wpname').text(name);
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "admin/dashboard/ajaxAction",
                data: {'action': 'getWorkplaceListData', 'data': {'months': months, 'name': name, 'year': year}},
                success: function(data) {
                    $('.c-modal__body').append(data);
                    var divToPrint = document.getElementById('DivIdToPrint');
                    var newWin = window.open('', 'Print-Window');
                    newWin.document.open();
                    newWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</body></html>');
                    newWin.document.close();
                    setTimeout(function() {
                        newWin.close();
                    }, 10);
                }
            });
        });

        $('body').on('click', '.printStaff', function() {
            var staffId = $('#staffId option:selected').val();
            var months = $('#staffMonth').val();
            var year = $('#staffYear').val();
            $('.staffName').text($('#staffId option:selected').text());
            $.ajax({
                type: "POST",
                headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val(), },
                url: baseurl + "admin/dashboard/ajaxAction",
                data: {'action': 'getStaffListData', 'data': {'months': months, 'staffId': staffId, 'year': year}},
                success: function(data) {
                    $('.staffListAppendPrint').append(data);
                    var divToPrint = document.getElementById('staffToPrint');
                    var newWin = window.open('', 'Print-Window');
                    newWin.document.open();
                    newWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</body></html>');
                    newWin.document.close();
                    setTimeout(function() {
                        newWin.close();
                    }, 10);
                }
            });
        });

    }
    return {
        init: function() {
            handleGenral();
            $('.findBestOfice').trigger('click');
            $('.findBestStaff').trigger('click');
        }
    }
}();
