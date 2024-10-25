<!DOCTYPE html>
<html>
<head>
    <title>Submission Successful</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 20px;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #4CAF50;
        }

        pre {
            background-color: #fff;
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 4px;
            overflow-x: auto; /* Allows horizontal scrolling */
        }

    </style>
</head>
<body>
<h1>Submission Successful</h1>

<h2>Log Output</h2>

<pre>
{{$result}}
    </pre>

<div class="instructions">
    <h3>Don't know why there are no test results, or the result is "GOT TIMEOUT - Stuck in loop?"???</h3>
    <ul>
        <li>Check if your program ends when 'k' is passed on standard input.</li>
        <li>Check if you are outputting new lines correctly (tester might be waiting for new line output and will timeout if nothing
            comes)
        </li>
    </ul>

</div>

<h2><a href="{{route('home')}}">Back to home</a></h2>
</body>
</html>
