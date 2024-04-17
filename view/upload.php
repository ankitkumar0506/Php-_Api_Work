<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Image upload page</title>
    </head>
<body>
    <h1>Upload images here</h1>

<a href="home">back to home</a>
    <fieldset>
        <legend>image uploading part</legend>
        <form action="" method="POST" id="form" enctype="multipart/form-data">
           
            <label for="name">Name  : </label><input type="text" name="name" id="name" value="name"> <br> <hr>
            <!-- <label for="image">Choose image  : </label><input type="file" name="image" id="image"> -->
            <label for="images">Choose image  : </label><input type="file" name="images" value="images" id="images"> 
            <br>
            <button type="submit" name="log">upload here</button>

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
        
    });
        
</script>