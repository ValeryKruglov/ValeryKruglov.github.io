$(function () {
    $('[data-toggle="tooltip"]').tooltip();
    $(".dropdown-toggle").dropdown();

    $('#date_plan').datetimepicker({
        locale: 'ru',
        inline: true,
        sideBySide: true,
        minDate: moment().add(1,'hours').set('minute', 0),
        format: "YYYY/MM/DD HH:mm"
    });

    // Set default value date
    $('#date_pay').val($('#date_plan').data('date'));

    // Set date
    $('#date_plan').on('change.datetimepicker', function(e) {
      $('#date_pay').val(e.date.format('YYYY/MM/DD HH:mm'));
    });

    // Turn off the minute switch
    $('#date_plan span.timepicker-minute[data-action="showMinutes"], #date_plan a.btn[data-action="incrementMinutes"], #date_plan a.btn[data-action="decrementMinutes"]').removeAttr('data-action').attr('disabled', true).attr('style', "opacity: 0.5;");

    window.addEventListener('load', function() {
      // Fetch all the forms we want to apply custom Bootstrap validation styles to
      var forms = document.getElementsByClassName('needs-validation');
      // Loop over them and prevent submission
      var validation = Array.prototype.filter.call(forms, function(form) {
        form.addEventListener('submit', function(event) {
          if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
          }
          form.classList.add('was-validated');
        }, false);
      });
    }, false);
})