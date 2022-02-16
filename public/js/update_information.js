const formProfile = document.querySelector(".profile-form-update");

//
function showModal() {
    $("#myModal").modal("show");
}

function hideModal() {
    $("#myModal").modal("hide");
}

function toast() {
    bs4Toast.primary("Primary Toast", "This is Primary toast example.");
}

async function profileStudent(id) {
    try {
        const response = await axios.get(api + `/profile/${id}`);
        formProfile.name.value = response.data.name;
        formProfile.birthday.value = response.data.birthday;
        formProfile.email.value = response.data.email;
        formProfile.phone.value = response.data.phone;
        formProfile.address.value = response.data.address;
        formProfile.gender.value = response.data.gender;
        formProfile.id.value = id;
    } catch (error) {
        console.error(error);
    }
    showModal();
}

var imagefile = document.querySelector("#updateProfileAvata");
const profileShow = document.querySelector(".kt-form--label-right");
$().ready(function () {
    $("#profileSubmit").validate({
        rules: {
            name: "required",
            birthday: "required",
            email: {
                required: true,
                email: true,
            },
            address: "required",
            phone: "required",
            gender: "required",
        },
        messages: {
            name: "Vui lòng nhập vào name",
            birthday: "Vui lòng nhập vào birthday",
            email: {
                required: "Vui lòng nhập vào email",
                email: "Nhập đúng định dạng email đê :D",
            },
            address: "Vui lòng nhập vào address",
            phone: "Vui lòng nhập vào phone",
            gender: "Vui lòng nhập vào gender",
        },
        submitHandler: function (form) {
            const data = {
                name: form.name.value,
                birthday: form.birthday.value,
                email: form.email.value,
                phone: form.phone.value,
                address: form.address.value,
                gender: form.gender.value,
            };
            profileShow.name.value = data.name;
            profileShow.birthday.value = data.birthday;
            $("#profileEmail").text(data.email);
            $("#profilePhone").text(data.phone);
            profileShow.address.value = data.address;
            data.gender == 0
                ? (profileShow.gender.value = "Male")
                : (profileShow.gender.value = "Female");
            axios.put(api + `/profile/${form.id.value}`, data);

            // let formData = new FormData()
            // formData.append("image", imagefile.files[0]);
            // axios.post(api + `/profile/image/${form.id.value}`, formData, {
            //     headers: {
            //         'Content-Type': 'multipart/form-data'
            //     }
            // })
            hideModal();
            toast();
        },
    });
});

// student add subject
var isArraySubject = []

function showModalSubject() {
    $("#myModalSubject").modal("show");
}

function hideModalSubject() {
    $("#myModalSubject").modal("hide");
}

function SubjectFilter() {
    data = isArraySubject;
    //lấy danh sách môn đã có
    $("[name='subject[]']").each(function () {
        let subject = $(this).val();
        //lọc ra danh sách môn chưa có
        data = data.filter((obj) => obj.id != subject);
    });
    return data;
}

function onChangeSubject() {
    $("[name='subject[]']").each(function () {
        let val = $(this).val();
        let name = $(this).children(`[value='${val}']`).text();
        let option = SubjectFilter().map(
            (subject) =>
                `<option value="${subject.id}" >${subject.name}</option>`
        );
        $(this).html(
            `<option value="${val}" selected >${name}</option>` + option
        );
    });
}

function registerSubject(id) {
    axios.get(api + `/subjects/${id}`).then(resp => {
        Object.values(resp.data).forEach((value) => {
            isArraySubject.push(value);
        });
    });
    showModalSubject();
}

$(document).ready(function () {
    $("#addSubjectModal").click(function () {
        let option = SubjectFilter().map(
            (subject) => `<option value="${subject.id}">${subject.name}</option>`
        );
        if (data.length > 0) {
            $("#modal-subject").append(
                `<div class="form-row" id="form-row-register-student">

                <div class="form-group col-md-8">
                    <select
                        name="subject[]"
                        data-rule="required"
                        class="form-control"
                    >` + `${option}` +
                `</select>
                </div>
                <div class="form-group col-md-3">
                    <button
                        type="button"
                        onclick="onRemove(this)"
                        class="bi bi-trash btn btn-danger"
                    ></button>
                </div>
            </div>`
            );
        } else {
            alert("Hết môn học rồi !!!")
        }
        onChangeSubject()
    });
});
var fromSubjectRegister = document.querySelector('.subject-form-update');
fromSubjectRegister.addEventListener('submit', async (e) => {
    e.preventDefault();
    await $("[name='subject[]']").each(function () {
        let val = $(this).val();
        $('#form-row-register-student').append(`<input name="subject_id[${val}][point]" value="0" type="hidden">`)
    });
    let id = $("#profileId").val()
    await $(".subject-form-update").attr("action", function () {
        return `${url}/admin/students/${id}`
    })
    await $(".subject-form-update").submit()
});
