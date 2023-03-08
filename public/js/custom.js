
    $(document).ready(function() {

        const format = (number) => {
            console.log(number);
            const exp = /(\d)(?=(\d{3})+(?!\d))/g;
            const rep = '$1.';
            let arr = number.toString().replace(".", "").split('.');
            console.log(arr);
            arr[0] = arr[0].replace(exp, rep);
            return arr[1] ? arr.join('.') : arr[0];
        }

        $("#neto").on({
            "focus": function(event) {
                $(event.target).select();
            },
            "keyup": function(event) {
                $(event.target).val(function(index, value) {
                    return format(value);
                });
            },
            "change": function(event) {

                let valor = parseInt($(event.target).val().toString().replace(".", ""));
                console.log(valor);
                return $("#range-neto").val(valor);
            }
        });

        $("#cantidad").on({
            "focus": function(event) {
                $(event.target).select();
            },
            "keyup": function(event) {
                $(event.target).val(function(index, value) {
                    return format(value);
                });
            },
            "change": function(event) {
                let valor = parseInt($(event.target).val().toString().replace(".", ""));
                console.log(valor);
                return $("#range-cantidad").val(valor);

            }
        });

        $("#btn_solicitar").click(function() {
            let errors = 0;

            if($("#full_name").val() == ""){
                errors++;
                $("#full_name").addClass("border-red-110");
                $("#error-full_name").text("Campo requerido");
            }else{
                $("#full_name").removeClass("border-red-110");
                $("#error-full_name").text("");
            }

            if($("#email").val() == ""){
                errors++;
                $("#email").addClass("border-red-110");
                $("#error-email").text("Campo requerido");
            }else{
                if($("#email").val().match(/^[a-zA-Z0-9\._-]+@[a-zA-Z0-9-]{2,}[.][a-zA-Z]{2,4}$/)) {
                    $("#email").removeClass("border-red-110");
                    $("#error-email").text("");
                }else{
                    errors++;
                    $("#email").addClass("border-red-110");
                    $("#error-email").text("Revise el formato del email");
                }
            }

            if($("#tlf").val() == ""){
                errors++;
                $("#tlf").addClass("border-red-110");
                $("#error-tlf").text("Campo requerido");
            }else{
                if($("#tlf").val().match(/^[0-9]{9}$/)) {
                    $("#tlf").removeClass("border-red-110");
                    $("#error-tlf").text("");
                }else{
                    errors++;
                    $("#tlf").addClass("border-red-110");
                    $("#error-tlf").text("Revise el formato del teléfono");
                }
            }

            if($("#neto").val() == ""){
                errors++;
                $("#neto").addClass("border-red-110");
                $("#error-neto").text("Campo requerido");
            }else{
                if($("#neto").val().match(/^([2-9][0-9]\.[0-9][0-9][0-9]|100.000)$/)){
                    $("#neto").removeClass("border-red-110");
                    $("#error-neto").text("");
                }else{
                    errors++;
                    $("#neto").addClass("border-red-110");
                    $("#error-neto").text("Revise los ingresos netos los valores disponibles son desde 20.000€ hasta 100.000€");
                }
            }

            if($("#cantidad").val() == ""){
                errors++;
                $("#cantidad").addClass("border-red-110");
                $("#error-cantidad").text("Campo requerido");
            }else{
                if($("#cantidad").val().match(/^([2-9][0-9]\.[0-9][0-9][0-9]|[1\.-9][0-9][0-9]\.[0-9][0-9][0-9]|1.000.000)$/)){
                    $("#cantidad").removeClass("border-red-110");
                    $("#error-cantidad").text("");
                }else{
                    errors++;
                    $("#cantidad").addClass("border-red-110");
                    $("#error-cantidad").text("Revise la cantidad solicitada los valores disponibles son desde 20.000€ hasta 1.000.000€");
                }
            }

            if($("#time_desde").val() == ""){
                errors++;
                $("#time_desde").addClass("border-red-110");
                $("#error-desde").text("Campo requerido");
            }else{
                $("#time_desde").removeClass("border-red-110");
                $("#error-desde").text("");
            }

            if($("#time_hasta").val() == ""){
                errors++;
                $("#time_hasta").addClass("border-red-110");
                $("#error-hasta").text("Campo requerido");
            }else{
                $("#time_hasta").removeClass("border-red-110");
                $("#error-hasta").text("");
            }
           
            if(errors > 0){
                console.log(errors);
            }else{
                $("#form_registro").submit();
            }
            
        });


        $("#cerrar_alert").click(function(){
            sessionStorage.clear();
            $("#error_alert").remove();
        });
    });

    $(document).on('input change', '#range-neto', function() {
        let numero = $(this).val();
        let formateador = new Intl.NumberFormat('es-ES');
        let numeroFormateado = formateador.format(numero);
        $('#neto').val(numeroFormateado);
    });

    $(document).on('input change', '#range-cantidad', function() {
        let numero = $(this).val();
        let formateador = new Intl.NumberFormat('es-ES');
        let numeroFormateado = formateador.format(numero);
        $('#cantidad').val(numeroFormateado);
    });
