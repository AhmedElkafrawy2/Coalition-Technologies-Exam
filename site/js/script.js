$(document).ready(function(){

    $('#btn-form-submit').on("click", function(){
       var url =   $("#add-product-form").attr('data-url');
       var name = $("#product-name").val();
       var qty = $("#quantity").val();
       var price = $("#price").val();
       var token = $( "input[name='_token']" ).val();
       var data = { name : name, qty : qty, price : price };

       /*
       *
       *    Update the UI
       *
       * */


       /*
       *
       *    Send the Api Request To Update To the Json File
       * */
       Request(url, "POST", data, function(){}, function(){}, function(){

       });
    });
    /*
    * ajax Request function
    * */
    function Request(url , type , data , beforSend , success, error){
        $.ajax({
            type: type,
            url: url,
            data: JSON.stringify(data),
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            beforeSend: beforSend,
            success: success,
            error: error
        });
    }
});1111