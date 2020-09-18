$("#menu-toggle").click(function (e) {
  e.preventDefault();
  $("#wrapper").toggleClass("toggled");
});

$(document).ready(function () {
  $(".sec").hide();
  $("#targetdiv1").show();
  $("#selectMe").change(function () {
    $(".sec").hide();
    $("#" + $(this).val()).show();
  });
});
function initImageUpload(box) {
  let uploadField = box.querySelector(".image-upload");

  uploadField.addEventListener("change", getFile);

  function getFile(e) {
    let file = e.currentTarget.files[0];
    checkType(file);
  }

  function previewImage(file) {
    let thumb = box.querySelector(".js--image-preview"),
      reader = new FileReader();

    reader.onload = function () {
      thumb.style.backgroundImage = "url(" + reader.result + ")";
    };
    reader.readAsDataURL(file);
    thumb.className += " js--no-default";
  }

  function checkType(file) {
    let imageType = /image.*/;
    if (!file.type.match(imageType)) {
      throw "Datei ist kein Bild";
    } else if (!file) {
      throw "Kein Bild gewählt";
    } else {
      previewImage(file);
    }
  }
}

// initialize box-scope
var boxes = document.querySelectorAll(".box");

for (let i = 0; i < boxes.length; i++) {
  let box = boxes[i];
  initDropEffect(box);
  initImageUpload(box);
}

/// drop-effect
function initDropEffect(box) {
  let area,
    drop,
    areaWidth,
    areaHeight,
    maxDistance,
    dropWidth,
    dropHeight,
    x,
    y;

  // get clickable area for drop effect
  area = box.querySelector(".js--image-preview");
  area.addEventListener("click", fireRipple);

  function fireRipple(e) {
    area = e.currentTarget;
    // create drop
    if (!drop) {
      drop = document.createElement("span");
      drop.className = "drop";
      this.appendChild(drop);
    }
    // reset animate class
    drop.className = "drop";

    // calculate dimensions of area (longest side)
    areaWidth = getComputedStyle(this, null).getPropertyValue("width");
    areaHeight = getComputedStyle(this, null).getPropertyValue("height");
    maxDistance = Math.max(parseInt(areaWidth, 10), parseInt(areaHeight, 10));

    // set drop dimensions to fill area
    drop.style.width = maxDistance + "px";
    drop.style.height = maxDistance + "px";

    // calculate dimensions of drop
    dropWidth = getComputedStyle(this, null).getPropertyValue("width");
    dropHeight = getComputedStyle(this, null).getPropertyValue("height");

    // calculate relative coordinates of click
    // logic: click coordinates relative to page - parent's position relative to page - half of self height/width to make it controllable from the center
    x = e.pageX - this.offsetLeft - parseInt(dropWidth, 10) / 2;
    y = e.pageY - this.offsetTop - parseInt(dropHeight, 10) / 2 - 30;

    // position drop and animate
    drop.style.top = y + "px";
    drop.style.left = x + "px";
    drop.className += " animate";
    e.stopPropagation();
  }
}

// Channge this

$("#selectMe").change(function () {
  var finalbody;
  var selected = $("#selectMe").val();
  console.log(selected);

  //  Add if then else like :
  if (selected == "targetdiv1") {
    $("#submit-btn-1").click(function(){
      event.preventDefault()
      finalbody =  JSON.stringify( $("#Category1").serializeArray() );
      console.log(finalbody);
        $.ajax({
          type: "POST",
          url: url,
          dataType : 'json',
          data: finalbody,
          success: function (data) {
            console.log(response);
          },
          error: function (xhr, status) {
            console.log("error", xhr, status);
            alert("Some unknown error occured");
          },
        });
    })
  }  
  if (selected == "targetdiv2") {
    $("#submit-btn-2").click(function(){
      event.preventDefault()
      finalbody =  JSON.stringify( $("#Category2").serializeArray() );
      console.log(finalbody);
        $.ajax({
          type: "POST",
          url: url,
          dataType : 'json',
          data: finalbody,
          success: function (data) {
            console.log(response);
          },
          error: function (xhr, status) {
            console.log("error", xhr, status);
            alert("Some unknown error occured");
          },
        });
    })
  }
  if (selected == "targetdiv3") {
    $("#submit-btn-3").click(function(){
      event.preventDefault()
      finalbody =  JSON.stringify( $("#Category3").serializeArray() );
      console.log(finalbody);
        $.ajax({
          type: "POST",
          url: url,
          dataType : 'json',
          data: finalbody,
          success: function (data) {
            console.log(response);
          },
          error: function (xhr, status) {
            console.log("error", xhr, status);
            alert("Some unknown error occured");
          },
        });
    })
  }
  if (selected == "targetdiv4") {
    $("#submit-btn-4").click(function(){
      event.preventDefault()
      finalbody =  JSON.stringify( $("#Category4").serializeArray() );
      console.log(finalbody);
        $.ajax({
          type: "POST",
          url: url,
          dataType : 'json',
          data: finalbody,
          success: function (data) {
            console.log(response);
          },
          error: function (xhr, status) {
            console.log("error", xhr, status);
            alert("Some unknown error occured");
          },
        });
    })
  }
  if (selected == "targetdiv5") {
    $("#submit-btn-5").click(function(){
      event.preventDefault()
      finalbody =  JSON.stringify( $("#Category5").serializeArray() );
      console.log(finalbody);
        $.ajax({
          type: "POST",
          url: url,
          dataType : 'json',
          data: finalbody,
          success: function (data) {
            console.log(response);
          },
          error: function (xhr, status) {
            console.log("error", xhr, status);
            alert("Some unknown error occured");
          },
        });
    })
  }
  if (selected == "targetdiv6") {
    $("#submit-btn-6").click(function(){
      event.preventDefault()
      finalbody =  JSON.stringify( $("#Category6").serializeArray() );
      console.log(finalbody);
        $.ajax({
          type: "POST",
          url: url,
          dataType : 'json',
          data: finalbody,
          success: function (data) {
            console.log(response);
          },
          error: function (xhr, status) {
            console.log("error", xhr, status);
            alert("Some unknown error occured");
          },
        });
    })
  }
  if (selected == "targetdiv7") {
    $("#submit-btn-7").click(function(){
      event.preventDefault()
      finalbody =  JSON.stringify( $("#Category7").serializeArray() );
      console.log(finalbody);
        $.ajax({
          type: "POST",
          url: url,
          dataType : 'json',
          data: finalbody,
          success: function (data) {
            console.log(response);
          },
          error: function (xhr, status) {
            console.log("error", xhr, status);
            alert("Some unknown error occured");
          },
        });
    })
  }
  if (selected == "targetdiv8") {
    $("#submit-btn-8").click(function(){
      event.preventDefault()
      finalbody =  JSON.stringify( $("#Category8").serializeArray() );
      console.log(finalbody);
        $.ajax({
          type: "POST",
          url: url,
          dataType : 'json',
          data: finalbody,
          success: function (data) {
            console.log(response);
          },
          error: function (xhr, status) {
            console.log("error", xhr, status);
            alert("Some unknown error occured");
          },
        });
    })
  }
  if (selected == "targetdiv9") {
    $("#submit-btn-9").click(function(){
      event.preventDefault()
      finalbody =  JSON.stringify( $("#Category9").serializeArray() );
      console.log(finalbody);
        $.ajax({
          type: "POST",
          url: url,
          dataType : 'json',
          data: finalbody,
          success: function (data) {
            console.log(response);
          },
          error: function (xhr, status) {
            console.log("error", xhr, status);
            alert("Some unknown error occured");
          },
        });
    })

  }
  // and so on

});


