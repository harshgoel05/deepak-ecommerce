const image = document.querySelector("#i1");
console.log(image);

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

$("#submit-btn8").click(function () {
  console.log("Call add product API");

  let id = $("#id8").val();
  let title = $("#title8").val();
  let sub_title = $("#sub_title8").val();
  let price = parseInt($("#price8").val());
  let quant = parseInt($("#quant8").val());
  let sub_category = $("#sub-cat8").val();
  let description = $("#des").val();
  let kfl = $("#kfl8").val();
  let bfl = $("#bfl8").val();
  let dl = $("#dl8").val();
  let type = $("#type8").val();
  let fabric = $("#faab8").val();
  let kl = $("#kl8").val();
  let sl = $("#sl8").val();
  let ss = $("#ss8").val();
  let neck = $("#neck8").val();
  let ornamentation = $("#orna8").val();
  let fabric2 = $("#fab82").val();
  let i1 = $("#i1")[0].src;
  let i2 = $("#i2")[0].src;
  let i3 = $("#i3")[0].src;
  let i4 = $("#i4")[0].src;
  let i5 = $("#i5")[0].src;
  let i6 = $("#i6")[0].src;

  // For sizes
  var sizes = [];
  $("#size-container8 input:checked").each(function () {
    sizes.push(this.value);
  });
  // For occasions
  var occasions = [];
  $("#occasion-cont8 input:checked").each(function () {
    occasions.push(this.value);
  });
  console.log("occ", occasions);
  var washcares = [];
  $("#washcare-cont8 input:checked").each(function () {
    washcares.push(this.value);
  });

  var colors = [];
  $("#colors_input input:checked").each(function () {
    colors.push(this.value);
  });

  var colorString = colors.toString();

  var finalbody = {
    productid: id,
    subcategory: sub_category,
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
    kfl: kfl,
    bfl: bfl,
    dl: dl,
    type: type,
    fabric: fabric,
    kl: kl,
    sl: sl,
    ss: ss,
    neck: neck,
    ornamentation: ornamentation,
    fabric2: fabric2,
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
  // Ajax api call
  $.ajax({
    url: "https://shreedeepaksarees.com/server/api/products/kurtis/add.php",
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
