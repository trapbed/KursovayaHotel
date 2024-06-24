$('#indexDateArrival').change(function(){
        let date = new Date($('#indexDateArrival').val());
        min2 = new Date(date.setDate(date.getDate() + 1));
        let day = min2.getDate();
        if(day.toString().length < 1){
            day = "0"+day;
        }
        let month = min2.getMonth()+1;
        if(month.toString().length.length!=2){
            month = "0"+month;
        }
        min2 = min2.getFullYear() + '-' + month + '-' + day;
        $('#indexDateDeparture').attr("min", min2);
    })