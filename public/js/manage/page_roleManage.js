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
        "accountManage":{
            "admin":{
                "C":document.getElementById("checkboxAccountManage.superManager.C").checked,
                "R":document.getElementById("checkboxAccountManage.superManager.R").checked,
                "U":document.getElementById("checkboxAccountManage.superManager.U").checked,
                "D":document.getElementById("checkboxAccountManage.superManager.D").checked
            },
            "role":{
                "C":document.getElementById("checkboxAccountManage.roleManager.C").checked,
                "R":document.getElementById("checkboxAccountManage.roleManager.R").checked,
                "U":document.getElementById("checkboxAccountManage.roleManager.U").checked,
                "D":document.getElementById("checkboxAccountManage.roleManager.D").checked
            }
        },
        "checkRecord":{
            "log":{
                "R":document.getElementById("checkboxCheckRecord.logRecord.R").checked,
                "Export":document.getElementById("checkboxCheckRecord.logRecord.Export").checked
            }
        }
    };
    send_comment(a, JSON.stringify(b));
});