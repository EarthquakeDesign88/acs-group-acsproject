<!DOCTYPE html>
<html>
<head>
<title>Access Denied</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<meta charset="UTF-8">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
<body>
    <div class="w3-display-middle">
        <h1 class="w3-jumbo w3-animate-top w3-center"><code>Access Denied</code></h1>
        <hr class="w3-border-white w3-animate-left" style="margin:auto;width:50%">
        <h3 class="w3-center w3-animate-right">You don't have permission to view this page</h3>
        <h3 class="w3-center w3-animate-zoom">🚫🚫🚫🚫</h3>
        <h6 class="w3-center w3-animate-zoom">error code:403 forbidden</h6>
        <button class="btn btn-back" onclick="history.back()">Back</button>
    </div>
</body>
</html>

<style>
    body{
        background-color: black;
        color: white;
    }

    h1 {
        color: red;
    }

    h6{
        color: red;
        text-decoration: underline;
    }

    .btn {
        color: #fff;
        font-family: helvetica, sans-serif;
        font-size: 20px;
        font-weight: 900;
        background-color: #000;
        border: 0;
        padding: 20px 20px;
        border-radius:3px;
        line-height: 0.428571;
        position: absolute;
        z-index: 1;
        letter-spacing: -0.2px;
        top: 130%; 
        left: 50%; 
        transform: translate(-50%, -50%); 
    }

    .btn-back {
        color: #343a40;
        background-color: #fff;
        background-image: none;
        border-color: #343a40;
    }

    .btn-back:hover,
    .btn-back:active {
        color: #fff;
        background-color: red;
        border-color: red;
        display: flex;
        cursor: pointer;
    }
</style>