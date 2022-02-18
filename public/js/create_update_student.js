const api = "http://127.0.0.1:8000/api";
const url = "http://127.0.0.1:8000";
// create and update student_subject
var arraySubject = [];
let data = [];
// lấy danh sách tất cả môn học
axios.get(api + "/subjects/").then(resp => {
    Object.values(resp.data).forEach((value) => {
        arraySubject.push(value);
    });
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
    onChangeSubject()
}

//confirm delete

function showConfirmDelete(id, content, title) {
    $("#exampleModal").modal("show");
    $("#exampleModalLabel").text(`Delete ${title}`)
    $("#modal-body-confirm-delete").html(`<p>You want to delete <b>${content}</b></p>`);
    $("#idStudentHidden").val(id);
    $("#button-delete-submit").html(`<button type="button" class="btn btn-secondary" onclick="hideConfirmDelete()">Close</button><button type="button" onclick="onSubmitDelete('${title}')" class="btn btn-primary">Delete</button>`)
}

function hideConfirmDelete() {
    $("#exampleModal").modal("hide");
}

function onDelete(id, title) {
    const name = $(`#name${id}`).text();
    showConfirmDelete(id, name, title)
}

function onSubmitDelete(content) {
    console.log(content)
    const id = $("#idStudentHidden").val();
    if (content === 'student'){
        $(`#deleteStudent${id}`).submit();
    }
    if (content === 'faculty') {
        axios.get(`${api}/faculty/${id}/remove`)
        fetchFaculty()
    }
    hideConfirmDelete()
    dangerT(`Delete ${content} successfully`)
}


