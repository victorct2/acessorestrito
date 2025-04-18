$('#reservation').daterangepicker({
    locale: {
      format: 'DD/MM/YYYY'
    },      
    ranges   : {
        'Hoje'       : [moment(), moment()],
        'Ontem'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'Últimos 7 dias' : [moment().subtract(6, 'days'), moment()],
        'Últimos 30 dias': [moment().subtract(29, 'days'), moment()],
        'Este Mês'  : [moment().startOf('month'), moment().endOf('month')],
        'Mês Passado'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    },
    //startDate: moment().subtract(29, 'days'),
    //endDate  : moment(),
    alwaysShowCalendars: true,
    opens: "right",
    function (start, end) {
      //$('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
    }
  });