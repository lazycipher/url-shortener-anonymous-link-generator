$(document).ready(function(){
    $('#originalUrl').on('input', function(e) {
        var input=$(this);
        
        if(input.val()==""){
            $("#urlError").html("Can't be Null");
            e.preventDefault();
        }
        else{
            if (input.val().substring(0,4)=='www.'){input.val('http://www.'+input.val().substring(4));}
            var re = /(http|ftp|https):\/\/[\w-]+(\.[\w-]+)+([\w.,@?^=%&:\/~+#-]*[\w@?^=%&\/~+#-])?/;
            var is_url=re.test(input.val());
            if(is_url){input.removeClass("invalid").addClass("valid");
            $("#urlError").html("Looks Fine");
            }
            else{input.removeClass("valid").addClass("invalid");
            $("#urlError").html("Invalid");}
            e.preventDefault();
        }
        
    });
    $("#input-form").submit(function(){
        var originalUrl = $("#originalUrl").val();
        $.ajax({
            
            type:"POST",
            url:'./Functions/action.php',
            data:'url='+ originalUrl,
            dataType:"text",
            beforeSend: function(){ 
                $("#shortUrl").html('Loading');
                
            },
            success:function(data){
                if(data == 0){
                    $('#shortUrl').addClass('alert alert-danger').html('Invalid Url')
                    $("#qrcode").empty();
                    alert('Error: Invalid URL');
                }
                else{
                    data = window.location.protocol+'//'+window.location.hostname+'/'+data;
                    //data="http://shorten.gq/"+data;
                    $('#shortUrl').addClass('alert alert-success')
                    $("#shortUrl").html(data);
                    $("#qrcode").empty();
                    $("#qrcode").qrcode(data);
                }
            }
            

            });
            return false;
        });
});
