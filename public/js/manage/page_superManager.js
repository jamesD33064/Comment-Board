$(document).ready(function () {
    $('#accountTable').DataTable({
        paging: true,
        order: [[0, 'asc']]
    });
});


const modal_manager_update = new bootstrap.Modal(document.getElementById('modal_manager_update'), {
    keyboard: false
})

var click_table_username='';
var click_table_userid='';
var click_table_permission='';
// 為每個 <tr> 製作點擊事件
document.querySelectorAll('.single-manager').forEach((row) => {
    row.addEventListener('click', async function() {
        const username = this.querySelector('.username_accountTable').innerText;
        document.getElementById("modal_manager_update_username").value = username;
        click_table_username = username;

        const permission = this.querySelector('.Permission_accountTable').innerText;
        document.getElementById('modal_manager_update_permissionRole').querySelector('option[value="'+permission+'"]').selected = true;
        click_table_permission = permission;
        
        click_table_userid = this.id;

        modal_manager_update.toggle();
    });
});

function send_update(username, action, _id, Password, Permission){
    axios.put('/api/managerUser/'+username, {
        action: action,
        _id: _id,
        Password: Password,
        Permission: Permission
      })
      .then(response => {
        alert(response.data);
        // modal_manager_update.toggle();
        location.reload();
      })
      .catch(error => {
        console.error(error);
      });
}
// modal 按鈕
document.getElementById("modal_manager_update_confirm").addEventListener("click", function(){
    const password = document.getElementById("modal_manager_update_password").value;
    const passwordAgain = document.getElementById("modal_manager_update_passwordAgain").value;
    const permission = document.getElementById("modal_manager_update_permissionRole").value;
    
    if(click_table_permission !== permission){
        send_update(click_table_username, "updatePermission", click_table_userid, '', permission);
    }

    if(password!==passwordAgain){
        alert("確認密碼欄位不相符");
    } else if(password != ""){
        send_update(click_table_username, "updatePassword", click_table_userid, password, '');
    }
});
function send_delete(username){
    axios.delete('/api/managerUser/'+username)
      .then(response => {
        alert(response.data);
        location.reload();
      })
      .catch(error => {
        console.error(error);
      });
}
document.getElementById('modal_manager_deleteAccount_confirm').addEventListener('click',function(){
    send_delete( click_table_userid);
});