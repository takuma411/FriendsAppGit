const form = document.querySelector(".typing-area"),
inputField = form.querySelector(".input-field"),
sendBtn = form.querySelector("button"),
chatBox = document.querySelector(".chat-box");

form.onsubmit = (e) =>{
    e.preventDefault();
} 

function scrollToBottom(){
  chatBox.scrollTop = chatBox.scrollHeight;
}

sendBtn.onclick = ()=>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "/FriendsViews/insert-chat.php", true);
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
              inputField.value = "";
              scrollToBottom();
          }
      }
    }
    let formData = new FormData(form);
    xhr.send(formData);
    
}


setInterval(() =>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "/FriendsViews/get-chat.php", true);
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
            let data = xhr.response;
            chatBox.innerHTML = data;
        }
    }
  }
  let formData = new FormData(form);
    xhr.send(formData);
  
}, 500);

const form2 = document.querySelector(".gift_send"),
inputField2 = form2.querySelector(".input-field"),
sendBtn2 = form2.querySelector("button");

sendBtn2.onclick = ()=>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "/FriendsViews/insert-gift-chat.php", true);
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
              //  inputField2.value = "FriendsGiftを送りました！";
              scrollToBottom();
          }
      }
    }
    let formData2 = new FormData(form2);
    xhr.send(formData2);
}



//画像送信 insert
const form3 = document.querySelector(".img_send"),
inputField3 = form3.querySelector(".input-field"),
sendBtn3 = form3.querySelector("button");


sendBtn3.onclick = ()=>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST","/FriendsViews/insert-img-chat.php", true);
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
              inputField3.value = "";
              scrollToBottom();
          }
      }
    }
    let formData3 = new FormData(form3);
    xhr.send(formData3);
}
