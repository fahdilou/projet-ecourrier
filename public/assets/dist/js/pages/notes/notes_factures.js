
  $(function() {
    var $btns = $(".note-link").click(function() {
      var targetId = this.id;
      var $el = $("." + targetId).fadeIn();
      $("#note-full-container > div").not($el).hide();

      
      $("#facture_enregitrement").DataTable().draw();
      $("#facture_encour").DataTable().draw();
      $("#facture_traite").DataTable().draw();

      $btns.removeClass("active");
      $(this).addClass("active");
    });
  });

