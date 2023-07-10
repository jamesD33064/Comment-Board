var myModal = new bootstrap.Modal(document.getElementById('modal_delAccount_modal_confirm'), {
    keyboard: false
})

document.getElementById('btn_delAccount').addEventListener('click', function (event) {
    myModal.toggle();
});


function del_userAccount(username) {
    axios.delete('/api/user/' + username)
        .then(response => {
            window.location.href = "/logout";
        })
        .catch(error => {
            console.error(error);
        });
}

var btn_delAccount_modal_confirm = document.getElementById("btn_delAccount_modal_confirm");
btn_delAccount_modal_confirm.addEventListener("click", function () {
    const username = document.getElementById('profile_username').innerText;
    del_userAccount(username);
});
