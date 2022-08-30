//получаем ссылку сайта
const urlParams = new URLSearchParams(window.location.search);
const product_id = urlParams.get("id");
const base_url = document.body.dataset.baseurl;
const commentsDiv = document.querySelector('.comments');
const currentUserId = localStorage.getItem('user_id');
const textarea = document.querySelector('.comment-textarea');
const addCommentBtn = document.querySelector('.add-button');
let btn = document.querySelector('.text-button');

const addFavoriteBtn = document.querySelector('.addFav-button');

function getComments(){
    axios.get(`${base_url}/api/comments/list.php?id=${product_id}`).then(res =>{
        showComments(res.data);
        console.log(res.data);
    })
}

function showComments(comments){
    let commentsHTML=``;
    comments.length == 0 ? commentsDiv.innerHTML = `<h2 class="com-number">0 comments</h2>`: commentsHTML = `<h2 class="com-number">${comments.length} comments</h2>`
    for(let i = 0; i < comments.length; i++){
        let dropdown = ``;
        if(currentUserId == comments[i].user_id){
            dropdown += `
            <span class="link">
                <a href="" class = "link-dots">
                    <svg width="4" height="16" viewBox="0 0 4 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M2 4C3.1 4 4 3.1 4 2C4 0.9 3.1 0 2 0C0.9 0 0 0.9 0 2C0 3.1 0.9 4 2 4ZM2 6C0.9 6 0 6.9 0 8C0 9.1 0.9 10 2 10C3.1 10 4 9.1 4 8C4 6.9 3.1 6 2 6ZM2 12C0.9 12 0 12.9 0 14C0 15.1 0.9 16 2 16C3.1 16 4 15.1 4 14C4 12.9 3.1 12 2 12Z" fill="black" fill-opacity="0.54"/>
                    </svg>
                </a>
                
                <ul class="dropdown">
                    <li> <a href="" onclick = "editComment(${comments[i].id}, event)">edit</a> </li>
                    <li><a href="" onclick = "deleteComment(${comments[i].id})">delete</a></li>
                </ul>
            </span>
            `
        }
        commentsHTML += `
        <div class="comment">
            <div class="comment-header">
                <img src="images/avatar-icon.png" alt="">
                <p class="comments-name">${comments[i].first_name} ${comments[i].last_name}</p>
                ${dropdown}
            </div>
            <p class="comment-text">
                ${comments[i].text}
            </p>
        </div>
        `
    }
    if(comments.length > 0){
        commentsDiv.innerHTML = commentsHTML;
    }
}
getComments();

addCommentBtn.onclick = function(){
    axios.post(base_url + '/api/comments/add.php' , {
        text: textarea.value,
        product_id: product_id
    }).then(res => {
        getComments()

        textarea.value = "";
    })
}

function deleteComment(id){
    axios.get(`${base_url}/api/comments/delete.php?id=${id}`).then(
        getComments()
    )
}
function editComment(id, e){
    e.preventDefault();
    axios.get(base_url + `/api/comments/get.php?id=${id}`)
    .then(res =>{
        textarea.value = res.data.text;
        btn.innerHTML = `<button class="save-button" onclick="saveEditComment(${id}, event)">Сохранить</button>`;
    })
}

function saveEditComment(id){
    axios.post(base_url + '/api/comments/edit.php' , {
        text : textarea.value,
        id : id 
    }).then(res =>{
        getComments();
        textarea.value = ``;
        btn.innerHTML = `<button class="add-button">Отправить</button>`;
    })
}

addFavoriteBtn.onclick = function(){
    axios.post(base_url + '/api/favorites/addFav.php' , {
        product_id: product_id
    })
    
}