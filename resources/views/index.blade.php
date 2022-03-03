<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ACTO Card Game</title>
    <link rel="stylesheet" href="/css/app.css" />

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

    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="col-lg-6 mx-auto" id="app" v-cloak>
        <card-component inline-template>
            <div>
                <form method="POST" action="/result">


                    @csrf
                    <!-- {{ csrf_field() }} -->
                    <div class="contact-form-success alert alert-success mt-4" v-if="success">
                        <strong> </strong> Game has finished
                    </div>
                    <div class="contact-form-error alert alert-danger mt-4" v-if="error">
                        <strong>Error!</strong> Please enter all fields
                    </div>
                    <div class="form-group mb-3">
                        <label for="inputName">Name</label>
                        <input type="text" class="form-control-lg" name="inputName" id="name" placeholder="Enter your name" v-model="formData.name">
                    </div>
                    <div class="form-group mb-1">
                        <label for="inputCards">Cards</label>
                        <input type="text" class="form-control-lg" name="inputCard" id="card" placeholder="Enter your cards" v-model="formData.card">
                    </div>
                    <button type="submit" id="submit" class="btn btn-success btn-lg">Let's Play</button>
                </form>


                <div id="result" style="display: block;">

                    @if(isset($user_name))
                    <label class="form-control-lg"> {{ $user_name }} </label>
                    @foreach($user_hand as $u)
                    <label class="form-control-lg"> {{ $u }} </label>
                    @endforeach
                    <br>
                    <label class="form-control-lg"> Opponent </label>
                    @foreach($opponent_hand as $o)
                    <label class="form-control-lg"> {{ $o }} </label>
                    @endforeach
                    <br>
                    <label class="form-control-lg"> {{ $user_name }} : {{$user_score}} </label>
                    <br>
                    <label class="form-control-lg"> Opponent : {{$opponent_score}} </label>
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th scope="col">User Name</th>
                                <th scope="col">Games Won</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($user_names as $un)

                            <tr>
                                <td>{{ $un->name }}</td>
                                @foreach($users as $u)

                                <td>{{ $u->games_won }}</td>

                                @endforeach
                            </tr>

                            @endforeach


                        </tbody>
                    </table>
                    @endif


                </div>
            </div>
        </card-component>
    </div>

    <script src="/js/app.js"></script>

</body>

</html>