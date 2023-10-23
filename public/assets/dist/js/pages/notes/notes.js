
  $(function() {
    var $btns = $(".note-link").click(function() {
      var targetId = this.id;
      var $el = $("." + targetId).fadeIn();
      $("#note-full-container > div").not($el).hide();

      
      $("#courrier_enregitrement").DataTable().draw();
      $("#courrier_encour").DataTable().draw();
      $("#courrier_traite").DataTable().draw();

      $btns.removeClass("active");
      $(this).addClass("active");
    });
  });

