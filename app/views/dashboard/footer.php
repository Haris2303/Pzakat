</div>

<!-- Bootstrap core JavaScript-->
<script src="<?= BASEURL ?>/js/jquery/jquery-3.6.4.js"></script>
<script src="<?= BASEURL ?>/js/bootstrap/bootstrap.js"></script>

<!-- core plugin -->
<script src="<?= BASEURL ?>/js/jquery-easing/easing.js"></script>

<script src="<?= BASEURL ?>/js/sidebar.js"></script>


<!-- plugin JavaScript-->
<?php if(isset($data['script'])) : ?>
    <?php foreach($data['script'] as $src) : ?>
        <script src="<?= BASEURL ?>/<?= $src ?>"></script>
    <?php endforeach ?>
<?php endif ?>

<!-- script admin js -->
<!-- <script src="<?= BASEURL ?>/js/script-admin.js"></script> -->

</body>

</html>