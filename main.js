let add_button = document.getElementById("add_button");
let modal_body = document.querySelector(".body");
const add_inputs = document.getElementById("add_inputs");
const form = document.getElementById("form");
const remove_inputs = document.getElementById("remove_inputs");
const submit = document.getElementById("submit");
const update = document.getElementById("update");

var id_to_update;

// array of colors bootstrap
let colors = [1, "bg-success", "bg-info", "bg-secondary", "bg-danger"];

let index = 1;
// call addInput() function when add add_inputs is clicked
function addInput(index) {
    // create the div holding the data
    let div = document.createElement("div");
    div.className = "mb-3 p-1 rounded " + colors[index];
    colors.push(colors[index]);
    div.id = "father_" + index;
    form.appendChild(div);
    // Create a new input element
    let input = document.createElement("input");
    input.type = "text";
    input.name = "singer_" + index;
    input.id = "singer_" + index;
    input.className = "form-control mb-1 input__model";
    input.placeholder = "Enter the singer name";
    div.appendChild(input);

    // Create a new input element
    let input2 = document.createElement("input");
    input2.type = "text";
    input2.name = "song_" + index;
    input2.id = "song_" + index;
    input2.className = "form-control mb-1 input__model";
    input2.placeholder = "Enter the song name";
    div.appendChild(input2);
    // Create a new input element
    let input3 = document.createElement("input");
    input3.type = "text";
    input3.name = "lyrics_" + index;
    input3.id = "lyrics_" + index;
    input3.className = "form-control input__model";
    input3.placeholder = "Enter the song lyrics";
    div.appendChild(input3);
    index++;
}

add_button.addEventListener("click", function () {
    form.innerHTML = "";
    document.getElementById("alert__").innerHTML = "";
    index = 1;
    addInput(index);
});

add_inputs.addEventListener("click", function () {
    index++;
    addInput(index);
});

function removeInputs() {
    let div = document.getElementById("father_" + index);
    form.removeChild(div);
    index--;
}

remove_inputs.addEventListener("click", function () {
    if (index > 1) {
        removeInputs();
    }
});

// get data from form after submit
submit.addEventListener("click", function () {
    let data = {};
    let all = [];
    for (let i = 1; i <= index; i++) {
        // get the singer name and check if it's empty
        data["singer_" + i] = document.getElementById("singer_" + i).value;
        if (data["singer_" + i] == "") {
            // alert("Please enter the singer name");
            document.getElementById("singer_" + i).focus();
            document.getElementById("singer_" + i).style.borderColor = "red";
            document.getElementById("alert__").innerHTML =
                "* Please enter the singer name";
            return;
        } else {
            document.getElementById("singer_" + i).style.borderColor = "green";
            document.getElementById("alert__").innerHTML = "";
        }
        // get the song name and check if it's empty
        data["song_" + i] = document.getElementById("song_" + i).value;
        if (data["song_" + i] == "") {
            document.getElementById("song_" + i).focus();
            document.getElementById("song_" + i).style.borderColor = "red";
            document.getElementById("alert__").innerHTML =
                "* Please enter the song name";
            return;
        } else {
            document.getElementById("song_" + i).style.borderColor = "green";
            document.getElementById("alert__").innerHTML = "";
        }
        // get the song lyrics and check if it's empty
        data["lyrics_" + i] = document.getElementById("lyrics_" + i).value;
        if (data["lyrics_" + i] == "") {
            document.getElementById("lyrics_" + i).focus();
            document.getElementById("lyrics_" + i).style.border = "red";
            document.getElementById("alert__").innerHTML =
                "* Please enter the song lyrics";
            return;
        } else {
            document.getElementById("lyrics_" + i).style.borderColor = "green";
            document.getElementById("alert__").innerHTML = "";
        }
        all.push(data);
    }
    // console.log(all);
    handleData(all, "save");
    // hide modal
    $("#exampleModal").modal("hide");
    // form.reset();
    // form.innerHTML = "";
    // index = 1;
});

