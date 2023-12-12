console.log(
    "Here the prize: https://youtu.be/dQw4w9WgXcQ?si=Noapcy0RJH6U33pE "
);
// Show - Hide table
function showTable1() {
    var t1 = document.getElementById("table1");
    var ticon1 = document.getElementById("icon-btn-shtable1");

    t1.classList.toggle("sh-table");
    ticon1.classList.toggle("fa-list");
    ticon1.classList.toggle("fa-minus");
}

function shwpass() {
    var spass = document.getElementById("password");
    var ipass = document.getElementById("eye");

    ipass.classList.toggle("fa-eye");
    ipass.classList.toggle("fa-eye-slash");

    if (spass.type === "password") {
        spass.type = "text";
    } else {
        spass.type = "password";
    }
}

function showTable2() {
    var t2 = document.getElementById("table2");
    var ticon2 = document.getElementById("icon-btn-shtable2");

    t2.classList.toggle("sh-table");
    ticon2.classList.toggle("fa-list");
    ticon2.classList.toggle("fa-minus");
}

function showTable3() {
    var t3 = document.getElementById("table3");
    var ticon3 = document.getElementById("icon-btn-shtable3");

    t3.classList.toggle("sh-table");
    ticon3.classList.toggle("fa-list");
    ticon3.classList.toggle("fa-minus");
}

function showTable4() {
    var t4 = document.getElementById("table4");
    var ticon4 = document.getElementById("icon-btn-shtable4");

    t4.classList.toggle("sh-table");
    ticon4.classList.toggle("fa-list");
    ticon4.classList.toggle("fa-minus");
}

function showTable5() {
    var t5 = document.getElementById("table5");
    var ticon5 = document.getElementById("icon-btn-shtable5");

    t5.classList.toggle("sh-table");
    ticon5.classList.toggle("fa-list");
    ticon5.classList.toggle("fa-minus");
}

function showTable6() {
    var t6 = document.getElementById("table6");
    var ticon6 = document.getElementById("icon-btn-shtable6");

    t6.classList.toggle("sh-table");
    ticon6.classList.toggle("fa-list");
    ticon6.classList.toggle("fa-minus");
}
//testing
