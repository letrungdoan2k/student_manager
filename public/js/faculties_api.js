async function fetchFaculty() {
    const {data} = await axios.get(`${api}/faculties`);
    var output
    data.forEach((faculty) => {
        output += (
            `<tr>
                <td>${faculty.id}</td>
                <td id="name${faculty.id}">${faculty.name}</td>
                <td class="d-flex justify-content-center">
                    <button
                        type="button"
                        class="bi bi-pencil-square btn btn-warning ml-1"
                        onclick="onClickFaculty(${faculty.id}, '${faculty.name}', 'edit')"
                    ></button>
                    <button
                        type="button"
                        class="bi bi-trash btn btn-danger ml-1"
                        onclick="onDelete(${faculty.id}, 'faculty')"
                    ></button>
                </td>
            </tr>`
        );
    });
    $("#facultyTbody").html(output)
}

fetchFaculty();

function showAddModalFaculty() {
    $("#myModalFaculty").modal("show");
    $("#exampleModalFacultyTitle").text('Add Faculty')
    $(".bottom-faculty").html(`
                    <button type="button" class="btn btn-secondary" onclick="hideModalFaculty()">Close</button>
                    <button type="button" class="btn btn-primary btn-submit" onclick="submitCreateUpdateFaculty(0, 'add')">Save</button>`)
}

function showEditModalFaculty(id, name) {
    $("#myModalFaculty").modal("show");
    $("#updateIdFaculty").val(id)
    $("#exampleModalFacultyTitle").text('Edit Faculty')
    $(".facultyName").val(name)
    $(".bottom-faculty").html(`
                    <button type="button" class="btn btn-secondary" onclick="hideModalFaculty()">Close</button>
                    <button type="button" class="btn btn-primary btn-submit" onclick="submitCreateUpdateFaculty(${id}, 'edit')">Save</button>`)
}

function hideModalFaculty() {
    $("#myModalFaculty").modal("hide");
}

function onClickFaculty(id, name, content) {
    if (content === 'add') {
        showAddModalFaculty()
    }
    if (content === 'edit') {
        showEditModalFaculty(id, name)
    }
}
var formCreateUpdateFaculty = document.querySelector('.create-update-form-update')
function submitCreateUpdateFaculty(id, content) {

    if (content === 'add') {
        let data = {
            name: formCreateUpdateFaculty.name.value
        }
        axios.post(`${api}/faculties`, data)
        fetchFaculty()
        hideModalFaculty()
        toast("successfully add faculties")
        $(".facultyName").val('')
    }
    if (content === 'edit') {
        let data = {
            name: formCreateUpdateFaculty.name.value
        }
        axios.put(`${api}/faculty/${id}/edit`, data)
        fetchFaculty()
        hideModalFaculty()
        toast("successfully edit faculties")
        $(".facultyName").val('')
    }
}





