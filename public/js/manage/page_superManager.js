/**
 * 管理帳號表格
 */
$(document).ready(function () {
    $('#accountTable').DataTable({
        paging: true,
        order: [[0, 'asc']]
    });
});

/**
 * 新增管理員
 */
const modal_manager_register = new bootstrap.Modal(document.getElementById('modal_manager_register'), {
    keyboard: false
})
document.getElementById('btn_managerRegister').addEventListener('click', function () {
    modal_manager_register.toggle();
});

document.getElementById("btn_modal_managerRegister").addEventListener('click', function () {
    //send requests
    axios.post("/api/manager", {
        username: document.getElementById('username').value,
        password: document.getElementById('password').value,
        permission: document.getElementById('permission').value,
        status: document.getElementById('status').value,
        name: document.getElementById('username').value,
        email: '@'
    }).then(response => {
        alert(response.data);
        location.reload();
    }).catch(error => {
        console.error(error);
    });
});


/**
 * 更新管理員資訊
 */
const modal_manager_update = new bootstrap.Modal(document.getElementById('modal_manager_update'), {
    keyboard: false
})

var click_table_username = '';
var click_table_userid = '';
var click_table_permission = '';
// 為每個 <tr> 製作點擊事件
document.querySelectorAll('.single-manager').forEach((row) => {
    row.addEventListener('click', async function () {
        const username = this.querySelector('.username_accountTable').innerText;
        document.getElementById("modal_manager_update_username").value = username;
        click_table_username = username;

        const permission = this.querySelector('.Permission_accountTable').innerText;
        document.getElementById('modal_manager_update_permissionRole').querySelector('option[value="' + permission + '"]').selected = true;
        click_table_permission = permission;

        click_table_userid = this.id;

        modal_manager_update.toggle();
    });
});

// update
function send_update(username, action, _id, Password, Permission) {
    axios.put('/api/manager/' + username, {
        action: action,
        _id: _id,
        Password: Password,
        Permission: Permission
    }).then(response => {
        alert(response.data);
        location.reload();
    }).catch(error => {
        console.error(error);
    });
}
document.getElementById("modal_manager_update_confirm").addEventListener("click", function () {
    const password = document.getElementById("modal_manager_update_password").value;
    const passwordAgain = document.getElementById("modal_manager_update_passwordAgain").value;
    const permission = document.getElementById("modal_manager_update_permissionRole").value;

    if (click_table_permission !== permission) {
        send_update(click_table_username, "updatePermission", click_table_userid, '', permission);
    }

    if (password !== passwordAgain) {
        alert("確認密碼欄位不相符");
    } else if (password != "") {
        send_update(click_table_username, "updatePassword", click_table_userid, password, '');
    }
});

// delete manager
function send_delete(userid) {
    axios.delete('/api/manager/' + userid)
        .then(response => {
            alert(response.data);
            location.reload();
        })
        .catch(error => {
            console.error(error);
        });
}
document.getElementById('modal_manager_deleteAccount_confirm').addEventListener('click', function () {
    send_delete(click_table_userid);
});