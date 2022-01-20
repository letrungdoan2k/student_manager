

function onRemove(el) {
    $(el).parent().parent().remove();
}

var array = Object.entries(JSON.parse(subjects))
var option
array.forEach(([key, val]) => {
    option += `<option value=${key}>${val}</option>`
})

console.log(array)


function myFunction() {
    var x = document.getElementById("mySelect").value;
    console.log(x)
}

$(document).ready(function () {
    $('#addForm').click(function () {
        $('#point-form').append(`
                    <div class="row mb-3">
                        <div class="col-4">
                        <select id="mySelect" name="subject_id[]" onchange="myFunction()" class="form-control">` +
                        `${option}`
                        +
                        `</select>
                        </div>
                        <div class="col-4">
                            <input name="point[]" type="text" class="form-control">
                        </div>
                        <div class="col-4">
                            <button type="button" onclick="onRemove(this)" class="bi bi-trash btn btn-danger"></button>
                        </div>
                    </div>
        `);
    })
});

