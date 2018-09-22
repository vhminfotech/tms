var Dashboard = function(){
   
   var handleGenral = function(){
       $('body').on('click','.findBestStaff',function(){
           var month = $('.staffMonths option:selected').val();
           var year = $('.staffYears option:selected').val();
       });
       
       $('body').on('click','.findBestOfice',function(){
           var month = $('.staffMonths option:selected').val();
           var year = $('.staffYears option:selected').val();
       });
   }
   
    return {
        init : function(){
            handleGenral();
        }
    }
}();
