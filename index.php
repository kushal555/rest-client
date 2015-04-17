<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>View Template that use Bootstrap</title>

    <!-- Bootstrap CSS served from a CDN -->
    <link href="css/bootstrap.css" rel="stylesheet"/>
    <link href="css/bootstrap.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
  </head>

  <body>

    <div class="container">
      <div class="row top5">
          <div class="col-xs-12">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title"> <i class="icon-location-arrow"></i> Rest Client Tools</h3>
              </div>
              <div class="panel-body">
                <form role="form" id="rest_form">
                    <div class="row">
                        <div class="col-xs-10 col-sm-10 col-md-10">
                        <div class="form-group">
                            <input type="text" name="action_url" id="action_url" class="form-control input-sm" placeholder="Enter your URL"/>
                        </div>
                        </div>
                    </div>
                    <div id="module_container">
                    
                    </div>
                    <div class="row">
                        <div class="col-xs-5 col-sm-5 col-md-5">
                          <div class="form-group">
                            <input type="text" name="first_key" id="" class="form-control input-sm first" placeholder="Key"/>
                        </div>
                        </div>
                        <div class="col-xs-5 col-sm-5 col-md-5">
                          <div class="form-group">
                            <input type="text" name="first_value" class="form-control input-sm first" placeholder="Value" />
                          </div>
                        </div>
                    </div>
                    <input type="hidden" id="total_counter" value="0" />
                    <button type="submit" class="btn btn-success">
                        <i class="icon-circle-arrow-right icon-large"></i> Send
                    </button>
        
                </form>
              </div>
            </div>
            
            <!-- RESPNSE PANEL-->
            <div class="panel panel-default">
              <div class="panel-body" id="response_div">
                
              </div>
            </div>
            
          </div>
</div>
    </div>

    <script src="js/jquery-1.10.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function(){
        $("#total_counter").val("0");
       $(".first").focus(function(){
            var counter=$("#total_counter").val();
            counter++;
            
            var html = ' <div class="row" id="row_'+counter+'">\
                        <div class="col-xs-5 col-sm-5 col-md-5">\
                          <div class="form-group">\
                            <input type="text" name="key[]" id="key_'+counter+'" class="form-control input-sm first" placeholder="Key" />\
                        </div>\
                        </div>\
                        <div class="col-xs-5 col-sm-5 col-md-5">\
                          <div class="form-group">\
                            <input type="text" name="value[]" class="form-control input-sm first" placeholder="Value"/>\
                          </div>\
                        </div>\
                        <div class="col-xs-2 col-sm-2 col-md-2">\
                          <div class="form-group">\
                            <button type="button" id="button_'+counter+'" class="btn btn-default btn-circle"><i class="glyphicon glyphicon-remove"></i></button>\
                          </div>\
                        </div>\
                    </div>';
            $("#module_container").append(html);
            $("#key_"+counter).focus();
            $("#total_counter").val(counter);
            intiliaze_funtion();
       });
        
    });
    
    $("#rest_form").submit(function(e){
       e.preventDefault(); 
            var arr = $(this).serializeArray();
            var json = "";
            jQuery.each(arr, function(){
            	jQuery.each(this, function(i, val){
            		if (i=="name") {
            			json += '"' + val + '":';
            		} else if (i=="value") {
            			json += '"' + val.replace(/"/g, '\\"') + '",';
            		}
            	});
            });
            json = "{" + json.substring(0, json.length - 1) + "}";
            console.log(json);
            $.ajax({
                type:"POST",
                url:$("#action_url").val(),
                datatype : "json",
                contentType: "application/json; charset=utf-8",
                data : json,
                success: function(response){
                    $("#response_div").html(response);
                }
            });
        
    });
    
    
   function intiliaze_funtion()
   {
        $(".btn-circle").click(function(){
            $(this).closest(".row").remove();
            //console.log($(this).closest(".row").html());
        //$(this).parent(".row").html();
      });
   } 
    </script>
  </body>
</html>