function handleData(data, type) {
    var form = new FormData();
    // console.log(data);

    for (let index = 0; index < data.length; index++) {
        for (key in data[index]) {
            form.append(key, data[index][key]);
        }
    }
    // console.log(form);
    form.append("action", type);
    // console.log(form)
    var ajax = new XMLHttpRequest();

    ajax.addEventListener("readystatechange", function () {
        if (ajax.readyState == 4) {
            if (ajax.status == 200) {
                getData(ajax.responseText);
            } else {
                alert("an error occured");
            }
        }
    });

    ajax.open("post", "api.php", true);
    ajax.send(form);
}

function getData(data) {
    // console.log(data);
    let data2 = JSON.parse(data);
    if (data2["action"] == "read") {
        // console.log(data2.data[0]['singer']);
        // console.log(data2.data[1]['song']);
        //get length of data
        displayData(data2);
    } else if (data2["action"] == "save") {
        handleData({}, "read");
    } else if (data2["action"] == "delete") {
        handleData({}, "read");
    } else if (data2["action"] == "edit") {
        // console.log('edit');
        // console.log(data2);
        showData(data2);
        // handleData({},'read');
    } else if (data2["action"] == "update") {
        handleData({}, "read");
    } else if (
        data2["action"] == "sortbysinger" ||
        data2["action"] == "sortbysong"
    ) {
        displayData(data2);
    }
}

handleData({}, "read");

// display data
function displayData(data2) {
    let tbody = document.querySelector(".js-table-body");
    let str = "";
    for (let i = 0; i < data2.data.length; i++) {
        str += `<tr class="tr-height">
                    <td>${data2.data[i]["id"]}</td>
                    <td>${data2.data[i]["singer"]}</td>
                    <td>${data2.data[i]["song"]}</td>
                    <td>
                        <a href="lyrics.php?id=${data2.data[i]["id"]}" class="text-white">
                            <button class="btn btn-success">Lyrics</button>
                        </a>
                    </td>
                    <td>
                        <div class="d-flex">
                            <button onclick="getId(this)" class="btn btn-danger me-2">delete</button>
                            <button onclick = "edit(this)" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal1" >Edit</button>
                        </div>
                    </td>
                
                `;
    }
    tbody.innerHTML = str;
}

// work on delete
function getId(btn) {
    let id = btn.parentNode.parentNode.parentNode.children[0].innerText;
    // set in object
    let data = {};
    let all = [];
    data["id"] = id;
    all.push(data);

    handleData(all, "delete");
}

//show data in modal
function edit(btn) {
    let id = btn.parentNode.parentNode.parentNode.children[0].innerText;
    // set in object
    let data = {};
    let all = [];
    data["id"] = id;
    id_to_update = id;
    all.push(data);

    handleData(all, "edit");
}

// show data in modal
function showData(data) {
    let singer = data.data["singer"];
    let song = data.data["song"];
    let lyrics = data.data["lyrics"];
    document.getElementById("singer_update").value = singer;
    document.getElementById("song_update").value = song;
    document.getElementById("lyrics_update").value = lyrics;
}

// update data
update.addEventListener("click", function () {
    // let id = btn.parentNode.parentNode.children[0].innerText;
    let data = {};
    let all = [];
    data["singer"] = document.getElementById("singer_update").value;
    data["song"] = document.getElementById("song_update").value;
    data["lyrics"] = document.getElementById("lyrics_update").value;
    data["id"] = id_to_update;
    if (data["singer"] == "" || data["song"] == "" || data["lyrics"] == "") {
        alert("Please fill all the fields");
        return;
    }
    all.push(data);
    handleData(all, "update");
});

function tableSearch() {
    // console.log("search");
    let input, filter, table, tr, td, i, txtValue;

    input = document.getElementById("search");
    filter = input.value.toUpperCase();
    table = document.getElementById("table");
    tr = table.getElementsByTagName("tr");

    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[1];
        if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}

// sort table
sort_by_singer_button = document.getElementById("sort-name");
sort_by_song_button = document.getElementById("sort-song");

sort_by_singer_button.addEventListener("click", function () {
    let data = {};
    let all = [];
    // data["action"] = "sort";
    data["order"] = "singer";
    all.push(data);
    handleData(all, "sortbysinger");
});

sort_by_song_button.addEventListener("click", function () {
    let data = {};
    let all = [];

    data["order"] = "song";
    all.push(data);
    handleData(all, "sortbysong");
});

// api fetch data

// validate form
