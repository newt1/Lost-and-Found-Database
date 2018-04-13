$(document).ready(function(){
    var table_name = $("#table_name").data("name");

    var categories = [];

    var base_url = "http://calvinnewton.net/Finder/";
    var get_data_url = "private/get_data.php"


    var get_category_table = function(){
        $.ajax(base_url+get_data_url+"?table=category", 
        { type: "GET",
          success: function(data_rows, status, jqXHR) {
            //id 0 should be null
            categories = data_rows;

          },
          error: function(jqXHR, status, error) {
              alert(jqXHR.responseText);
          }});
    }

    
    get_category_table();
    //refresh();

    $("#refresh").click(function(){
        $.ajax(base_url+get_data_url+"?table="+table_name, 
        { type: "GET",
          success: function(data_rows, status, jqXHR) {
              make_table_row(data_rows);
          },
          error: function(jqXHR, status, error) {
              alert(jqXHR.responseText);
          }});
    });


    $("#search").keyup(function(){
        var search_value = $("#search").val();
        $.ajax(base_url+get_data_url+"?table="+table_name, 
          { type: "POST",
            dataType: "json",
            data: {search: search_value},
            success: function(data_rows, status, jqXHR) {
                make_table_row(data_rows);
            },
            error: function(jqXHR, status, error) {
                alert(jqXHR.responseText);
            }});
    });

    
    var make_table_row = function (data_rows) {
        $("#table").html('');
       
       for(i = 0; i < data_rows.length; i++){
        var table_row = $("<tr></tr>");

        $.each(data_rows[i], function(key, value) {
            var table_data = $("<td></td>");
            if(key == "category"){                
                $(table_data).html(categories[value]);
            }
            else if(key == "description"){
                var link = $("<a href=\"edit.php?id=" + data_rows[i]["id"] + "\"> " + value + "</a>");
                table_data.append(link);
            } else{
                $(table_data).html(value);
            }
            table_row.append(table_data);
        });
        $("#table").append(table_row);
       }

    }

});