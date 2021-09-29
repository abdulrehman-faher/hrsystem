function getDate(date) {
    const monthNames = [
        "Jan",
        "Feb",
        "Mar",
        "Apr",
        "May",
        "Jun",
        "Jul",
        "Aug",
        "Sep",
        "Oct",
        "Nov",
        "Dec"
    ];
    const dateObj = date ? new Date(date) : new Date();
    const month = monthNames[dateObj.getMonth()];
    const day = String(dateObj.getDate()).padStart(2, "0");
    const year = dateObj.getFullYear();

    return `${day} ${month} ${year}`;
}
$(document).on("blur", "#club_name_input", function(e) {
    localStorage.setItem("club_name", $(this).val());
});
$(document).on("blur", "#copy_for_input", function(e) {
    localStorage.setItem("copy_for", $(this).val());
});
$(document).on("change", "#dated_type_date", function(e) {
    localStorage.setItem("dated_date", getDate($(this).val()));
});

$(function() {
    $("#club_name_input").val(localStorage.getItem("club_name"));
    $("#copy_for_input").val(localStorage.getItem("copy_for"));
    // $("#dated_type_date").val(localStorage.getItem("dated_date"));
});
localStorage.setItem("dated_date", getDate(new Date()));
document.getElementById("dated_type_date").valueAsDate = new Date();

// console.log(localStorage.getItem("dated_date"));
// console.log(getDate(localStorage.getItem("dated_date")));
