$(document).ready(function () {
    $('#roleTable').DataTable({
        paging: true,
        order: [[0, 'asc']]
    });
});

function send_comment(username, content) {
    axios.post('/api/permissionRole', {
        RoleName: username,
        Permission: content
    })
        .then(response => {
            location.reload();
        })
        .catch(error => {
            console.error(error);
        });
}

document.getElementById("btn_newPermissionRole_modal_confirm").addEventListener("click", function () {
    const a = document.getElementById('newRoleName').value;
    const b =
    {
        "accountManage": {
            "admin": {
                "C": document.getElementById("checkboxAccountManage.superManager.C").checked,
                "R": document.getElementById("checkboxAccountManage.superManager.R").checked,
                "U": document.getElementById("checkboxAccountManage.superManager.U").checked,
                "D": document.getElementById("checkboxAccountManage.superManager.D").checked
            },
            "role": {
                "C": document.getElementById("checkboxAccountManage.roleManager.C").checked,
                "R": document.getElementById("checkboxAccountManage.roleManager.R").checked,
                "U": document.getElementById("checkboxAccountManage.roleManager.U").checked,
                "D": document.getElementById("checkboxAccountManage.roleManager.D").checked
            }
        },
        "checkRecord": {
            "log": {
                "R": document.getElementById("checkboxCheckRecord.logRecord.R").checked,
                "Export": document.getElementById("checkboxCheckRecord.logRecord.Export").checked
            }
        }
    };
    send_comment(a, JSON.stringify(b));
});


//modal
const modal_permissionRole_update = new bootstrap.Modal(document.getElementById('modal_permissionRole_update'), {
    keyboard: false
})
var click_table_rolename = '';
var click_table_roleid = '';
var click_table_permission = '';
// 為每個 <tr> 製作點擊事件
document.querySelectorAll('.single-permissionRole').forEach((row) => {
    row.addEventListener('click', async function () {
        click_table_rolename = this.querySelector('.rolename').innerText;
        click_table_roleid = this.id;
        click_table_permission = JSON.parse(this.querySelector('.permission').innerText);
        document.getElementById('modal_permissionRole_update_username').value = click_table_rolename;

        document.getElementById("modal_checkboxAccountManage.superManager.R").checked = click_table_permission['accountManage']['admin']['R'];
        document.getElementById("modal_checkboxAccountManage.superManager.C").checked = click_table_permission['accountManage']['admin']['C'];
        document.getElementById("modal_checkboxAccountManage.superManager.U").checked = click_table_permission['accountManage']['admin']['U'];
        document.getElementById("modal_checkboxAccountManage.superManager.D").checked = click_table_permission['accountManage']['admin']['D'];

        document.getElementById("modal_checkboxAccountManage.roleManager.R").checked = click_table_permission['accountManage']['role']['R'];
        document.getElementById("modal_checkboxAccountManage.roleManager.C").checked = click_table_permission['accountManage']['role']['C'];
        document.getElementById("modal_checkboxAccountManage.roleManager.U").checked = click_table_permission['accountManage']['role']['U'];
        document.getElementById("modal_checkboxAccountManage.roleManager.D").checked = click_table_permission['accountManage']['role']['D'];

        document.getElementById("modal_checkboxCheckRecord.logRecord.R").checked = click_table_permission['checkRecord']['log']['R'];
        document.getElementById("modal_checkboxCheckRecord.logRecord.Export").checked = click_table_permission['checkRecord']['log']['Export'];

        modal_permissionRole_update.toggle();
    });
});

document.getElementById('modal_permissionRole_deleteRole_confirm').addEventListener('click', function () {
    axios.delete('/api/permissionRole/' + click_table_roleid)
        .then(response => {
            alert(response.data);
            location.reload();
        })
        .catch(error => {
            console.error(error);
        });
});

document.getElementById('modal_permissionRole_updateRole_confirm').addEventListener('click', function () {
    const a =
    {
        "accountManage": {
            "admin": {
                "C": document.getElementById("modal_checkboxAccountManage.superManager.C").checked,
                "R": document.getElementById("modal_checkboxAccountManage.superManager.R").checked,
                "U": document.getElementById("modal_checkboxAccountManage.superManager.U").checked,
                "D": document.getElementById("modal_checkboxAccountManage.superManager.D").checked
            },
            "role": {
                "C": document.getElementById("modal_checkboxAccountManage.roleManager.C").checked,
                "R": document.getElementById("modal_checkboxAccountManage.roleManager.R").checked,
                "U": document.getElementById("modal_checkboxAccountManage.roleManager.U").checked,
                "D": document.getElementById("modal_checkboxAccountManage.roleManager.D").checked
            }
        },
        "checkRecord": {
            "log": {
                "R": document.getElementById("modal_checkboxCheckRecord.logRecord.R").checked,
                "Export": document.getElementById("modal_checkboxCheckRecord.logRecord.Export").checked
            }
        }
    };
    axios.put('/api/permissionRole/'+click_table_roleid, {
        Permission: JSON.stringify(a)
    })
    .then(response => {
        alert(response.data);
        location.reload();
    })
    .catch(error => {
        console.error(error);
    });
});