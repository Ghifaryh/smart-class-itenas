console.log("Here the prize: www.bit.do/YeetYeet ");
// Show - Hide table
function showTable1() {
    var t1 = document.getElementById("table1");
    // var t2 = document.getElementById("table2");
    // var t3 = document.getElementById("table3");
    // var t4 = document.getElementById("table4");
    // var t5 = document.getElementById("table5");
    // var t6 = document.getElementById("table6");
    var ticon1 = document.getElementById("icon-btn-shtable1");

    t1.classList.toggle("sh-table");
    ticon1.classList.toggle("fa-list");
    ticon1.classList.toggle("fa-minus");
    // t2.classList.add("sh-table");
    // t3.classList.add("sh-table");
    // t4.classList.add("sh-table");
    // t5.classList.add("sh-table");
    // t6.classList.add("sh-table");


    // var x = document.getElementById("table1");
    // if (x.classList === "shtable") {
    //     x.classList.remove("shtable");
    // } else {
    //     x.classList.add("shtable");
    // }
}
function shwpass(){
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
    // var t1 = document.getElementById("table1");
    var t2 = document.getElementById("table2");
    // var t3 = document.getElementById("table3");
    // var t4 = document.getElementById("table4");
    // var t5 = document.getElementById("table5");
    // var t6 = document.getElementById("table6");
    var ticon2 = document.getElementById("icon-btn-shtable2");

    t2.classList.toggle("sh-table");
    ticon2.classList.toggle("fa-list");
    ticon2.classList.toggle("fa-minus");
    // t1.classList.add("sh-table");
    // t3.classList.add("sh-table");
    // t4.classList.add("sh-table");
    // t5.classList.add("sh-table");
    // t6.classList.add("sh-table");
}

function showTable3() {
    // var t1 = document.getElementById("table1");
    // var t2 = document.getElementById("table2");
    var t3 = document.getElementById("table3");
    // var t4 = document.getElementById("table4");
    // var t5 = document.getElementById("table5");
    // var t6 = document.getElementById("table6");
    var ticon3 = document.getElementById("icon-btn-shtable3");

    t3.classList.toggle("sh-table");
    ticon3.classList.toggle("fa-list");
    ticon3.classList.toggle("fa-minus");
    // t1.classList.add("sh-table");
    // t2.classList.add("sh-table");
    // t4.classList.add("sh-table");
    // t5.classList.add("sh-table");
    // t6.classList.add("sh-table");
}

function showTable4() {
    // var t1 = document.getElementById("table1");
    // var t2 = document.getElementById("table2");
    // var t3 = document.getElementById("table3");
    var t4 = document.getElementById("table4");
    // var t5 = document.getElementById("table5");
    // var t6 = document.getElementById("table6");

    t4.classList.toggle("sh-table");
    // t1.classList.add("sh-table");
    // t2.classList.add("sh-table");
    // t3.classList.add("sh-table");
    // t5.classList.add("sh-table");
    // t6.classList.add("sh-table");
}

function showTable5() {
    // var t1 = document.getElementById("table1");
    // var t2 = document.getElementById("table2");
    // var t3 = document.getElementById("table3");
    // var t4 = document.getElementById("table4");
    var t5 = document.getElementById("table5");
    // var t6 = document.getElementById("table6");

    t5.classList.toggle("sh-table");
    // t1.classList.add("sh-table");
    // t2.classList.add("sh-table");
    // t3.classList.add("sh-table");
    // t4.classList.add("sh-table");
    // t6.classList.add("sh-table");
}

function showTable6() {
    // var t1 = document.getElementById("table1");
    // var t2 = document.getElementById("table2");
    // var t3 = document.getElementById("table3");
    // var t4 = document.getElementById("table4");
    // var t5 = document.getElementById("table5");
    var t6 = document.getElementById("table6");

    t6.classList.toggle("sh-table");
    // t1.classList.add("sh-table");
    // t2.classList.add("sh-table");
    // t3.classList.add("sh-table");
    // t4.classList.add("sh-table");
    // t5.classList.add("sh-table");
}
