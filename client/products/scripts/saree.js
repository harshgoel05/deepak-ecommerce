let selectedColor;
const form = document.querySelector('#color-form');

async function retriveData(product_id) {
  const response = await fetch(
    "https://shreedeepaksarees.com/server/api/products/sarees/retrieve.php?productid=" +
    product_id
  );
  const json = await response.json();
  if (!json.success) {
    alert("Some unkown error has occured!");
  } else {
    const data = json.data;
    console.log(data.colors);
    let colors = stringSeperator(data.colors);
    console.log(colors);
    selectedColor = colors[0];
    console.log(selectedColor);
    colors.map((color)=>{
      const hex = colorPaletteReturn(color);
      console.log(form);
      const colorLine = document.createElement('label');
      colorLine.innerHTML = ` <input id="color" type="radio" name="color" value="${color}" onclick="setColor(value)"/> <div class="button"><span style="background-color: ${hex}"></span></div> `;
      console.log(colorLine);
      form.appendChild(colorLine);
    })
    //console.log($("#i1")[0].src);
    $("#i1")[0].src = data.image1;
    $("#i2")[0].src = data.image2;
    $("#i3")[0].src = data.image3;
    $("#i4")[0].src = data.image4;
    $("#i5")[0].src = data.image5;
    $("#i6")[0].src = data.image6;

    $("#title").html(data.title);
    $("#sub-title").html(data.subtitle);
    $("#price").html(`Rs. ${data.price}`);
    $("#des").html(data.description);
    $("#sub-cat").html(data.subcategory);
    // const occ = `${data.occasion1}, ${data.occasion2}, ${data.occasion3}, ${data.occasion4}, ${data.occasion5}, ${data.occasion6}, ${data.occasion7}, `;
    const occ = `${data.occasion1}`;

    $("#occasaion").html(occ);
    // const washcare = `${data.washcare1}, ${data.washcare2}, ${data.washcare3}`;
    const washcare = `${data.washcare1}`;

    $("#wash-care").html(washcare);
    $("#type").html(data.type);
    $("#blousefabric").html(data.blousefabric);
    $("#blouse").html(data.blouse);
    $("#fabric").html(data.fabric);
    $("#length").html(data.length);
    $("#width").html(data.width);
    $('#blouse_fabric').html(data.blouse);
    $('#saree_fabric').html(data.sareefabric);

    // size,colors left
    //image left
  }
}
const product_id = window.location.href.split("?product_id=")[1];
if (!product_id) {
  alert("Missing product id");
}
retriveData(product_id);


async function addToCart() {
  console.log('Cart function fired');
  let id = product_id;
  console.log(id);
  const response = await fetch(
    "https://shreedeepaksarees.com/server/api/products/sarees/retrieve.php?productid=" +
    id
  );
  const json = await response.json();
  const data = json.data;
  console.log(data.size1);
  //console.log(id);
  var raw =

  {
    "product_category": "sarees",
    "productid": String(id),
    "selected_quantity": "1",
    "selected_size": String(data.size1),
    "selected_colors": String(selectedColor),
  }
  console.log(raw);
  raw = JSON.stringify(raw);

  var requestOptions = {
    method: 'POST',
    body: raw,
    redirect: 'follow'
  };
  
  fetch("https://shreedeepaksarees.com/server/api/user/cart/add.php", requestOptions)
    .then(response => response.json())
    .then(result => {
      if(result.success == true){
        alert('Added To Cart!');
        window.location = "https://shreedeepaksarees.com/client/user/cart.html";
      }
      else
        alert('Please login to perform this action');
      console.log(result);
    })
    .catch(error => console.log('error', error));

}

async function addToWishList() {
  console.log('Wishlist function fired');
  let id = product_id;
  console.log(id);
  const response = await fetch(
    "https://shreedeepaksarees.com/server/api/products/sarees/retrieve.php?productid=" +
    id
  );
  const json = await response.json();
  const data = json.data;
  console.log(json.data);
  console.log(data.size1);
  let selSize = "S";
  var raw =

  {
    "product_category": "sarees",
    "productid": String(id),
    "selected_quantity": "1",
    "selected_size": String(data.size1),
    "selected_colors": String(selectedColor),
  }
  console.log(raw);
  raw = JSON.stringify(raw);

  var requestOptions = {
    method: 'POST',
    body: raw,
    redirect: 'follow'
  };
  
  fetch("https://shreedeepaksarees.com/server/api/user/wishlist/add.php", requestOptions)
    .then(response => response.json())
    .then(result => {
      if(result.success == true){
        alert('Added To Wishlist!');
        window.location = "https://shreedeepaksarees.com/client/user/wishlist.html";
      }
      else
        alert('Please login to perform this action');
      console.log(result);
    })
    .catch(error => console.log('error', error));
}

function colorPaletteReturn(colorString) {
  let colorHex;
  switch (colorString) {
      case "maroon": colorHex = "#800000";
          break;
      case "red": colorHex = "#FF0000";
          break;
      case "bottle green": colorHex = "#1c3b29";
          break;
      case "pista green": colorHex = "#93c572";
          break;
      case "brown": colorHex = "#A52A2A";
          break;
      case "white": colorHex = "#FFFFFF";
          break;
      case "off white": colorHex = "#f5f2d0";
          break;
      case "black": colorHex = "#000000";
          break;
      case "rani": colorHex = "#ff69b4";
          break;
      case "parrot green": colorHex = "#8FB34C";
          break;
      case "beiege": colorHex = "#F5F5DC";
          break;
      case "orange": colorHex = "#FFA500";
          break;
      case "rama green": colorHex = "#136207"
          break;
      case "mustard": colorHex = "#ffdb58";
          break;
      case "purple": colorHex = "#800080";
          break;
      case "violet": colorHex = "#EE82EE";
          break;
      case "navy blue": colorHex = "#000080";
          break;
      case "rust": colorHex = "#b7410e";
          break;
      case "steel grey": colorHex = "#7b9095";
          break;
      case "skin": colorHex = "#c58c85";
          break;
      case "lavender": colorHex = "#E6E6FA";
          break;
      case "blue": colorHex = "#0000FF";
          break;
      case "peacock green": colorHex = "#17684f";
          break;
      case "mehandi": colorHex = "#af7f29";
          break;
      case "onion": colorHex = "#5b8930";
          break;
      case "yellow": colorHex = "#FFFF00";
          break;
      case "dark grey": colorHex = "#A9A9A9";
          break;
      case "peach": colorHex = "#FFDAB9";
          break;
      case "tango": colorHex = "#D87534";
          break;
      case "gold": colorHex = "#FFD700";
          break;
      default: colorHex = "#FFFFFF";
          break;
  }
  return colorHex;
}

function stringSeperator(string){
  string = string.toLowerCase();
  let colors = string.split(",");
  return colors;
}

const setColor = (color) =>{
  selectedColor = color;
  console.log(selectedColor);
}