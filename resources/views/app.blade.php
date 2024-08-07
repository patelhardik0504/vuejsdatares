<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <title>Laravel</title>
       
       <!-- Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

<!-- Popper.js (for Bootstrap) -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/all.min.js" integrity="sha512-u3fPA7V8qQmhBPNT5quvaXVa1mnnLSXUep5PS1qo5NRzHwG19aHmNJnj1Q8hpA/nBWZtZD4r4AX6YOt5ynLN2g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    </head>
    <body class="bg-gray-50 h-screen antialiased leading-none font-sans">

        <div id="app"></div>

        <!-- <form id="myForm">
    <label for="exampleSelect">Example Select:</label>
    <select name="exampleSelect" id="exampleSelect">
        <option value="value1">Option 1</option>
        <option value="value2">Option 2</option>
        <option value="value3">Option 3</option>
    </select><br>
<input type="text" >
    <label for="fileUpload">File Upload:</label>
    <input type="file" name="fileUpload" id="fileUpload"><br>

  

    
</form> -->

<button type="button" id="disableButton">Disable Fields</button>
    <button type="button" id="enableButton">Enable Fields</button>

        <script src="{{mix('js/app.js')}}"></script>

        <script>
        $(document).ready(function() {
            // Function to disable or enable form fields
            function toggleFormFields(disable) {
                $('#myForm :input').prop('disabled', disable);
            }
            
            // Example of disabling fields on button click
            $('#disableButton').click(function() {
                toggleFormFields(true); // Disable all fields
            });

            $('#enableButton').click(function() {
                console.log('asdasda');
                toggleFormFields(false); // Enable all fields
            });
        });
    </script>
    </body>
</html>
