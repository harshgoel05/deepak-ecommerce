function appendData(productElement) {

    const card = document.createElement('div');
    const body = document.createElement('div');
    
    const heading = document.createElement('h1');
    const subtitle = document.createElement('h2');
    const img = document.createElement('img');
    const price = document.createElement('h3');
    const qty = document.createElement('h3');

    const productBody = document.querySelector('.product_body');
    heading.innerHTML = productElement.title;
    subtitle.innerHTML = productElement.subtitle;
    img.innerHTML = productElement.image1;
    price.innerHTML = productElement.price;
    qty.innerHTML = productElement.quantity;

    card.appendChild(img);
    body.appendChild(heading);
    body.appendChild(subtitle);
    body.appendChild(price);
    body.appendChild(qty);
    
    card.appendChild(body);

    card.classList.add("card");
    img.classList.add("card-img-top");
    body.classList.add("card-body");
    heading.classList.add("card-title");
    subtitle.classList.add("card-text");

    productBody.appendChild(card);
}

$(document).ready(async function () {
    const response = await fetch('https://testing1.thestrategybook.com/deepak-ecommerce/server/api/products/sarees/retrieve.php?');
    const json = await response.json();
    const array = json.data;
    array.map((x)=>{
        appendData(x);
    })

    console.log(array);
});