// load module
let Inputmask = require('inputmask');

// select element
let phoneSelector = document.querySelectorAll("input[type='tel']");

// create instance and run method
let phone = new Inputmask("999-999-9999");
phone.mask(phoneSelector);