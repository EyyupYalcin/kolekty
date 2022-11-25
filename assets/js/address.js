// Bu script kullanılacağı sayfada JQuery'ye bağımlıdır.
// öncesinde JQuery import edin.

$(document).ready(function () {
    $.ajax({
        type: "GET",
        url: "/api/Address",
        dataType: "json",
        success: function (data) {
            var countries = data; console.log(data);
            countries.forEach(country => {
                $('#country').append(`<option value="${country.countryID}">${country.countryName}</option>`);
            });
            
/*
                 Swal.fire(
                    'Opss!',
                    'Arka planda bazı şeyler ters gitti. Lütfen daha sonra tekrar deneyiniz!',
                    'error'
                );
                */
        }
    });
});