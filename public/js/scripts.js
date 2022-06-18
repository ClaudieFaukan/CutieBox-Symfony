/*!
    * Start Bootstrap - Freelancer v6.0.5 (https://startbootstrap.com/theme/freelancer)
    * Copyright 2013-2020 Start Bootstrap
    * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-freelancer/blob/master/LICENSE)
    */
(function ($) {
  "use strict"; // Start of use strict

  // Smooth scrolling using jQuery easing
  $('a.js-scroll-trigger[href*="#"]:not([href="#"])').click(function () {
    if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
      if (target.length) {
        $('html, body').animate({
          scrollTop: (target.offset().top - 71)
        }, 1000, "easeInOutExpo");
        return false;
      }
    }
  });

  // Scroll to top button appear
  $(document).scroll(function () {
    var scrollDistance = $(this).scrollTop();
    if (scrollDistance > 100) {
      $('.scroll-to-top').fadeIn();
    } else {
      $('.scroll-to-top').fadeOut();
    }
  });

  // Closes responsive menu when a scroll trigger link is clicked
  $('.js-scroll-trigger').click(function () {
    $('.navbar-collapse').collapse('hide');
  });

  // Activate scrollspy to add active class to navbar items on scroll
  $('body').scrollspy({
    target: '#mainNav',
    offset: 80
  });

  // Collapse Navbar
  var navbarCollapse = function () {
    if ($("#mainNav").offset().top > 100) {
      $("#mainNav").addClass("navbar-shrink");
    } else {
      $("#mainNav").removeClass("navbar-shrink");
    }
  };
  // Collapse now if page is not at top
  navbarCollapse();
  // Collapse the navbar when page is scrolled
  $(window).scroll(navbarCollapse);

  // Floating label headings for the contact form
  $(function () {
    $("body").on("input propertychange", ".floating-label-form-group", function (e) {
      $(this).toggleClass("floating-label-form-group-with-value", !!$(e.target).val());
    }).on("focus", ".floating-label-form-group", function () {
      $(this).addClass("floating-label-form-group-with-focus");
    }).on("blur", ".floating-label-form-group", function () {
      $(this).removeClass("floating-label-form-group-with-focus");
    });
  });

})(jQuery); // End of use strict

//**************PARTIE IMAGE****************//


//Bouton Valider et continuer transformer en input type file

$('#choiceImage').click(function () {
  $('#myFile').click();
});


// Preview image

function previewFile(input) {
  var file = $("input[type=file]").get(0).files[0];

  if (file) {
    var reader = new FileReader();

    reader.onload = function () {
      $("#previewImg").attr("src", reader.result);
    }
    reader.readAsDataURL(file);
  }
}



//Fonction de rotation de l'image

$('#left-rotate').click(function () {

  let value = parseFloat(document.getElementById("left-rotate").value);
  let angle = value - 90;

  document.getElementById("left-rotate").value = angle;


  $('#previewImg').css({ 'transform': `rotate(${angle}deg)` });
  $('#previewImg').css({ 'max-width': `100%` });
});

$('#right-rotate').click(function () {

  let value = parseFloat(document.getElementById("right-rotate").value);
  let angle = value + 90;

  document.getElementById("right-rotate").value = angle;


  $('#previewImg').css({ 'transform': `rotate(${angle}deg)` });
  $('#previewImg').css({ 'max-width': `100%` });
});



// Partie de hidden and show step

//step 1 
$("#choiceImage").click(function () {
  $("#step-2").show("slow");
  $("#step-1").hide();
  $("#step-3").hide();
  $("#step-4").hide();
  $("#step-5").hide();
  $("#step-6").hide();
  $("#step-7").hide();

  //titre
  $(".step-2").show("slow");
  $(".step-1").hide();

  //bouton back
  $("#back-step-1").show("slow");

  //image
  $("#previewImg").show("slow");


});
//step-1 Mobile
$("#choiceImage").on("tap", function () {
  $("#step-2").show("slow");
  $("#step-1").hide();
  $("#step-3").hide();
  $("#step-4").hide();
  $("#step-5").hide();
  $("#step-6").hide();
  $("#step-7").hide();

  //titre
  $(".step-2").show("slow");
  $(".step-1").hide();

  //bouton back
  $("#back-step-1").show("slow");

  //image
  $("#previewImg").show("slow");


});
//step 2
$("#valid-step-2").click(function () {
  $("#step-1").hide();
  $("#previewImg").hide();
  $("#step-3").show("slow");
  $("#step-2").hide();

  //titre
  $(".step-2").hide();
  $(".step-3").show("slow");

});
//step 3
$("#valid-step-3").click(function () {
  $("#step-4").show("slow");
  $("#step-3").hide();

  //titre
  $(".step-3").hide();
  $(".step-4").show("slow");

});
//step 4 
$("#valid-step-4").click(function () {
  $("#step-5").show("slow");
  $("#step-4").hide();

  //titre
  $(".step-4",).hide();
  $(".step-5",).show("slow");

});
//step 5
$("#valid-step-5").click(function () {
  $("#step-6").show("slow");
  $("#step-5").hide();

  //titre
  $(".step-5",).hide();
  $(".step-6",).show("slow");

  //recuperation adress mail

  const mail = document.getElementById("mail").value;
  alert(mail);
  $.post("../DATA/dataEmail.php", {
    mail: mail
  });



});
//step 6
$("#valid-step-6").click(function () {
  $("#step-7").show("slow");

  //titre
  $(".step-6",).hide();
});

//back step 1 clear input file 
$("#back-step-1").click(function () {

  document.getElementById('myFile').value = ''

});

// selection des template

$("#portrait").click(function () {

  //change les cote du square

});

$("#paysage").click(function () {

  //change les cote du square
});


var resize = $('#upload-demo').croppie({
  enableExif: true,
  enableOrientation: true,
  viewport: { // Default { width: 100, height: 100, type: 'square' } 
    width: 300,
    height: 400,
    type: 'square' //square
  },
  boundary: {
    width: 400,
    height: 400
  }
});
$('#image').on('change', function () {
  var reader = new FileReader();
  reader.onload = function (e) {
    resize.croppie('bind', {
      url: e.target.result
    }).then(function () {
      console.log('jQuery bind complete');
    });
  }
  reader.readAsDataURL(this.files[0]);
});
$('.btn-upload-image').on('click', function (ev) {
  resize.croppie('result', {
    type: 'canvas',
    size: 'viewport'
  }).then(function (img) {
    $.ajax({
      url: "croppie.php",
      type: "POST",
      data: { "image": img },
      success: function (data) {
        html = '<img src="' + img + '" />';
        $("#preview-crop-image").html(html);
      }
    });
  });
});




