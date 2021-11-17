function myFunction() {
    var x = document.getElementById("myInput");
    if (x.type === "password") {
      x.type = "text";
    } else {
      x.type = "password";
    }
  }

  const pswrdField = document.querySelector(".form input[type='password']"),
  toggleIcon = document.querySelector(".form .field i");
  
  toggleIcon.onclick = () =>{
    if(pswrdField.type === "password"){
      pswrdField.type = "text";
      toggleIcon.classList.add("active");
    }else{
      pswrdField.type = "password";
      toggleIcon.classList.remove("active");
    }
  }
 
  
/*ハンバーガー*/

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