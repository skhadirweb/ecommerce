'use strict';

// let cardfirstname = document.getElementById("card_firstname").value;
// console.log(cardfirstname);
//
//
// let firstname = document.getElementById("firstname");


document.getElementById("card_firstname").addEventListener("input", function () {
    document.getElementById("firstname").innerText = this.value;
})

document.getElementById("card_lastname").addEventListener("input", function () {
    document.getElementById("lastname").innerText = this.value;
})

document.getElementById("card_slogan").addEventListener("change", function () {
    document.querySelector("#slogan").innerText = this.options[this.selectedIndex].text;
    console.log(this.value);
})

// DISPLAY UPLOADED IMAGE //

let card_image = document.getElementById('card_image');

card_image.setAttribute('accept', 'image/*');

var file = function g(event) {
    var image = document.getElementById('output');
    image.src = URL.createObjectURL(event.target.files[0]);
}

card_image.addEventListener('change', file);







