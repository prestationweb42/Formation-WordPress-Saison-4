<!-- Footer -->
<footer class="bg-body-tertiary text-center text-md-start">
    <!-- Grid container -->
    <div class="container p-4">
        <!--Grid row-->
        <div class="row">
            <!-- Add Widget -->
            <?php if (is_active_sidebar('footer-widget')) : ?>
            <?php dynamic_sidebar('footer-widget'); ?>
            <?php else : ?>
            <!--Grid column-->
            <div class="col-lg-6 col-md-12 mb-sm-4 mb-md-0">
                <h5 class="text-uppercase">Footer Content</h5>
                <p>
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Iste atque ea quis
                    molestias. Fugiat pariatur maxime quis culpa corporis vitae repudiandae
                    aliquam voluptatem veniam, est atque cumque eum delectus sint!
                </p>
            </div>
            <?php endif; ?>
        </div><!-- row-->
    </div><!-- container -->


    <!-- Copyright -->
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.05);">
        © 2024 Copyright:
        <a class="text-body" href="https://mdbootstrap.com/">danvent.com</a>
        <?php wp_nav_menu(array('theme_location' => 'legal')); ?>

    </div>
    <!-- Copyright -->
</footer>
<?php wp_footer(); ?>
</main><!-- classe main -->
</body>

</html>