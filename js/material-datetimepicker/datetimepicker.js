$(document).ready(function() {
    var date = new Date();
    date.setDate(date.getDate());
    $('#fecha').bootstrapMaterialDatePicker({
        icons: 
        {
            next: 'fa fa-angle-right',
            previous: 'fa fa-angle-left'
        },
        autoHide: true,
        //startDate: date,
        time: false,
        //minDate: new Date(),
        //maxDate: new Date('2021-12-31'),
        //limitar calendario por dias
        //maxDate: new Date('2022-12-31'),
        currentDate: date,
        todayHighlight: 'TRUE',
        lang: 'es',
        cancelText: '',
        okText: '',
        clearText: 'Limpiar',
        autoOk: true,
        switchOnClick: true

    });
    
});

