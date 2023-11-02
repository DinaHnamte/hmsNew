$(function () {
  //get the click of modal button to create / update item
  //we get the button by class not by ID because you can only have one id on a page and you can
  //have multiple classes therefore you can have multiple open modal buttons on a page all with or without
  //the same link.
  //we use on so the dom element can be called again if they are nested, otherwise when we load the content once it kills the dom element and wont let you load anther modal on click without a page refresh
  $(document).on("click", ".showModalButton", function (e) {
    e.preventDefault();
    //check if the modal is open. if it's open just reload content not whole modal
    //also this allows you to nest buttons inside of modals to reload the content it is in
    //the if else are intentionally separated instead of put into a function to get the
    //button since it is using a class not an #id so there are many of them and we need
    //to ensure we get the right button and content.

    if ($("#modal").hasClass("in")) {
      $("#modal").find("#modalContent").load($(this).attr("value"));
      //dynamiclly set the header for the modal
      //$('.modal-title').html =  $(this).attr('title') ;
      document.getElementById("modalHeader").innerHTML =
        $(this).attr("title") +
        '<button aria-hidden="true" data-bs-dismiss="modal" class="close" type="button">×</button>';
    } else {
      //if modal isn't open; open it and load content
      $("#modal")
        .modal("show")
        .find("#modalContent")
        .load($(this).attr("value"));
      //dynamiclly set the header for the modal
      document.getElementById("modalHeader").innerHTML =
        $(this).attr("title") +
        '<button aria-hidden="true" data-bs-dismiss="modal" class="close" type="button">×</button>';
    }
  });
});

$(function () {
  $(document).on("click", ".submitAjax", function (e) {
    e.preventDefault();

    //alert(target);
    $form = $(this).closest("form");
    $formData = $form.serialize();
    $.ajax({
      url: $form.attr("action"),
      type: $form.attr("method"),
      data: $formData,
      success: function (data) {
        var obj = JSON.parse(data);
        if (obj.success) {
          if ($("#datatable")) {
            $.pjax({ container: "#datatable" });
          }
          alert(obj.message);
          $("#modal").modal("hide");
        } else {
          alert(obj.message);
        }
        return false;
      },
      error: function () {
        alert("Something went wrong");
        return false;
      },
    });
    return false;
  });
});

$(function () {
  $(document).ready(function () {
    $(".ajax-click").on("click", function (e) {
      e.preventDefault();
      alert("#" + $(this).attr("pjaxTarget"));
      $.ajax({
        url: $(this).attr("href"),
        type: "POST",
        data: jQuery.parseJSON($(this).attr("pdata")),
        //contentType: "application/json; charset=utf-8",
        //dataType: "json",
        success: function (data) {
          console.log(data);
          //if($(this).attr("pjaxTarget")){
          //$(document).trigger("diagnosisAdded");
          //$.pjax({ container: $(this).attr("pjaxTarget") });
          $("#" + $(this).attr("pjaxTarget")).html(data);
          //}
        },
        error: function (err) {
          //console.log("error")
          //console.log(err.message)
          //alert(err);
        },
      });
      //return false;
    });
  });
});

$(function () {
  $(document).ajaxComplete(function () {
    $(".ajax-click").on("click", function (e) {
      e.preventDefault();
      console.log($(this).attr("pjaxTarget"));

      $.ajax({
        url: $(this).attr("href"),
        type: "POST",
        data: jQuery.parseJSON($(this).attr("pdata")),
        //contentType: "application/json; charset=utf-8",
        //dataType: "json",
        success: function (data) {
          console.log(data);
          if ($(this).attr("pjaxTarget")) {
            //$(document).trigger("diagnosisAdded");
            $("#" + $(this).attr("pjaxTarget")).html(data);
            //$("#icd10table" ).html(data);
            //$.pjax({ container: $(this).attr("pjaxTarget") });
          }
        },
        error: function (err) {
          //console.log("error")
          //console.log(err.message)
          //alert(err);
        },
      });
      //return false;
    });
  });
});

$(function () {
  $("document").ready(function () {
    $(".postAjax").on("click", function (e) {
      e.preventDefault();
      $target = $(this).attr("pjaxTarget");
      $form = $(this).closest("form");
      $formData = $form.serialize();
      $.ajax({
        url: $form.attr("action"),
        type: $form.attr("method"),
        data: $formData,
        success: function (data) {
          if (data == "ok") {
            $.pjax({ container: "#" + $target });
            $("#modal").modal("hide");
          } else {
            alert(data);
          }
        },
      });
    });
  });
});
