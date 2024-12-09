<?php
    session_start();
    if(!(isset($_SESSION['username']) && isset($_SESSION['id']))) {
        header('Location: index.php');
        exit();
    }
    include 'header.php';
?>

<body>
    <script src='opinionpage.js'></script>
    <div class="container mypagecontainer">
        <div class="container mt-5 opnionboxcontainer">
            <h1 class="text-center opinionboxtitle">Tell us what You think about dogs!</h1>
            <form class="mt-4">
                <!-- Campo di input per il testo -->
                <div class="mb-3">
                    <input type="text" class="form-control" id="opinion" name="opinion" placeholder="Your opinion" required>
                </div>
                <!-- Pulsante di invio -->
                <div class="d-grid">
                    <button type="button" class="btn btn-primary" onclick="sendOpinion()">Publish</button>
                </div>
            </form>
        </div>


        <div id="allopinions" class="container mt-5 opnionboxcontainer">
        </div>
    </div>
</body>
</html>