// load module
let Inputmask = require('inputmask');
let datepicker = require('bootstrap-datepicker');

// select element
let phoneSelector = document.querySelectorAll("input[type='tel']");

// create instance and run method
let phone = new Inputmask("999-999-9999");
phone.mask(phoneSelector);

$('#export_from, #export_to').datepicker({
    uiLibrary: 'bootstrap4',
    format: 'yyyy-mm-dd'
});