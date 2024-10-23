<!DOCTYPE html>
<html>
<head>
    <title>PRPR Tester</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 0 auto;
        }

        form input[type="file"] {
            margin-bottom: 20px;
        }

        form button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        form button:hover {
            background-color: #45a049;
        }

        hr {
            margin-top: 40px;
            border: none;
            height: 1px;
            background-color: #ddd;
        }

        p {
            font-size: 14px;
            color: #555;
            line-height: 1.6;
        }

        h3 {
            margin-bottom: 10px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        .instructions {
            background-color: #e9ecef;
            padding: 20px;
            border-radius: 5px;
            font-size: 14px;
            color: #444;
        }

        .success {
            color: green;
            text-align: center;
        }

        .error {
            color: red;
        }
    </style>
</head>
<body>
<h1>PRPR Tester</h1>

@if (session('success'))
    <p class="success">{{ session('success') }}</p>
@endif

<form action="{{ route('test') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="file" required>
    <button type="submit">Submit</button>

    <div>
        <div class="error">
            @if(session('error'))
                {{session('error')}}
            @endif
        </div>
        <h3>Select functions to be tested:</h3>
        @foreach (config('app.supported_functions') as $function)
            <label>
                <input type="checkbox" name="functions[]" value="{{ $function }}"> {{ $function }}
            </label>
        @endforeach
    </div>
</form>

<hr>

<div class="instructions">
    <p>
        After submitting the program, an URL will be returned for the results. The submitted program must end at "k" input; otherwise,
        the result will not contain relevant data.
        <br>
        Should you have any problems, contact me at <a href="mailto:xdudakm@stuba.sk">xdudakm@stuba.sk</a>
    </p>
</div>
</body>
</html>
