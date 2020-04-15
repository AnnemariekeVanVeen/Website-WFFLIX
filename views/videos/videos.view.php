<!-- Video Course Page -->

<div class="container mt-5">
    <div class="row">
        <div class="col-lg-12 align-items-center p-0">
            <div class="card h-100" style="border: 3px solid #131B23">
                <div class="card-group-item">
                    <header class="card-header">
                        <h6 class="title text-white pt-2">Select Language</h6>
                    </header>
                    <div class="filter-content">
                        <div class="card-body">
                            <!-- Filter -->
                            <form method="get" action="">
                                <input type="hidden" name="do" value="videos">
                                <label class="form-check">
                                    <input class="form-check-input" <?= isset($_GET['unix']) ? 'checked' : '' ?>
                                           type="checkbox" value="y" id="unix"
                                           name="unix">
                                    <span class="form-check-label">Unix</span>
                                </label>
                                <label class="form-check">
                                    <input class="form-check-input" <?= isset($_GET['c_sharp']) ? 'checked' : '' ?>
                                           type="checkbox" value="y" id="c_sharp"
                                           name="c_sharp">
                                    <span class="form-check-label">C#</span>
                                </label>
                                <label class="form-check">
                                    <input class="form-check-input" <?= isset($_GET['php']) ? 'checked' : '' ?>
                                           type="checkbox" value="y" id="php"
                                           name="php">
                                    <span class="form-check-label">PHP</span>
                                </label>
                                <label class="form-check">
                                    <input class="form-check-input" <?= isset($_GET['html']) ? 'checked' : '' ?>
                                           type="checkbox" value="y" id="html"
                                           name="html">
                                    <span class="form-check-label">HTML</span>
                                </label>
                                <label class="form-check">
                                    <input class="form-check-input" <?= isset($_GET['css']) ? 'checked' : '' ?>
                                           type="checkbox" value="y" id="css"
                                           name="css">
                                    <span class="form-check-label">CSS</span>
                                </label>
                                <input type="submit" value="Filter"
                                       class="btn btn-primary btn-block btn-login mt-3">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">

            <?php
            /*
             * Start foreach loop for videos
             */
            foreach ($data['videos'] as $row):
                ?>
                <div class='col-lg-4 col-md-6 my-5'>
                    <div class="card h-100" style="border: 3px solid #131B23">
                        <div class="card-group-item">
                            <video class="card-img-top" controls>
                                <source src="./src/videos/<?= $row->getVideoUrl(); ?>" type="video/mp4">
                            </video>
                            <div class='card-body'>
                                <h4 class='card-title'>
                                    <a href='#'><?= $row->getVideoName(); ?></a>
                                </h4>

                                <p class='card-text'><?= $row->getVideoDescription(); ?></p>

                            </div>
                            <div class='card-footer'>
                                <h4 class="mt-2">
                                    <?= $row->getVideoSubject(); ?>
                                </h4>
                            </div>
                        </div>

                        <?php if (isset($_SESSION["is_admin"]) && $_SESSION["is_admin"]) { ?>
                            <div class="m-2">
                                <form method="post" class="text-center"><input type="hidden" name="id"
                                                                               value="<?= $row->getId(); ?>"><input
                                            type="submit" name="delete"
                                            class='font-weight-bold text-decoration-none btn btn-secondary'
                                            value="Delete"></form>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            <?php endforeach; ?>

            <!-- SHow CRUD Admin -->
            <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin']) : ?>
            <div class='col-lg-6 col-md-6 my-5'>
                <div class="card" style="border: 3px solid #131B23">
                    <div class="card-group-item">
                        <div class="card-body">
                            <form method="post" class="text-center" enctype="multipart/form-data">
                                <div class="card-text">
                                    <h3>Add Video</h3>

                                    <input type="file" name="video_upload" accept="video/mp4"
                                           placeholder="Choose File"
                                           required
                                           autofocus/>
                                    <div class='card-body'>
                                        <h4 class='card-title'>
                                            <input class="form-control mb-3 rounded-pill" type="text" id="name"
                                                   name="name"
                                                   placeholder="Name" required autofocus/>
                                        </h4>

                                        <div class='card-text'>
                                            <input class="form-control mb-3 rounded-pill" type="text"
                                                   id="description"
                                                   name="description" placeholder="Description"
                                                   required autofocus/>

                                            <input class="form-control mb-3 rounded-pill" type="text"
                                                   id="subject"
                                                   name="subject" placeholder="Subject"
                                                   required autofocus/>
                                        </div>
                                    </div>
                                    <div class='m-2'>
                                        <input type="submit" name="create"
                                               class='font-weight-bold text-decoration-none btn btn-secondary'
                                               value="Add Video">
                                    </div>
                                    <div class="text-center pb-3" style="text-decoration-line:underline "><?php
                                        echo Session::getFlash('alert');
                                        ?>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>