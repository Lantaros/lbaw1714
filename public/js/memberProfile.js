let siteRoot = document.location.origin; //"http://localhost:8000/"

let befriendBtn = document.querySelector(".befriendBtn");

if(befriendBtn != null)
    befriendBtn.addEventListener('click', function (event) {

        event.preventDefault();

        let friendId = document.querySelector(".befriendBtn").getAttribute('id');



        let request = new XMLHttpRequest();

        request.open('POST', siteRoot + '/sendFriendNotification', true);

        request.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').content);
        request.setRequestHeader("Content-type", "application/json");

        request.addEventListener('load', friendResponse);

        let data = {'idfriend': friendId};

        request.send(JSON.stringify(data));
    });

function friendResponse(){
    let lines = JSON.parse(this.responseText);

    if(lines){
        befriendBtn.innerHTML = '' +
            '<i class="fas fa-check"></i>' +
            'Friend Request Sent';
    }

}

let friend;

function acceptRequest(buddy){

    console.log("merda")

    let request = new XMLHttpRequest();

    friend = buddy;

    request.open('POST', siteRoot + '/acceptFriend', true);

    request.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').content);
    request.setRequestHeader("Content-type", "application/json");

    request.addEventListener('load', friendAcceptance);

    let data = {'idFriend': buddy};

    request.send(JSON.stringify(data));
}

function friendAcceptance(){
    let lines = JSON.parse(this.responseText);

    let notification = document.querySelector("#buddyRequest"+friend);

    if(lines){
        notification.innerHTML = '';
    }

}

function blockRequest(buddy){

    let request = new XMLHttpRequest();

    friend = buddy;

    request.open('POST', siteRoot + '/blockFriend', true);

    request.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').content);
    request.setRequestHeader("Content-type", "application/json");

    request.addEventListener('load', friendAcceptance);

    let data = {'idNotification': buddy};

    request.send(JSON.stringify(data));
}