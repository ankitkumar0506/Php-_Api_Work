<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <title> Responsive Registration Form | CodingLab </title>
  <link rel="stylesheet" href="style.css">

  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/json2/20160511/json2.min.js" integrity="sha512-uWk2ZXl3GVrq6DZsrL5dSg1S/F3MNQ9VaDFigqXOoKUnWG58UxOuJGfTrzh5KjpoBvPiFniL2PahU2HUTFMJXw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/json2/20160511/json2.js" integrity="sha512-h3RrO+eudpiPUYFkwORXD2ppuy9jOXQ+MzVEIo7k+OuA7y9Ze5jsQ5WN/ZSgI+ZSIngT6pDSaqpgmnam2HPe1g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
  <div class="container">
    <div class="title">Student Foam</div>
    <div class="content">


      <form id="addfoam">
        <div class="user-details">
          <div class="input-box">
            <span class="details">Student Name</span>
            <input type="text" name="sname" id="sname" placeholder="Enter your name" required>
          </div>
          <div class="input-box">
            <span class="details">Student Age</span>
            <input type="text" name="sage" id="sage" placeholder="Enter your username" required>
          </div>
          <div class="input-box">
            <span class="details">city</span>
            <input type="text" name="scity" id="scity" placeholder="Enter your password" required>
          </div>
          <div class="input-box">
            <span class="details">Email</span>
            <input type="text" name="semail" id="semail" placeholder="Enter your email" required>
          </div>
          <div class="input-box">
            <span class="details">Phone Number</span>
            <input type="text" name="sphone" id="sphone" placeholder="Enter your number" required>
          </div>
          <div class="input-box">
            <span class="details">Confirm Password</span>
            <input type="text" name="spass" id="spass" placeholder="Confirm your password" required>
          </div>
        </div>
        <!-- <div class="gender-details">
          <input type="radio" name="gender" id="dot-1">
          <input type="radio" name="gender" id="dot-2">
          <input type="radio" name="gender" id="dot-3">
          <span class="gender-title">Gender</span>
          <div class="category">
            <label for="dot-1">
            <span class="dot one"></span>
            <span class="gender">Male</span>
          </label>
          <label for="dot-2">
            <span class="dot two"></span>
            <span class="gender">Female</span>
          </label>
          <label for="dot-3">
            <span class="dot three"></span>
            <span class="gender">Prefer not to say</span>
            </label>
          </div>
        </div> -->
        <div class="button">
          <input type="submit" id="savedata" value="Register">
        </div>
      </form>



      <body>
        <table>
        <td id="table-data">
          <table>
            <tr>
            <th width="40px">Id</th>
            <th>Student Name</th>
            <th>Student Age</th>
            <th>city</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Confirm Password</th>


            <th width="70px">Delete</th>
            <th width="60px">Edit</th>
            </tr>
            <tbody id="load-table" ></tbody>
          </table>
          </td>
        </table>
      </body>





  <script type="text/javascript">
 $(document).ready(function()
{
  //Fetch All Records


  // Function for form Data to JSON Object
  function jsonData(xyz){
    console.log(xyz)
      var arr = $(xyz).serializeArray();
      // console.log(arr)
    
      var obj = {};    

      

      for(var a= 0; a < arr.length; a++){
        if(arr[a].value == ""){
          return false;
        }
        obj[arr[a].name] = arr[a].value;
      }

      console.log(obj)
      
      var json_string = JSON.stringify(obj);

      return json_string;
      
  }

  //Insert New Record
  $("#savedata").on("click",function(e){
   e.preventDefault();
  //  console.log(e)

    var x = jsonData("#addfoam");
    console.log(x);//false

    if( x == false){
      message("All Fields are required.",false);
    }else{
      $.ajax({ 
        
      url : 'http://localhost/Nirev%20sir/php_rest_api_crud/New%20folder/api_inser_data.php',
      type : "POST",
      data : x,
      success : function(data){

        // console.log(data)
        message(data.message, data.status);

        if(data.status == true){
          loadTable();
          $("#addfoam").trigger("reset");
        }
      }
    });
  }
  });

//fach all data
  function loadTable(){ 
    $("#load-table").html("");
    $.ajax({ 
      url : 'http://localhost/Nirev%20sir/php_rest_api_crud/New%20folder/api-fetch-all.php',
      type : "GET",
      success : function(data){
        if(data.status == false){
          $("#load-table").append("<tr><td colspan='12'><h2>"+ data.message +"</h2></td></tr>");
        }else{
          $.each(data, function(key, value){ 
            $("#load-table").append("<tr>" + 
                                    "<td>" + value.id + "</td>" + 
                                    "<td>" + value.student_name +"</td>" + 
                                    "<td>" + value.student_age +"</td>" + 
                                    "<td>" + value.city +"</td>" + 
                                    "<td>" + value.student_email +"</td>" + 
                                    "<td>" + value.student_phone +"</td>" + 
                                    "<td>" + value.student_pass +"</td>" + 
                                    "<td><button class='edit-btn' data-eid='"+ value.id + "'>Edit</button></td>" + 
                                    "<td><button class='delete-btn' data-id='"+ value.id + "'>Delete</button></td>" + 
                                    "</tr>");
          });
        }
      }
    });
  }

  loadTable();
















 });
</script>

<!-- 
<table>
        <td id="table-data">
          <table>
            <tr>
            <th width="40px">Id</th>
            <th>Student Name</th>
            <th>Student Age</th>
            <th>city</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Confirm Password</th>


            <th width="70px">Delete</th>
            <th width="60px">Edit</th>
            </tr>
            <tbody id="load-table" ></tbody>
          </table>
          
        </td>
      </table>
    </div>
  </div> -->


</body>

</html>