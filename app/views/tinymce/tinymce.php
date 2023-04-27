<script src="<?= BASEURL ?>/js/tinymce/tinymce.min.js"></script>

<script>
  tinymce.init({
    selector: 'textarea#default',
    width: 1000,
    height: 350,
    plugins: [
      'advlist', 
      'autolink', 
      'link', 
      'image',
      'lists', 
      'charmap', 
      'preview', 
      'anchor', 
      'pagebreak', 
      'searchreplace', 
      'wordcount', 
      'visualblocks', 
      'code', 
      'fullscreen', 
      'media'
    ],
    toolbar: 'undo redo | styles | bold italic underline | alignleft aligncenter alignright',
    menu: {
      favs: {
        title: 'menu',
        items: 'code visualaid | searchreplace | emoticons'
      }
    },
    menubar: 'favs file edit view insert format tools table',
    content_style: 'body{font-family:sans-serif; font-size:16px}'
  })
</script>