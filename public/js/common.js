function closeModal() {
    $("#formModalBody").html("");
    $("#formModal").hide();
}

function activaTab(tab) {
    $('.nav-tabs a[href="#' + tab + '"]').tab("show");
}

function delay(fn, ms) {
    let timer = 0;
    return function(...args) {
        clearTimeout(timer);
        timer = setTimeout(fn.bind(this, ...args), ms || 0);
    };
}

$(document).on(
    "keyup",
    "#authorized_by_name",
    delay(function(event) {
        const $this = $(this);
        const val = $this.val();
        if (val != "") {
            const url = "/employees/names";
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
                            html += `<li class="searched" data-id="${user.id}">${user.name}</li>`;
                        });
                    } else {
                        html += `<li  data-id>No User Found</li>`;
                    }
                    html += "</ul>";
                    $("#usersList").fadeIn();
                    $("#usersList").html(html);
                })
                .catch(e => {
                    console.log(e.response.data);
                });
        } else {
            $("#usersList").fadeOut();
            $("#usersList").html("");
        }
    }, 500)
);

$(document).on("click", "#usersList li", function(event) {
    const $this = $(this);
    const dataId = $this.attr("data-id");

    $("#authorized_by_name").val($this.text());
    $("#authorized_by").val(dataId);
    $("#usersList").fadeOut();
    $("#usersList").html("");
    // console.log($(this).text());
});
