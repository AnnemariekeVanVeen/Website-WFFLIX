<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top font-weight-bold">
    <div class="container">
        <a class="navbar-brand font-weight-bold" href="#">CODEFLIX</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse px-2" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link" href="index.php?do=default">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php?do=videos">Videos</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php?do=contact">Contact</a></li>
                <?php
                if (isset($_SESSION['email']) && !empty($_SESSION['email'])): ?>
                    <a class="nav-link" href="index.php?do=account">Account</a>
                    <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin']) : ?>
                        <li class="nav-item"><a class="nav-link" href="index.php?do=adminpage">Admin</a></li>
                    <?php endif; ?>
                    <a class="nav-link" href="index.php?do=logout">Sign Out</a>
                <?php else: ?>

                    <a class="nav-link" href="index.php?do=login">Sign In</a>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>