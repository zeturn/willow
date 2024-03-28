<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Change Email</title>
</head>
<body>
    <h1>Change Email</h1>

    <form action="{{ route('change.email') }}" method="post">
        @csrf

        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="{{ Auth::user()->name }}" readonly>
        </div>

        <div>
            <label for="email">Current Email:</label>
            <input type="email" id="email" name="email" value="{{ Auth::user()->email }}" readonly>
        </div>

        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>

        <div>
            <label for="new_email">New Email:</label>
            <input type="email" id="new_email" name="new_email" required>
        </div>

        <div>
            <button type="submit">Change Email</button>
        </div>
    </form>
</body>
</html>
