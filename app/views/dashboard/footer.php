</div>

<!-- Bootstrap core JavaScript-->
<script src="<?= BASEURL ?>/js/jquery/jquery.min.js"></script>
<script src="<?= BASEURL ?>/js/bootstrap/bootstrap.bundle.min.js"></script>
<script src="<?= BASEURL ?>/js/sb-admin-2.min.js"></script>

<!-- core plugin -->
<script src="<?= BASEURL ?>/js/jquery-easing/jquery.easing.min.js"></script>

<!-- plugin JavaScript-->
<?php if(isset($data['script'])) : ?>
    <?php foreach($data['script'] as $src) : ?>
        <script src="<?= BASEURL ?>/<?= $src ?>"></script>
    <?php endforeach ?>
<?php endif ?>

<!-- script admin js -->
<script src="<?= BASEURL ?>/js/script-admin.js"></script>

</body>

</html>