//получаем ссылку сайта
const urlParams = new URLSearchParams(window.location.search);
const nickname = urlParams.get("nickname");
const base_url = document.body.dataset.baseurl;
const productsDiv = document.querySelector('.product-block');
const currentUserId = localStorage.getItem('user_id');

function getProducts(){
    axios.get(`${base_url}/api/products/list.php?nickname=${nickname}`).then(res =>{
        showProducts(res.data);
    })
}

function showProducts(products){
    let productsHTML=``;
    if(products.length == 0) productsDiv.innerHTML = `<h1>0 products</h1>`;
    for(let i = 0; i < products.length; i++){
        let dropdown = ``;
        if(currentUserId == products[i].user_id){
            dropdown += `
            <span class="link">
                <a href="" class = "link-dots">
                    <svg width="4" height="16" viewBox="0 0 4 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M2 4C3.1 4 4 3.1 4 2C4 0.9 3.1 0 2 0C0.9 0 0 0.9 0 2C0 3.1 0.9 4 2 4ZM2 6C0.9 6 0 6.9 0 8C0 9.1 0.9 10 2 10C3.1 10 4 9.1 4 8C4 6.9 3.1 6 2 6ZM2 12C0.9 12 0 12.9 0 14C0 15.1 0.9 16 2 16C3.1 16 4 15.1 4 14C4 12.9 3.1 12 2 12Z" fill="black" fill-opacity="0.54"/>
                    </svg>
                </a>
                
                <ul class="dropdown">
                    <li> <a href="${base_url}/edit-product.php?id=${products[i].id}">edit</a> </li>
                    <li><a href="" onclick = "deleteProduct(${products[i].id})">delete</a></li>
                </ul>
            </span>
            `
        }
        productsHTML += `
            <div class="product-item">
            <a href="${base_url}/product-details.php?id=${products[i].id}">
                <img src="${products[i].image}" alt="">
            </a>
                <div class="product-item-header">
                   <a href="${base_url}/product-details.php?id=${products[i].id}"><h4 class="item-name">${products[i].title}</h4></a>
                    ${dropdown}
                </div>
                <p class="item-category">${products[i].name}</p>
                <span class="item-price">$${products[i].price}</span>
            </div>
        
        `
    }
    if(products.length > 0){
        productsDiv.innerHTML = productsHTML;
    }
}
getProducts();

function deleteProduct(id){
    axios.get(`${base_url}/api/products/delete.php?id=${id}`).then(
        getProducts()
    )
    console.log(1);
}