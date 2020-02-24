<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Reset Password</title>
</head>
<style>
    @import url("https://fonts.googleapis.com/css?family=Lato:400,700&display=swap");

    * {
        box-sizing: border-box;
        padding: 0;
        margin: 0;
    }
    body {
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='hsl(0, 0%25, 20%25)' opacity='0.1' width='20' height='20' viewBox='-5 -5 10 10'%3E%3Ccircle id='dot' r='1' /%3E%3Cuse href='%23dot' x='5' y='5' /%3E%3Cuse href='%23dot' x='-5' y='5' /%3E%3Cuse href='%23dot' x='5' y='-5' /%3E%3Cuse href='%23dot' x='-5' y='-5' /%3E%3C/svg%3E"),
        hsl(0, 0%, 95%);
        font-family: "Lato", sans-serif;
        background-size: 10px;
    }

    form {
        padding: 1.5rem 2rem;
        background: hsl(0, 0%, 100%);
        color: hsl(0, 0%, 10%);
        max-width: 450px;
        width: 450px;
        display: flex;
        flex-direction: column;
        box-shadow: 0 1px 10px -8px currentColor;
    }
    form > * + * {
        margin-top: 0.5rem;
    }
    form label {
        display: block;
        font-weight: 700;
    }
    form span {
        font-weight: 700;
    }
    form input {
        padding: 0.5rem;
        border: 2px solid currentColor;
        background: none;
        font-size: 1rem;
        font-family: inherit;
        color: inherit;
        outline: none;
    }
    form button {
        background: hsl(0, 0%, 10%);
        border: none;
        color: hsl(0, 0%, 100%);
        font-size: 0.9rem;
        text-transform: uppercase;
        font-family: inherit;
        padding: 1rem 1rem;
    }
    .alert .inner {
        display: block;
        padding-top: 17px;
        padding-bottom: 17px;
        text-align: center;
        border: 1px solid rgb(180,180,180);
        background-color: rgb(212,212,212);
    }

    .alert.error .inner {
        border: 1px solid rgb(238,211,215);
        background-color: rgb(242,222,222);
    }

    .alert.success .inner {
        border: 1px solid rgb(214,233,198);
        background-color: rgb(223,240,216);
    }

    @keyframes dismiss {
        0% {
            opacity: 1;
        }
        90%, 100% {
            opacity: 0;
            font-size: 0.1px;
            transform: scale(0);
        }
    }

    @keyframes hide {
        100% {
            height: 0px;
            width: 0px;
            overflow: hidden;
            margin: 0px;
            padding: 0px;
            border: 0px;
        }
    }

</style>
<body>

@if ($errors->any())
    <div class="alert error">
        <ul>
            @foreach ($errors->all() as $error)
                <li class="inner">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if (session()->has('message'))
    <div class="alert success">
        <p class="inner">
        <h4>{{session()->get('message')}}</h4>
        </p>
    </div>
@endif
<form method="post">
    @csrf
    <span><strong>Reset Password</strong></span>
    <hr>
    <br>
    <label for="password">
        Password
    </label>
    <input type="password" id="password" name="password" />
    <br>
    <label for="repassword">
        Re-Password
    </label>
    <input type="password" id="repassword" name="password_confirmation" />
    <br>
    <button type="submit">Change Password</button>
</form>

</body>
</html>
