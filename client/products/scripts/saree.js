const heading = document.createElement('h1');
const subtitle = document.createElement('h2');
const img = document.createElement('img');
const price = document.createElement('h3');
const qty = document.createElement('h3');

function appendData(productElement){

    const card = document.createElement('div');

    heading.innerHTML = productElement.title;
    subtitle.innerHTML = productElement.subtitle;
    img.innerHTML = productElement.image1;
    price.innerHTML = productElement.price;
    qty.innerHTML = productElement.quantity;
    
    card.appendChild(heading);
    card.appendChild(subtitle);
    card.appendChild(img);
    card.appendChild(price);
    card.appendChild(qty);

    productBody.appendChild(card);
}

for(i=0;i<array.length;i++){
    appendData(array[i]);
}

$(document).ready(async function(){
    const response = await fetch('https://testing1.thestrategybook.com/deepak-ecommerce/server/api/products/sarees/retrieve.php?');
    const productBody = document.querySelector('.product_body');
    const array = object.data;
    const object = JSON.parse(response);

    for(i=0;i<array.length;i++){
        appendData(array[i]);
    }

});