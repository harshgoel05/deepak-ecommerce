console.log("loaded script");

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

$("#add-product").click(function () {
  console.log("hi");

  console.log("Call add product API");
  let id = $("#product_id").val();
  let title = $("#title").val();
  let sub_title = $("#sub_title").val();
  let price = parseInt($("#price").val());
  let quant = parseInt($("#quant").val());
  let kurtafabric = $("#kurta_fabric").val();
  let bottomfabric = $("#bottom_fabric").val();
  let dupattafabric = $("#dupatta_fabric").val();
  let kfl = $("#kfl").val();
  let bfl = $("#bfl").val();
  let dl = $("#dl").val();
  let type = $("#type").val();
  let stitch = $("#stitch").val();
  let i1 = $("#i1")[0].src;
  let i2 = $("#i2")[0].src;
  let i3 = $("#i3")[0].src;
  let i4 = $("#i4")[0].src;
  let i5 = $("#i5")[0].src;
  let i6 = $("#i6")[0].src;

  //let i1 = image_1;
  //console.log(image_1[0].src);

  // For sizes
  var sizes = [];
  $("#size-container input:checked").each(function () {
    sizes.push(this.value);
  });
  // For occasions
  var occasions = [];
  $("#occasion-cont input:checked").each(function () {
    occasions.push(this.value);
  });
  console.log("occ", occasions);
  var washcares = [];
  $("#washcare-cont input:checked").each(function () {
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
    colors: colorString,
    image1: i1,
    image2: i2,
    image3: i3,
    image4: i4,
    image5: i5,
    image6: i6,
    kurtafabric: kurtafabric,
    bottomfabric: bottomfabric,
    dupattafabric: dupattafabric,
    kfl: kfl,
    bfl: bfl,
    dl: dl,
    type: type,
    stitch: stitch,
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
    url:
      "https://shreedeepaksarees.com/server/api/products/dressMaterials/add.php",
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
