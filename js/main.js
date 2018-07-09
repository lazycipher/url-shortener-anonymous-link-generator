$(document).ready(function(){
    $('#originalUrl').on('input', function() {
        var input=$(this);
        
        if(input.val()==""){
            $("#urlError").html("Can't be Null");
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
                    alert('Error: '+ originalUrl)
                }
                else{
                    $("#shortUrl").html(data);
                }
            }
            

            });
            return false;
        });
});


// $(function() {
//     $("#submit_login").click(function() { // if submit button is clicked
//         $.ajax({ // JQuery ajax function
//         type: "POST", // Submitting Method
//         url: 'login.php', // PHP processor
//         data: 'username='+ username + '&password=' + password, // the data that will be sent to php processor
//         dataType: "html", // type of returned data
//         success: function(data) { // if ajax function results success
//         if (data == 0) { // if the returned data equal 0
//         $('.errormess').html('Wrong Login Data'); // print error message
//         } else { // if the reurned data not equal 0
//         $('.errormess').html('<b style="color: green;">you are logged. wait for redirection</b>');// print success message   
//         document.location.href = 'private.php'; // redirect to the private area  
//         }
//         }
//        });
//       return false;
//       });
//   });