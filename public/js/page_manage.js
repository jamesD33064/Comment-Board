const btn_block_comment = document.getElementById('btn_block_comment');
const btn_none_comment = document.getElementById('btn_none_comment');
sessionStorage.setItem("comment_del_id", '[]');
var listItems = document.querySelectorAll('.single-comment');
// 為每個 <li> 製作點擊事件
listItems.forEach(function (item) {
    item.addEventListener('click', function () {
        const _id = this.id;
        var comment_del_id = JSON.parse(sessionStorage.getItem('comment_del_id'));
        var newary = [];

        if (this.classList.contains('active')) {
            this.classList.remove('active');
            //移除特定字串
            newary = comment_del_id.filter(function (letter) {
                return letter !== _id;
            });
        } else {
            this.classList.add('active');
            comment_del_id.push(_id);
            newary = comment_del_id;
        }
        sessionStorage.setItem("comment_del_id", JSON.stringify(newary));

        //如果未選取任何留言
        if (newary.length == 0) {
            btn_block_comment.style.display = 'none';
            btn_none_comment.style.display = 'none';
        } else {
            btn_block_comment.style.display = 'block';
            btn_none_comment.style.display = 'block';
        }

    });
});

function reloadPage() {
    return new Promise(function(resolve) {
      location.reload();
      resolve();
    });
  }

function send_comment(commentId, updatedData){    
    axios.put(`/api/comment/${commentId}`, updatedData)
      .then(response => {
        console.log("success");
      })
      .catch(error => {
      })
};

btn_none_comment.addEventListener('click', function () {
    var comment_del_id = JSON.parse(sessionStorage.getItem('comment_del_id'));
    Promise.all(comment_del_id.map(function(element) {
    return send_comment(element, {'visible':'none'});
    })).then(reloadPage);
});

btn_block_comment.addEventListener('click', function () {
    var comment_del_id = JSON.parse(sessionStorage.getItem('comment_del_id'));
    Promise.all(comment_del_id.map(function(element) {
    return send_comment(element, {'visible':'block'});
    })).then(reloadPage);
});