<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <style>
        .chat-row {
            margin: 50px;
        }

        ul {
            margin: 0;
            padding: 0;
            list-style: none;
        }

        ul li {
            padding: 8px;
            background: #928787;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        ul li:bth-child {
            background: #c3c5c5;
        }

        .chat-input {
            border: 1px solid lightgrey;
            border-radius: 10px;
            padding: 8px 10px;
        }
    </style>
</head>

<body class="antialiased">

    <div class="container">
        <div class="row chat-row">
            <div class="chat-content">
                <ul>
                </ul>
            </div>
            <div class="chat-section">
                <div class="chat-box">
                    <div class="chat-input bg-light" id="chatInput" contenteditable=""></div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdn.socket.io/3.1.3/socket.io.min.js"
        integrity="sha384-cPwlPLvBTa3sKAgddT6krw0cJat7egBga3DJepJyrLl4Q9/5WLra3rrnMcyTyOnh" crossorigin="anonymous">
    </script>

    <script>
        $(function(){
            let socket = io('http://localhost:3000');
            let chatInput = $('#chatInput');
            chatInput.keypress(function(e){
                let msg = $(this).html();
                console.log(msg);
                if(e.which === 13 && !e.shiftKey){
                    socket.emit('sendChatToServer',msg);
                    chatInput.html('');
                    return false;
                }
            });

            socket.on('sendChatToClient',(msg)=>{
                $('.chat-content ul').append(`<li>${msg}</li>`  );
            })
        });
    </script>
</body>

</html>