'use strict';

let root = document.location.origin; //"http://localhost:8000/"

let searchContainer = document.querySelector('.container');
let timeline = document.querySelector('#time');
let timelineCopy;

if(timeline != null){
    timelineCopy = timeline.innerHTML;
}
let containerCopy = searchContainer.innerHTML;
let searchForm = document.querySelector('input[id=search_text]');
searchForm.addEventListener('keyup', searchEvent);

searchForm.addEventListener('submit', function (event) {
    console.log("DEU Enter");
    event.preventDefault();
})

function searchEvent(event) {
    let request = new XMLHttpRequest();
    request.open('get', root + '/search?' + encodeForAjax({'searchField': searchForm.value}), true);
    request.addEventListener('load', searchEventsReceived);
    request.send();
    event.preventDefault();
}

function searchEventsReceived(){
    let lines = JSON.parse(this.responseText);

    searchContainer.innerHTML = '';

    if(timeline != null)
        timeline.innerHTML = '';

    let div1 = document.createElement('div');
    div1.classList.add('nearby-events');

    div1.innerHTML =
        '        <br>' +
        '        <legend style=" color: #333; padding: 20px; margin-left: 0; padding-left: 0;">\n' +
        '            <i class="fas fa-calendar-check"></i>\n' +
        '            <span style="margin-left: .5rem;">\n' +
        '            Search Results\n' +
        '          </span>\n' +
        '        </legend>\n';

    let div2 = document.createElement('div');
    div2.classList.add('bs-docs-section');

    let div3 = document.createElement('div');
    div3.classList.add('row', 'justify-content-center',  'align-items-center');


    lines.forEach(function(data){

        let link = root + '/events/' + data.idevent;

        let image = '/storage/' + data.imagepath;

        div3.innerHTML +=
            '            <div class="col-lg-4 align-self-start">\n' +
            '              <div class="bs-ccomponent">\n' +
            '                <div class="card mb-4" style="box-shadow: 1px 1px 30px #ddd;">\n' +
            '                  <div class="card-body">\n' +
            '                  <h3 class="card-title" style="background-color: #fff;"><a style="color: #000;" href="{{asset(\\\'events/\' + data.idevent +\'\\\')}}">' + data.name + '</a></h3>\n' +
            '                    <h6 class="card-subtitle text-muted">' + data.startday + '</h6>\n' +
            '                  </div>\n' +
            '                  <img style="width: 100%; height: 200px; object-fit: cover;" src="' + image + '" alt="Card image">\n' +
            '                  <div class="card-body">\n' +
            '                    <p class="card-text">'+ data.description +'</p>\n' +
            '                  </div>\n' +
            '                  <div class="card-footer text-muted" style="background-color: #fff; text-align: right;">\n' +
            '                    <a href="' + link + '" class="card-link">Open event</a>\n' +
            '                  </div>\n' +
            '                </div>\n' +
            '              </div>\n' +
            '            </div>';
    });


    div1.append(div2);
    div2.append(div3);

    searchContainer.append(div1);

    if(searchForm.value == ''){
        searchContainer.innerHTML = containerCopy;
        timeline.innerHTML = timelineCopy;
    }

}

function encodeForAjax(data) {
    return Object.keys(data).map(function(k){
        return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
    }).join('&');
}