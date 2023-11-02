
$(function () {
    
      
    });
  
$(function () {
  // return Html::a('Label', ['get-diagnosis', 'idopd'=>$idopd], 
      // [     
      //     'class' => 'postPjax',
      //    'pjaxTarget'/'targetId' => 'id of target',
      //     'pdata' => [ 'name' => value, 'name'=>value]                        
      // ]);
  $(document).on("click", ".postCheckedPjax", function (e) {
    e.preventDefault();
    var pjaxTarget = $(this).attr("pjaxTarget");
    var keys = $("#" + $(this).attr("gridViewId")).yiiGridView("getSelectedRows");
    //$formData = $("#med");
    
    //$formData = $formData.serialize();  
    //$formData = $formData.append("checked_ids", {keys}); 
    //let d={checked_ids:keys} ;
    //console.log(d);
    //return;
    $.pjax({
      url: $(this).attr("href"),
      type: 'POST',
      data:{checked_ids : keys},
      container: "#" + pjaxTarget      
    });
    return false;
  });
});


  $(function () {
    // return Html::a('Label', ['get-diagnosis', 'idopd'=>$idopd], 
        // [     
        //     'class' => 'postDataAjax',
        //    'pjaxTarget'/'targetId' => 'id of target',
        //     'pdata' => [ 'name' => value, 'name'=>value]                        
        // ]);
    $(document).on("click", ".postDataAjax", function (e) {
      e.preventDefault();
      var pjaxTarget = $(this).attr("pjaxTarget");
      var targetId = $(this).attr("targetId");
      $.ajax({
        url: $(this).attr("href"),
        type: 'POST',
        data: jQuery.parseJSON($(this).attr("pdata")),
        success: function (data) {
          if (pjaxTarget!==undefined) {
            $.pjax.reload({ container: "#" + pjaxTarget })
          };
          if (targetId!==undefined) {
            $("#" + targetId).html(data);
          };
          //$("#modal").modal("hide");
        },
        error: function () {
          alert("Something went wrong");
          return false;
        },
      });
      //return false;
    });
  });
  
  $(function () {
    $(document).on("click", ".postFormAjax", function (e) {
    //This function will submit form data to server
    //<?= Html::submitButton('Save', ['class' => 'btn btn-success postFormAjax', 
    //pjaxTarget'/'targetId' => 'id of target']) ?>
      e.preventDefault();  
      //alert(target);
      var pjaxTarget = $(this).attr("pjaxTarget");
      var targetId = $(this).attr("targetId");
      $form = $(this).closest("form");
      $formData = $form.serialize();
      $.ajax({
        url: $form.attr("action"),
        type: $form.attr("method"),
        data: $formData,
        success: function (data) {
            if (pjaxTarget!==undefined) {
                //if pjaxTarget is provided in the attribute list 
                $.pjax.reload({ container: "#" + pjaxTarget })
              };
              if (targetId!==undefined) {
                //if targetId is provided in the attribute list 
                $("#" + targetId).html(data);
              };
              //$("#modal").modal("hide");
        },
        error: function () {
          alert("Something went wrong");
          return false;
        },
      });
      //return false;
    });
  });

  
  $(function () {
    $(document).on("click", ".postCheckedAjax", function (e) {
    //  This function will submit form data to server
    //  <?= Html::submitButton('Save', ['class' => 'btn btn-success postCheckedAjax', 
    //  pjaxTarget'/'targetId' => 'id of target', 
    // 'gridViewId'= "id of gridview that contains checkboxes"]) ?>
      e.preventDefault();  
      //alert(target);
      var pjaxTarget = $(this).attr("pjaxTarget");
      //var targetId = $(this).attr("targetId");
      var keys = $("#" + $(this).attr("gridViewId")).yiiGridView("getSelectedRows");
      //var pdata = jQuery.parseJSON($(this).attr("pdata"));    
      //alert($(this).attr("value"));
      //sspdata.append('chechedids': JSON.stringify(keys)})
      $.ajax({
        url: $(this).attr("href"),
        type: "POST",
        data: {checked_ids: keys},
        success: function (data) {
            if (pjaxTarget!==undefined) {
                //if pjaxTarget is provided in the attribute list 
                $.pjax({ container: "#" + pjaxTarget})
              };
              // if (targetId) {
              //   //if targetId is provided in the attribute list 
              //   $("#" + targetId).html(data);
              // };
              //alert(data);
        },
        error: function () {
          alert("Something went wrong");
          return false;
        },
      });
      return false;
    });
  });
    
    