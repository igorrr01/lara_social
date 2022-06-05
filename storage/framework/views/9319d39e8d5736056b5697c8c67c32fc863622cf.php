  <?php if(auth()->guard()->check()): ?>


  </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
     
    </div>
    <strong>Copyright &copy; 2022 <a href="/user/1">Admin</a>.</strong> All rights reserved.
  </footer>


  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
    <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="<?php echo e(asset('public/assets/js/js.js')); ?>"></script>
<script src="/public/assets/js/config.js"></script>
<script src="/public/assets/js/util.js"></script>
<script src="/public/assets/js/jquery.emojiarea.js"></script>
<script src="/public/assets/js/emoji-picker.js"></script>

 <script>

function  unicodeToImage (input) {
      if (!input) {
        return '';
      }
      if (!Config.rx_colons) {
        Config.init_unified();
      }
      return input.replace(Config.rx_codes, function(m) {
        var $img;
        if (m) {
          $img = $.emojiarea.createIcon($.emojiarea.icons[":"+Config.reversemap[m]+":"]);
          return $img;
        } else {
          return '';
        }
      });
    };

  
      $(function() {
        // Initializes and creates emoji set from sprite sheet
        window.emojiPicker = new EmojiPicker({
          emojiable_selector: '[data-emojiable=true]',
          assetsPath: '/public/assets/img/',
          popupButtonClasses: 'fa fa-smile-o'
        });
        // Finds all elements with `emojiable_selector` and converts them to rich emoji input fields
        // You may want to delay this step if you have dynamically created input fields that appear later in the loading process
        // It can be called as many times as necessary; previously converted input fields will not be converted again
        window.emojiPicker.discover();
      });

    </script>
    <script>
      // Google Analytics
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-49610253-3', 'auto');
      ga('send', 'pageview');
    </script>

</body>
</html>
<?php endif; ?><?php /**PATH E:\OpenServer2\domains\laravel7.project\resources\views/layouts/footer.blade.php ENDPATH**/ ?>