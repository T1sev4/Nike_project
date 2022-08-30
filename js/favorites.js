//получаем ссылку сайта
const favoritesDiv = document.querySelector('.product-fav');

function getFavorites(){
    axios.get(`${base_url}/api/favorites/list.php?user_id=${currentUserId}`).then(res =>{
        showFavorites(res.data);
    })
}

function showFavorites(favorites){
    console.log(favorites);
    let favoritesHTML=``;
    if(favorites.length == 0) favoritesDiv.innerHTML = `<h1>0 favorites</h1>`;
    for(let i = 0; i < favorites.length; i++){
        let dropdown = ``;
        if(currentUserId == favorites[i].user_id){
            dropdown += `
            <span class="link">
                <a href="" class = "link-dots">
                    <svg width="4" height="16" viewBox="0 0 4 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M2 4C3.1 4 4 3.1 4 2C4 0.9 3.1 0 2 0C0.9 0 0 0.9 0 2C0 3.1 0.9 4 2 4ZM2 6C0.9 6 0 6.9 0 8C0 9.1 0.9 10 2 10C3.1 10 4 9.1 4 8C4 6.9 3.1 6 2 6ZM2 12C0.9 12 0 12.9 0 14C0 15.1 0.9 16 2 16C3.1 16 4 15.1 4 14C4 12.9 3.1 12 2 12Z" fill="black" fill-opacity="0.54"/>
                    </svg>
                </a>
                
                <ul class="dropdown">
                    <li><a href="" onclick = "deleteFavorite(${favorites[i].id})">delete</a></li>
                </ul>
            </span>
            `
        }
        favoritesHTML += `
        <div class="product-item">
        <a href="${base_url}/product-details.php?id=${favorites[i].product_id}">
            <img src="${favorites[i].image}" alt="">
        </a>
            <div class="product-item-header">
            <a href="${base_url}/product-details.php?id=${favorites[i].product_id}">
                <h4 class="item-name">${favorites[i].title}</h4>
            </a>
                ${dropdown}
            </div>
            <p class="item-category">${favorites[i].name}</p>
            <span class="item-price">$${favorites[i].price}</span>
        </div>
        
        `
    }
    if(favorites.length > 0){
        favoritesDiv.innerHTML = favoritesHTML;
    }
}
getFavorites();

function deleteFavorite(id){
    axios.get(`${base_url}/api/favorites/delete.php?id=${id}`).then(
        getFavorites()
    )
}