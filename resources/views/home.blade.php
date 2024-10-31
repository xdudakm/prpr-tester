<!DOCTYPE html>
<html>
<head>
    <title>PRPR Tester Interface</title>
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

        table, td, th {
            border: 1px solid;
        }

        table {
            border-collapse: collapse;
        }
    </style>
</head>
<body>
<h1>PRPR Tester Interface</h1>

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
        This web works as an interface for <a href="https://github.com/FedorViest/opp_prpr2024/blob/main/Tester/README.md"
                                              target="_parent">OPP PRPR Tester</a>.
    </p>
    <h3>How to use</h3>
    <p>
        After submitting the program, an URL will be returned for the results. The submitted program must end at "k" input.
        Otherwise there will be no test results.
        <br>
        When testing some functions, other functions are used for their validation:
    <table>
        <tr>
            <th>Function</th>
            <th>Prerequisite</th>
        </tr>
        <tr>
            <td>v1</td>
            <td>k</td>
        </tr>
        <tr>
            <td>v2</td>
            <td>v1, n, k</td>
        </tr>
        <tr>
            <td>v3</td>
            <td>v1, m, k</td>
        </tr>
        <tr>
            <td>v-ine</td>
            <td>k</td>
        </tr>
        <tr>
            <td>h</td>
            <td>v1, k</td>
        </tr>
        <tr>
            <td>n</td>
            <td>v1, v2, k</td>
        </tr>
        <tr>
            <td>q</td>
            <td>v1, v2, n, k</td>
        </tr>
        <tr>
            <td>w</td>
            <td>v1, v2, n, k</td>
        </tr>
        <tr>
            <td>e</td>
            <td>v1, n, k</td>
        </tr>
        <tr>
            <td>m</td>
            <td>v1, k</td>
        </tr>
        <tr>
            <td>a</td>
            <td>v1, m, v3, k</td>
        </tr>
        <tr>
            <td>k</td>
            <td></td>
        </tr>
    </table>
    <br>
    Should you have any problems, contact me at <a href="mailto:xdudakm@stuba.sk">xdudakm@stuba.sk</a>
    </p>
</div>
</body>
</html>
