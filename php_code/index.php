<?php
    session_start();

    if(isset($_SESSION['username']) && isset($_SESSION['id'])) {
        header('Location: opinionpage.php');
        exit();
    }

    include 'header.php';
?>
<body class="bg-light">
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card p-4 shadow" style="width: 400px;">
            <h3 class="text-center mb-4">Login</h3>
            <form>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Inserisci il tuo username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Inserisci la tua password" required>
                </div>
                <div id="errors" class="alert alert-danger" role="alert" style="display: none;">
                </div>
                <button type='button' class="btn btn-primary w-100" onclick="handleLogin()">Login</button>
            </form>
            <p class="text-center text-muted mt-3">Non hai un account? <a href="register.php">Registrati</a></p>
        </div>
    </div>
</body>
</html>

