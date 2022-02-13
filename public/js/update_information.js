const formProfile = document.querySelector(".profile-form-update");
//
function showModal() {
    $("#myModal").modal("show");
}

function hideModal() {
    $("#myModal").modal("hide");
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

const profileShow = document.querySelector(".kt-form--label-right");
formProfile.addEventListener("submit", (e) => {
    e.preventDefault();
    const data = {
        name: formProfile.name.value,
        birthday: formProfile.birthday.value,
        email: formProfile.email.value,
        phone: formProfile.phone.value,
        address: formProfile.address.value,
        gender: formProfile.gender.value,
    };
    profileShow.name.value = data.name;
    profileShow.birthday.value = data.birthday;
    $("[name='profileEmail']").val(data.email)
    $("[name='profilePhone']").val(data.phone)
    profileShow.address.value = data.address;
    data.gender == 0 ? profileShow.gender.value = 'Male' : profileShow.gender.value = 'Female'

    axios.put(api + `/profile/${formProfile.id.value}`, data);
    hideModal();
});
