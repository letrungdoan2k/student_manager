const api = "https://pure-headland-57673.herokuapp.com/api";

// create and update student_subject
var arraySubject = [];
let data = [];
// lấy danh sách tất cả môn học
$.ajax({
    type: "GET",
    crossDomain: true,
    xhrFields: {
        withCredentials: true,
    },
    url: api + "/subjects/",
    success: function (res) {
        Object.values(res).forEach((value) => {
            arraySubject.push(value);
        });
    },
    error: function (err) {
    },
});

//lấy môn đã Chọn
function filterSubject() {
    data = arraySubject;
    //lấy danh sách môn đã có
    $("[name='subjects[]']").each(function () {
        let subject = $(this).val();
        //lọc ra danh sách môn chưa có
        data = data.filter((obj) => obj.id != subject);
    });
    return data;
}

var input
setTimeout(filterSubject, 500)

function changeSubject(id) {
    let value = $('#option' + id).val();
    $("[name='subjects[]']").each(function () {
        let val = $(this).val();
        let name = $(this).children(`[value='${val}']`).text();
        let option = filterSubject().map(
            (subject) =>
                `<option value="${subject.id}" >${subject.name}</option>`
        );
        $(this).html(
            `<option value="${val}" selected >${name}</option>` + option
        );
    });
    $('#input' + id).html(`<input name="subject_id[${value}][point]" type="text" class="form-control">`)
}

changeSubject();

// onclick add form
$(document).ready(function () {
    $("#addForm").click(function () {
        let rowId = Date.now();
        let id = rowId
        let option = filterSubject().map(
            (subject) => `<option value="${subject.id}" >${subject.name}</option>`
        );
        let input = filterSubject().map(
            (subject) => `<input name="subject_id[${subject.id}][point]" type="text" class="form-control">`
        );
        if (data.length > 0) {
            $("#point-form").append(
                `
                    <div class="row mb-3">
                        <div class="col-4">
                        <select id="option${rowId}" name="subjects[]" onChange="changeSubject(${id})" class="form-control">` +
                `${option}` +
                `</select>
                        </div>
                        <div class="col-4" id="input${rowId}" >`
                            + `${input[0]}` +
                        `</div>
                        <div class="col-4">
                            <button type="button" onclick="onRemove(this)" class="bi bi-trash btn btn-danger"></button>
                        </div>
                    </div>
        `
            );
        } else {
            alert("Hết môn học rồi !!!")
        }
        changeSubject()
    });
});

function onRemove(el) {
    $(el).parent().parent().remove();
    changeSubject()
}

//

