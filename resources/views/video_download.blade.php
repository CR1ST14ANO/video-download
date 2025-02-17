<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Download de Vídeo do YouTube</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        header h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        input {
            width: 80%;
            padding: 10px;
            margin-bottom: 15px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            padding: 10px 20px;
            font-size: 18px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:disabled {
            background-color: #cccccc;
            cursor: not-allowed;
        }

        button:hover {
            background-color: #0056b3;
        }

        footer {
            margin-top: 20px;
            font-size: 14px;
            color: #777;
        }

        p {
            font-size: 16px;
            color: #007bff;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>Baixe seus vídeos do YouTube</h1>
        </header>

        <main>
            <input type="text" id="youtubeLink" placeholder="Cole o link do vídeo do YouTube" />
            <button id="downloadButton" onclick="downloadVideo()">Baixar</button>
            <p id="statusMessage"></p>
        </main>

        <footer>
            <p>&copy; 2025 Meu Site de Downloads</p>
        </footer>
    </div>

    <script>
        function downloadVideo() {
            var button = document.getElementById("downloadButton");
            var statusMessage = document.getElementById("statusMessage");

            // Desabilitar o botão e alterar o texto
            button.disabled = true;
            button.innerText = "Processando...";

            // Simulando o processo de download com um delay
            setTimeout(function() {
                // Alterar o texto para indicar que o download foi concluído
                statusMessage.innerText = "Download concluído!";

                // Reabilitar o botão após o processo
                button.disabled = false;
                button.innerText = "Baixar";
            }, 3000); // 3 segundos de simulação
        }
    </script>
</body>
</html>
