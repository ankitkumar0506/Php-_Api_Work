<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>login</title>
    </head>
<body>
    <h1>login page</h1>

<a href="home">back to home</a>
    <fieldset>
        <legend>login part</legend>
        <form id="form" action="" method="POST" >
           
            <label for="email">Email  : </label><input type="email" name="email" id="email"> <br>
            <label for="password">Password  : </label><input type="password" name="password" id="password"> <br>
            <button type="submit" name="log" value="login">login here</button>

        </form>
    </fieldset>
</body>
</html>

<script>
$('#form').submit(function(evt) {
    evt.preventDefault();
    let email = document.getElementById("email").value
    let password = document.getElementById("password").value
    fetch("http://localhost/Laravel/Laravel-assg-assessment/Assignments/Webservices/login", {
      headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json'
      },
      method: "POST",
      body: JSON.stringify({
        username: email,
        password: password
      })
    }).then((response)=>response.json()).then((response)=>{
      console.log(response);
    })
  })
</script>