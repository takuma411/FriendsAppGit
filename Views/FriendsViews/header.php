
    <header>

    <button class="history_icon" onclick="history.back()">
<i class="fas fa-arrow-left"></i>
</button>
    <div id="navArea">

        <nav>
            <div class="inner">
            <ul>
                <li><a href="my_profile.php">プロフィール</a></li>
                <li><a href="change_pass.php">パスワード変更</a></li>
            </ul>
            </div>
        </nav>

        <div class="toggle_btn">
            <span></span>
            <span></span>
            <span></span>
        </div>

    <div id="mask"></div>

    </div>

    <div class="friends-icon">
       <button onclick="location.href='friends_top.php'" class="btn btn-success">Friends</button> 
    </div>
    <div class="friends-icon">
    <button onclick="location.href='logout.php'" class="btn btn-danger">Logout</button> 
    </div>
</header>
<!--       
    </section>
  </div> -->
  <script>
      (function($) {
  var $nav   = $('#navArea');
  var $btn   = $('.toggle_btn');
  var $mask  = $('#mask');
  var open   = 'open'; // class
  // menu open close
  $btn.on( 'click', function() {
    if ( ! $nav.hasClass( open ) ) {
      $nav.addClass( open );
    } else {
      $nav.removeClass( open );
    }
  });
  // mask close
  $mask.on('click', function() {
    $nav.removeClass( open );
  });
} )(jQuery);
  </script>
<!--     
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
  </body>
</html> -->