import axios from "axios";
import "./bootstrap";
import "./product";

Echo.channel("notifications").listen("UserSessionChange", (e) => {
    const notifications = document.querySelectorAll(
        ".notification-" + e.user_id
    );
    notifications.forEach((notification) => {
        notification.innerText = e.message;
        notification.classList.remove("text-success", "text-muted");
        notification.classList.add("text-" + e.type);
    });
});

let idRecipient = document.getElementById("user1");
if (idRecipient) {
    idRecipient = idRecipient.value;
}

const idUser = document.getElementById("user2").value;
var channelId = createChannelName(idRecipient, idUser);
var idUserSidebar = [];

Echo.channel(`chat.${channelId}`).listen("MessageSent", (e) => {
    addMessageToList(e.message, e.user_id, idUser);
});

// change message sidebar
axios({
    method: "get",
    url: "http://127.0.0.1:8000/api/getUser",
    params: { query: idUser },
}).then(function (response) {
    idUserSidebar = response.data;
    idUserSidebar.forEach((id) => {
        channelId = createChannelName(id, idUser);
        Echo.channel(`chat.${channelId}`).listen("MessageSent", (e) => {
            addMessageSidebar(e.message, e.channel, e.user_id, idUser);
        });
    });
});

function addMessageSidebar(message, channel, user_sent, user_id) {
    const messageText = document.getElementById(`textBox-${channel}`);

    if (user_sent == user_id) {
        messageText.innerText = `You: ${message}`;
    } else {
        messageText.innerText = message;
    }
}

function createChannelName(idRecipient, idUser) {
    const sortedIds = [idRecipient, idUser].sort((a, b) => a - b);
    return `${sortedIds[0]}-${sortedIds[1]}`;
}

function getCurrentDate() {
    const today = new Date();

    const dd = String(today.getDate()).padStart(2, "0");
    const mm = String(today.getMonth() + 1).padStart(2, "0");
    const yyyy = today.getFullYear();

    const hours = String(today.getHours()).padStart(2, "0");
    const minutes = String(today.getMinutes()).padStart(2, "0");
    const seconds = String(today.getSeconds()).padStart(2, "0");

    return `${yyyy}-${mm}-${dd} ${hours}:${minutes}:${seconds}`;
}

function addMessageToList(message, senderId, userId) {
    const messagesList = document.getElementById("messages-list");
    const newMessage = document.createElement("li");
    const img = document.createElement("img");
    img.src =
        "https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava6-bg.webp";
    img.style = "width: 45px; height: 100%";

    const textMessage = document.createElement("p");
    const p = document.createElement("p");
    const div = document.createElement("div");

    textMessage.className = "small p-2 ms-3 mb-1 rounded-3";
    textMessage.innerText = message;
    const other = "d-flex flex-row justify-content-start";
    const own = "d-flex flex-row justify-content-end";
    p.textContent = getCurrentDate();

    if (senderId === userId) {
        newMessage.className = own;
        textMessage.className =
            "small p-2 me-3 mb-1 text-white rounded-pill bg-primary text-break";
        p.className = "small me-3 mb-3 rounded-3 text-muted";
        div.appendChild(textMessage);
        div.appendChild(p);
        newMessage.appendChild(div);
        newMessage.appendChild(img);
    } else {
        newMessage.className = other;
        textMessage.className = "small p-2 ms-3 mb-1 rounded-pill text-break";
        textMessage.style = "background-color: #f5f6f7";
        p.className = "small ms-3 mb-3 rounded-3 text-muted float-end";
        div.appendChild(textMessage);
        div.appendChild(p);
        newMessage.appendChild(img);
        newMessage.appendChild(div);
    }

    messagesList.appendChild(newMessage);

    // scroll when add new messages
    messagesList.scrollTop = messagesList.scrollHeight;
}

document.addEventListener("DOMContentLoaded", function () {
    var scrollBox = document.getElementById("messages-list");
    if (scrollBox) {
        scrollBox.scrollTop = scrollBox.scrollHeight;
    }
});
