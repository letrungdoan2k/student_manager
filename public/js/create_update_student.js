const api = "http://127.0.0.1:8000/api";

// create and update student_subject
var arraySubject = [];
let data = [];
// lấy danh sách tất cả môn học
$.ajax({
    type: "GET",
    url: api + "/subjects/",
    success: function (res) {
        Object.values(res).forEach((value) => {
            arraySubject.push(value);
        });
    },
    error: function (err) {
        console.log(err);
    },
});

//lấy môn đã Chọn
function filterSubject() {
    data = arraySubject;
    //lấy danh sách môn đã có
    $("[name='subject_id[]']").each(function () {
        let subject = $(this).val();
        console.log(subject);
        //lọc ra danh sách môn chưa có
        data = data.filter((obj) => obj.id != subject);
        console.log(data.filter((obj) => obj.id != 2))
    });
    return data;
}
// 
function changeSubject() {
    $("[name='subject_id[]']").each(function () {
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
}

// onclick add form
$(document).ready(function () {
    $("#addForm").click(function () {
        let option = filterSubject().map(
            (subject) => `<option value="${subject.id}" >${subject.name}</option>`
        );
        if(data.length > 0) {
        $("#point-form").append(
            `
                    <div class="row mb-3">
                        <div class="col-4">
                        <select name="subject_id[]" onChange="changeSubject()" class="form-control">` +
                `${option}` +
                `</select>
                        </div>
                        <div class="col-4">
                            <input name="point[]" type="text" class="form-control">
                        </div>
                        <div class="col-4">
                            <button type="button" onclick="onRemove(this)" class="bi bi-trash btn btn-danger"></button>
                        </div>
                    </div>
        `
        );
        }else{
            alert("Hết môn học rồi !!!")
        }
        changeSubject()
    });
});

function onRemove(el) {
    $(el).parent().parent().remove();
    changeSubject()
}
