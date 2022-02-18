const formProfile = document.querySelector(".profile-form-update");

//
function showModal() {
    $("#myModal").modal("show");
}

function hideModal() {
    $("#myModal").modal("hide");
}

function toast(content) {
    bs4Toast.primary("Successfully", content);
}

async function profileStudent(id) {
    try {
        const {data} = await axios.get(api + `/profile/${id}`);
        formProfile.name.value = data.name;
        formProfile.birthday.value = data.birthday;
        formProfile.email.value = data.email;
        formProfile.phone.value = data.phone;
        formProfile.address.value = data.address;
        formProfile.gender.value = data.gender;
        formProfile.id.value = id;
    } catch (error) {
    }
    showModal();
}

const profileShow = document.querySelector(".kt-form--label-right");
const updateImage = document.querySelector("#updateProfileAvata");
const profileForm = document.querySelector("#profileSubmit");
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
                name: profileForm.name.value,
                birthday: profileForm.birthday.value,
                email: profileForm.email.value,
                phone: profileForm.phone.value,
                address: profileForm.address.value,
                gender: profileForm.gender.value,
            };
            profileShow.name.value = data.name;
            $("#nameH5").text(data.name);
            profileShow.birthday.value = data.birthday;
            $("#profileEmail").text(data.email);
            $("#profilePhone").text(data.phone);
            profileShow.address.value = data.address;
            data.gender == 0
                ? (profileShow.gender.value = "Male")
                : (profileShow.gender.value = "Female");
            axios.put(api + `/profile/${profileForm.id.value}`, data);
            let files = updateImage.files[0]
            let dataFile = new FormData()
            dataFile.append("image", files)
            console.log(profileForm.id.value)
            $.ajax({
                type: 'POST',
                url: api + `/profile/image/${profileForm.id.value}`,
                data: dataFile,
                contentType: false,
                processData: false,
                success: (response) => {
                    if (response) {
                        $(".avataProfile").attr("src", function () {
                            return `${url}/storage/${response.image}`
                        })
                    }
                }
            });
            hideModal();
            toast('Profile update successfully');
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
        return `${url}/admin/student/${id}/subject`
    })
    await $(".subject-form-update").submit()
});

/// ----------------------------Permission----------------------------------------

function showModalPermission() {
    $("#myModalPermission").modal("show");
}

function hideModalPermission() {
    $("#myModalPermission").modal("hide");
}

function permission(id) {
    showModalPermission()
    $("#formPermission").attr("action", function () {
        return `${url}/admin/user/${id}/permission`
    })
}

