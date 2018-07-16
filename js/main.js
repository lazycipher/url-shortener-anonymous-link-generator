
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
                    $('#shareExt').addClass('hidden');
                    alert('Error: Invalid URL');
                }
                else{
                    data = window.location.protocol+'//'+window.location.hostname+'/'+data;
                    var safeUrl = encodeURI(data);
                    $('#qrUrlShareWrap').removeClass('hidden')
                    $("#shortUrlLink").empty().removeClass('alert alert-danger').addClass('alert alert-secondary');
                    $("#qrcode").empty();
                    $("#qrcode").qrcode({width: 128,height: 128,text: data});
                    $("#shortUrlLink").val(data);
                    $("#shareExt").removeClass('hidden');
                    $("a[href='https://www.facebook.com/sharer.php']").attr('href', 'https://www.facebook.com/sharer.php?u='+safeUrl);
                    $("a[href='https://plus.google.com/share']").attr('href', 'https://plus.google.com/share?url='+safeUrl);
                    $("a[href='https://twitter.com/share']").attr('href', 'https://twitter.com/share?url='+safeUrl);
                    $("a[href='https://www.linkedin.com/shareArticle?mini=true&url=']").attr('href', 'https://www.linkedin.com/shareArticle?mini=true&url='+safeUrl);
                }
            }
            

            });
            return false;
        });
        $('#clickToCopyButton').click(function(){
            var copiedShortUrl = $('#shortUrlLink');
            copiedShortUrl.select();
            document.execCommand("copy");
            $('#copyUrlIcon').removeClass('fa-clipboard').addClass('fa-clipboard-check');
            });

        
});
