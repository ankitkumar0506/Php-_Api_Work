<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Register page</title>
    </head>
<body>
    <h1>registration page</h1>
    <a href="home">back to home</a>

    <fieldset>
        <legend>registration form</legend>
        <form method="post" action="" id="form">

            <label for="name">Name  : </label><input type="text" name="name" id="name" value="name"> <br>
            <label for="email">Email  : </label><input type="email" name="email" id="email" value="email"> <br>
            <label for="password">Password  : </label><input type="password" name="password" id="password" value="password"> <br>
            <button type="submit" name="reg">Register here</button>

        </form>
    </fieldset>
</body>
</html>

<script>
    $('#form').submit(function(evt) {
        evt.preventDefault();
        let FormData = $(this).serializeArray()
        FormDataObject = {}
        FormData.forEach(element => {
            FormDataObject[element.name] = element.value;
        });
        fetch("http://localhost/Laravel/Laravel-assg-assessment/Assignments/Webservices/register", {
            headers: {
                "Content-Type": "application/json", // sent request
                "Accept": "application/json" // expected data sent back
            },
            method: 'POST',
            body: JSON.stringify(FormDataObject)
        }).then((response)=>response.json()).then((result)=>{
            console.log(result);
            if (result.Code == 1) {
                window.location.href = "login.php"
            } else {
                alert("error while inserting data")
            }
        })
    });
</script>