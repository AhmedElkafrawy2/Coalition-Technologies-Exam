$(document).ready(function(){

    $('#btn-form-submit').on("click", function(){

       var url =   $("#add-product-form").attr('action');
       var name = $("#product-name").val();
       var qty = $("#quantity").val();
       var price = $("#price").val();
       var _token = $( "input[name='_token']" ).val();
       var data = { name : name, quantity : qty, price : price, _token : _token };


       /*
       *
       *    Send the Api Request To Update To the Json File
       * */
       Request(url, "POST", data, function(){}, function(data){
            // Display Error Messages
           if(data.status == false){
               alert(data.msg);
               return false;
           }

           // Update Ui
           var value = parseInt(price) * parseInt(qty);
           $(".table tbody").append("<tr><td>"+  name +"</td><td>"+ qty +"</td><td>"+ price +"</td><td>"+ data.date +"</td><td>"+ value +"</td></tr>")
           ClearFiels();
       }, function(error){
            console.log(error);
       });
    });

    function ClearFiels(){
        $("#product-name").val("");
        $("#quantity").val("");
        $("#price").val("");
    }

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
});