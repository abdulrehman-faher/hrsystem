/**

 * add a delay on your function execution

 * @param {Function} callback

 * @param {Integer} ms

 */

function delay(fn, ms) {
    let timer = 0;

    return function(...args) {
        clearTimeout(timer);

        timer = setTimeout(fn.bind(this, ...args), ms || 0);
    };
}

function getUsers(val, div_id) {
    const container = $("#" + div_id);

    if (val != "") {
        const url = "{{ route('employees.names')}}";
        axios
            .get(url, {
                params: {
                    name: val
                }
            })
            .then(response => {
                let html = "<ul class='list-unstyled'>";
                if (response.data.length) {
                    response.data.forEach(user => {
                        html += `<li class="searched" data-id="${user.id}" data-appointment="${user.appointment}">${user.name}</li>`;
                    });
                } else {
                    html += `<li  data-id>No User Found</li>`;
                }
                html += "</ul>";
                container.fadeIn();
                container.html(html);
            })

            .catch(e => {
                console.log(e.response.data);
            });
    } else {
        container.fadeOut();
        container.html("");
    }
}

$(document).on("mouseup", function(e) {
    // var container = $("#sroUsersList");
    hideResults("sroUsersList", e);
    hideResults("ioUsersList", e);
});

function hideResults(div_id, e) {
    var container = $("#" + div_id);

    // if the target of the click isn't the container nor a descendant of the container
    if (!container.is(e.target) && container.has(e.target).length === 0) {
        container.fadeOut();
        container.html("");
    }
}

$(document).on(
    "keyup",
    "#sro_name",
    delay(function(event) {
        getUsers($(this).val(), "sroUsersList");
    }, 500)
);

$(document).on(
    "keyup",
    "#io_name",
    delay(function(event) {
        getUsers($(this).val(), "ioUsersList");
    }, 500)
);

$(document).on(
    "keyup",
    "#authorized_by_name",
    delay(function(event) {
        getUsers($(this).val(), "authByUsersList");
    }, 500)
);

$(document).on("click", "#ioUsersList li", function(event) {
    const $this = $(this);
    const dataID = $this.attr("data-id");
    const appointment = $this.attr("data-appointment");

    $("#io_name").val($this.text());
    $("#io_employee_id").val(dataID);
    $("#io_appointment").val(appointment);
    $("#ioUsersList").fadeOut();
    $("#ioUsersList").html("");
});

$(document).on("click", "#sroUsersList li", function(event) {
    const $this = $(this);
    const dataID = $this.attr("data-id");
    const appointment = $this.attr("data-appointment");

    $("#sro_name").val($this.text());
    $("#sro_employee_id").val(dataID);
    $("#sro_appointment").val(appointment);
    $("#sroUsersList").fadeOut();
    $("#sroUsersList").html("");
});

$(document).on("click", "#authByUsersList li", function(event) {
    const $this = $(this);
    const dataID = $this.attr("data-id");

    $("#authorized_by_name").val($this.text());
    $("#authorized_by").val(dataID);
    $("#authByUsersList").fadeOut();
    $("#authByUsersList").html("");
});
