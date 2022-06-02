let usersTableEl = document.getElementById('usersTable');
window.onload = async () => {
    usersTableEl = document.getElementById('usersTable');
    const response = await fetch('../API/get_users.php', {
        method: 'GET',
    });
    const data = await response.json();
    data.forEach((user) => appendRow(user));

}

function appendRow(user) {
    usersTableEl.innerHTML += `
    <tr id = "${user.username}" >
                <td>${user.username}</td>
                <td>${user.pass}</td>
                <td>${user.first_name}</td>
                <td>${user.last_name}</td>
                <td>${user.email}</td>
                <td>${user.phone_number}</td>
                <td><button class="btn btn-outline-primary" onclick="edit(this)">Edit</button>
                 <button onclick = "delete_user(this)" class="btn btn-outline-danger">Delete</button></td>
            </tr>
    `;
}
async function delete_user(element){
    const rowEl = element.parentElement.parentElement;
    const username = rowEl.id;
    const response = await fetch('/cheiflancer/API/delete_user.php', {
        headers: {
            'Content-Type': 'application/json'
        },
        method: 'POST',
        body: JSON.stringify({username}) 
    });
    const data = await response.json();
    rowEl.remove();

}