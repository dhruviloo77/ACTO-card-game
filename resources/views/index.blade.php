<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ACTO Card Game</title>
    <link rel="stylesheet" href="/css/app.css" />
    <script src="{{ mix('/js/app.js') }}"></script>

    <style>
        [v-cloak] {
            display: none !important;
        }

        form {
            text-align: center;
            font-size: large;
        }
    </style>
</head>

<body class="py-5">
    <form>
        <div class="form-group mb-3">
            <label for="inputName">Name</label>
            <input type="text" class="form-control-lg" id="inputName" placeholder="Enter your name">
        </div>
        <div class="form-group mb-1">
            <label for="inputCards">Cards</label>
            <input type="text" class="form-control-lg" id="inputCards" placeholder="Enter your cards">
        </div>
        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
        </div>
        <button type="submit" class="btn btn-success btn-lg">Let's Play</button>
    </form>
</body>

</html>