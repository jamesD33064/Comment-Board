// const logTable = document.getElementById('logTable');

// const searchForUsername = document.getElementById('searchForUsername');
// const searchForAction = document.getElementById('searchForAction');
// const searchForDetails = document.getElementById('searchForDetails');
// const searchForCreated_at = document.getElementById('searchForCreated_at');
// function change_searchForUsername(event) {
//     const rows = document.querySelectorAll('#logTable tbody tr');
//     rows.forEach(row => {
//         const userId = row.querySelector('.user_id').textContent;
//         const action = row.querySelector('.action').textContent;
//         const details = row.querySelector('.details').textContent;
//         const created_at = row.querySelector('.created_at').textContent;

//         if (
//             userId.indexOf(searchForUsername.value) != -1 &&
//             action.indexOf(searchForAction.value) != -1 &&
//             details.indexOf(searchForDetails.value) != -1 &&
//             created_at.indexOf(searchForCreated_at.value) != -1
//         ) {
//             row.style.display = 'block';
//         }
//         else{
//             row.style.display = 'none';
//         }
//     });
// }
// searchForUsername.addEventListener('change', change_searchForUsername);
// searchForAction.addEventListener('change', change_searchForUsername);
// searchForDetails.addEventListener('change', change_searchForUsername);
// searchForCreated_at.addEventListener('change', change_searchForUsername);

$(document).ready(function () {
    $('#logTable').DataTable({
        paging: true,
    });
});
