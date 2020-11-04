async function encodeImageFileAsURL(id, element) {
  //const image = document.querySelector('#i1');
  let file = element.files[0];
  let reader = new FileReader();
  //console.log(id);
  reader.onloadend = function () {
    //document.write( reader.result);
    id.src = reader.result;
    console.log("reading file");
    //console.log(reader.result);
    //console.log(image.src);
    console.log(id.src);

    //$("#i1").val(reader.result)
  };
  await reader.readAsDataURL(file);
  //await console.log(image.src);
}

$("#submit-btn1").click(function () {
  console.log("Call add product API");

  let id = $("#id1").val();
  let title = $("#title1").val();
  let sub_title = $("#sub_title1").val();
  let price = parseInt($("#price1").val());
  let quant = parseInt($("#quant1").val());
  // let sub_cat = $("#sub-cat1").val();
  let description = $("#des1").val();
  let type = $("#type1").val();
  let fab = $("#faab1").val();
  let i1 = $("#i1")[0].src;
  let i2 = $("#i2")[0].src;
  let i3 = $("#i3")[0].src;
  let i4 = $("#i4")[0].src;
  let i5 = $("#i5")[0].src;
  let i6 = $("#i6")[0].src;

  //console.log(typeof price);
  //alert(typeof price);

  var sizes = [];
  $("#size-container1 input:checked").each(function () {
    sizes.push(this.value);
  });

  var occasions = [];
  $("#occasion-cont1 input:checked").each(function () {
    occasions.push(this.value);
  });
  console.log("occ", occasions);

  var washcares = [];
  $("#washcare-cont1 input:checked").each(function () {
    washcares.push(this.value);
  });

  var colors = [];
  $("#colors_input input:checked").each(function () {
    colors.push(this.value);
  });

  var colorString = colors.toString();

  var finalbody = {
    productid: id,
    title: title,
    subtitle: sub_title,
    price: price,
    quantity: quant,
    colors : colorString,
    image1: i1,
    image2: i2,
    image3: i3,
    image4: i4,
    image5: i5,
    image6: i6,
    description: description,
    type: type,
    fabric: fab,
    // washcare1
    // washcare2
    // washcare3
  };

  //append occasions to body
  occasions.forEach((occ, index) => {
    finalbody[`occasion${index + 1}`] = occ;
  });
  //append size to body
  sizes.forEach((size, index) => {
    finalbody[`size${index + 1}`] = size;
  });
  //append washcares to body
  washcares.forEach((washcare, index) => {
    finalbody[`washcare${index + 1}`] = washcare;
  });
  console.log(finalbody);
  //alert(typeof finalbody.price);

  $.ajax({
    url: "https://shreedeepaksarees.com/server/api/products/ghagra/add.php",
    type: "POST",
    data: JSON.stringify(finalbody),
    success: function (response) {
      alert("Added product successfully!");
    },
    error: function (xhr, status) {
      console.log("error", xhr, status);
      alert("Something went wrong");
    },
  });
});
