<?php

function dvmac_build_options_page()
{
    // If is exist
    $theme_opts = get_option('dvmac_opts');
?>

<div class="wrap">
    <div class="container">
        <!-- test the status variable exists and if is equal to 1 -->
        <?php if (isset($_GET['status']) && $_GET['status'] == 1) {
                echo '<div class="alert alert-success">Mise à jour effectuer</div>';
            } ?>
        <div class="bg-info p-4 mb-4 rounded-3">
            <h1 class="fs-2">Paramètres du site</h1>
        </div>
        <form method="post" action="admin-post.php" id="form-dvmac-options" class="form">
            <input type="hidden" name="action" value="dvmac_save_options">
            <!-- Validate Field -> Param Arbitraire -->
            <?php wp_nonce_field('dvmac_options_verify'); ?>
            <!-- Contents -->
            <div class="row">
                <!-- Image -->
                <div class="col-12">
                    <div class="mb-3 p-3 border border-2 rounded-2">
                        <h2 class="fs-4 text-center">Inserrez une image</h2>
                        <img src="<?php echo $theme_opts['img_01_url'] ?>" alt="image" class="my-4 w-25 mx-auto d-block"
                            id="img_preview_01">
                        <div>
                            <label for="dvmac_img_01" class="form-label">Image sauvegardée</label>
                            <!-- Disabled -->
                            <input type="text" value="<?php echo $theme_opts['img_01_url'] ?>" name="dvmac_img_01"
                                id="dvmac_img_01" class="form-control" disabled>
                            <!-- Hidden for submit in BDD -->
                            <input type="hidden" value="<?php echo $theme_opts['img_01_url'] ?>"
                                name="dvmac_hidden_img_01" id="dvmac_hidden_img_01" class="form-control">
                        </div>
                        <!-- Button Img -->
                        <div class="mt-3">
                            <button type="submit" id="btn_img_01" class="btn btn-md btn-primary">Choisir une
                                image</button>
                        </div>
                    </div>
                </div><!-- .image -->

                <!-- Label / Input -->
                <div class="col-12">
                    <div class="mb-3 p-3 border border-2 rounded-2">
                        <h2 class="fs-4 text-center">Inserrez une légende</h2>
                        <label for="dvmac_legend_01" class="form-label">Légende</label>
                        <input type="text" name="dvmac_legend_01" id="dvmac_legend_01"
                            value="<?php echo $theme_opts['legend_01']; ?>" class="form-control">

                    </div>
                </div><!-- .legend -->
            </div><!-- .row -->
            <!-- Button Legend -->
            <div class="mt-3">
                <button type="submit" class="btn btn-md btn-primary">Mettre à jour</button>
            </div>
        </form>
    </div>
</div>

<?php
}