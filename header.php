<!DOCTYPE html>
<html>
<head>
    <title>Create Post</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css"/>
    <script src="jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>

    <style>
        body {
            background: #ecf0f3;
            padding: 100px 0;
            margin: 0;
            overflow-x: hidden;
        }
        * {
            box-sizing: border-box;
        }
        #decryptedCanvas {
            display: none;
        }
        .section-ai {
            background: #f9f9f9;
            padding: 50px;
            border-radius: 20px;
        }
        .section-ai form textarea {
            outline: none;
            width: 100%;
            padding: 20px;
            height: 100px;
            border: 2px solid #ededed;
        }
    </style>
</head>

<body>