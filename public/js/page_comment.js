// import axios from 'axios';

var myModal = new bootstrap.Modal(document.getElementById('modal_user_confirm'), {
    keyboard: false
})

function send_comment(username, content){
    axios.post('/api/comment', {
        UserName: username,
        CommentContent: content
      })
      .then(response => {
        location.reload();
      })
      .catch(error => {
        console.error(error);
      });
}


document.getElementById('messageForm').addEventListener('submit', function(event) {
    event.preventDefault(); // 防止表單提交
    const username = document.getElementById("username").value; // 取得使用者身份
    const comment_content = document.getElementById("CommentContent").value; // 取得輸入內容
    if( username == "unknow"){
        myModal.toggle();
    }
    else{
        send_comment(username, comment_content);
    }
});

var btnConfirm = document.getElementById("btn_unknow_modal_confirm");
btnConfirm.addEventListener("click", function() {
    const comment_content = document.getElementById("CommentContent").value; // 取得輸入內容
    send_comment('unknow', comment_content);
});
