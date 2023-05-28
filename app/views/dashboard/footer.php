</div>

<!-- Bootstrap core JavaScript-->
<script src="<?= BASEURL ?>/vendor/jquery/jquery.min.js"></script>
<script src="<?= BASEURL ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- core plugin -->
<script src="<?= BASEURL ?>/vendor/jquery-easing/easing.js"></script>

<!-- javascript sb admin -->
<script src="<?= BASEURL ?>/js/sb-admin-2.min.js"></script>

<!-- my javascript -->
<script src="<?= BASEURL ?>/js/dashboard.js"></script>


<!-- plugin JavaScript-->
<?php if(isset($data['script'])) : ?>
    <?php foreach($data['script'] as $src) : ?>
        <script src="<?= BASEURL ?>/<?= $src ?>"></script>
    <?php endforeach ?>
<?php endif ?>

</body>

</html>