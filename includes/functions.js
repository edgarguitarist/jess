/////////////////////////////////
////////////JESS/////////////
//Elementos Globales///



//Funciones de Evaluacion de estudiantes

$(document).ready(function () {
  $("#sel_esp").change(function () {
    $("#sel_esp option:selected").each(function () {
      sel_esp = $(this).val();

      var letras = document.getElementById("hachedos");
      var mostrar = document.getElementById("mostrar_data");
      letras.style.display = "none";
      mostrar.style.display = "none";

      if ($(this).val() != "0") {
        $.post("datos.php", { sel_esp: sel_esp }, function (data) {
          $("#sel_per").html(data);
          $("#sel_bac").html('');
          $("#sel_doc").html('');
          $("#sel_mat").html('');
        });
      } else {
        letras.style.display = "none";
        mostrar.style.display = "none";
        $("#sel_per").html('');
        $("#sel_bac").html('');
        $("#sel_doc").html('');
        $("#sel_mat").html('');
      }
    });
  });
});

$(document).ready(function () {
  $("#sel_per").change(function () {
    $("#sel_per option:selected").each(function () {
      sel_per = $(this).val();

      var letras = document.getElementById("hachedos");
      var mostrar = document.getElementById("mostrar_data");
      letras.style.display = "none";
        mostrar.style.display = "none";
      if ($(this).val() != "0") {
        $.post("datos.php", { sel_per: sel_per }, function (data) {
          $("#sel_bac").html(data);
          $("#sel_doc").html('');
          $("#sel_mat").html('');
        });
      } else {
        letras.style.display = "none";
        mostrar.style.display = "none";
        $("#sel_bac").html('');
        $("#sel_doc").html('');
        $("#sel_mat").html('');
      }
    });
  });
});

$(document).ready(function () {
  $("#sel_bac").change(function () {
    $("#sel_bac option:selected").each(function () {
      sel_bac = $(this).val();

      var letras = document.getElementById("hachedos");
      var mostrar = document.getElementById("mostrar_data");
      letras.style.display = "none";
        mostrar.style.display = "none";
      if ($(this).val() != "0") {
        $.post("datos.php", { sel_bac: sel_bac }, function (data) {
          $("#sel_doc").html(data);
          $("#sel_mat").html('');
        });
      } else {
        letras.style.display = "none";
        mostrar.style.display = "none";
        $("#sel_doc").html('');
        $("#sel_mat").html('');
      }
    });
  });
});

$(document).ready(function () {
  $("#sel_doc").change(function () {
    $("#sel_doc option:selected").each(function () {
      sel_bac2 = $("#sel_bac").val();
      sel_doc = $(this).val();

      var letras = document.getElementById("hachedos");
      var mostrar = document.getElementById("mostrar_data");
      letras.style.display = "none";
        mostrar.style.display = "none";
      if ($(this).val() != "0") {
        $.post(
          "datos.php",
          { sel_doc: sel_doc, sel_bac2: sel_bac2 },
          function (data) {
            $("#sel_mat").html(data);
          }
        );
      } else {
        letras.style.display = "none";
        mostrar.style.display = "none";
        $("#sel_mat").html('');
      }
    });
  });
});

$(document).ready(function () {
  $("#sel_mat").change(function () {
    $("#sel_mat option:selected").each(function () {
      sel_mat = $(this).val();
      var letras = document.getElementById("hachedos");
      var mostrar = document.getElementById("mostrar_data");
      letras.style.display = "none";
        mostrar.style.display = "none";
      //console.log($(this).val());
      if ($(this).val() != "0") {
        letras.style.display = "block";
        mostrar.style.display = "flex";
        $.post("datos.php", { sel_mat: sel_mat }, function (data) {
          $("#mostrar_data").html(data);
        });
      } else {
        letras.style.display = "none";
        mostrar.style.display = "none";
      }
    });
  });
});

//Funciones de Autoevaluacion

$(document).ready(function () {
  $("#sel_cur_auto").change(function () {
    $("#sel_cur_auto option:selected").each(function () {
      sel_cur_auto = $(this).val();
      var letras = document.getElementById("hachedos");
      var mostrar = document.getElementById("mostrar_data");
      letras.style.display = "none";
      mostrar.style.display = "none";
      if ($(this).val() != "0") {
        $.post("datos.php", { sel_cur_auto: sel_cur_auto }, function (data) {
          $("#sel_doc_auto").html(data);
        });
      } else {
        $("#sel_doc_auto").html('');
      }
    });
  });
});

$(document).ready(function () {
  $("#sel_doc_auto").change(function () {
    $("#sel_doc_auto option:selected").each(function () {
      sel_doc_auto = $(this).val();
      sel_cur_auto2 = $("#sel_cur_auto").val();
      var letras = document.getElementById("hachedos");
      var mostrar = document.getElementById("mostrar_data");
      letras.style.display = "none";
      mostrar.style.display = "none";
      if (sel_doc_auto != "0") {
        letras.style.display = "block";
        mostrar.style.display = "flex";
      
      $.post(
        "datos.php",
        { sel_doc_auto: sel_doc_auto, sel_cur_auto2: sel_cur_auto2 },
        function (data) {
          $("#mostrar_data").html(data);
        }
      );
    } else {
      letras.style.display = "none";
      mostrar.style.display = "none";
    }
    });
  });
});

// Funciones de Padres
$(document).ready(function () {
  $("#sel_esp_pad").change(function () {
    $("#sel_esp_pad option:selected").each(function () {
      sel_esp_pad = $(this).val();
      var letras = document.getElementById("hachedos");
      var mostrar = document.getElementById("mostrar_data");
      letras.style.display = "none";
        mostrar.style.display = "none";
      if ($(this).val() != "0") {
        $.post("datos.php", { sel_esp_pad: sel_esp_pad }, function (data) {
          $("#sel_per_pad").html(data);
          $("#sel_bac_pad").html('');
          $("#sel_doc_pad").html('');
          $("#sel_mat_pad").html('');
        });
      } else {
        $("#sel_per_pad").html('');
        $("#sel_bac_pad").html('');
        $("#sel_doc_pad").html('');
        $("#sel_mat_pad").html('');
        letras.style.display = "none";
        mostrar.style.display = "none";
      }
    });
  });
});

$(document).ready(function () {
  $("#sel_per_pad").change(function () {
    $("#sel_per_pad option:selected").each(function () {
      sel_per_pad = $(this).val();
      var letras = document.getElementById("hachedos");
      var mostrar = document.getElementById("mostrar_data");
      letras.style.display = "none";
        mostrar.style.display = "none";
      if ($(this).val() != "0") {
        $.post("datos.php", { sel_per_pad: sel_per_pad }, function (data) {
          $("#sel_bac_pad").html(data);
          $("#sel_doc_pad").html('');
          $("#sel_mat_pad").html('');
        });
      } else {
        $("#sel_bac_pad").html('');
        $("#sel_doc_pad").html('');
        $("#sel_mat_pad").html('');
        letras.style.display = "none";
        mostrar.style.display = "none";
      }
    });
  });
});

$(document).ready(function () {
  $("#sel_bac_pad").change(function () {
    $("#sel_bac_pad option:selected").each(function () {
      sel_bac_pad = $(this).val();
      var letras = document.getElementById("hachedos");
      var mostrar = document.getElementById("mostrar_data");
      letras.style.display = "none";
        mostrar.style.display = "none";
      if ($(this).val() != "0") {
        $.post("datos.php", { sel_bac_pad: sel_bac_pad }, function (data) {
          $("#sel_doc_pad").html(data);
          $("#sel_mat_pad").html('');
        });
      } else {
        $("#sel_doc_pad").html('');
        $("#sel_mat_pad").html('');
        letras.style.display = "none";
        mostrar.style.display = "none";
      }
    });
  });
});

$(document).ready(function () {
  $("#sel_doc_pad").change(function () {
    $("#sel_doc_pad option:selected").each(function () {
      sel_bac2_pad = $("#sel_bac_pad").val();
      sel_doc_pad = $(this).val();
      var letras = document.getElementById("hachedos");
      var mostrar = document.getElementById("mostrar_data");
      letras.style.display = "none";
        mostrar.style.display = "none";
      if ($(this).val() != "0") {
        $.post(
          "datos.php",
          { sel_doc_pad: sel_doc_pad, sel_bac2_pad: sel_bac2_pad },
          function (data) {
            $("#sel_mat_pad").html(data);
          }
        );
      } else {
        $("#sel_mat_pad").html('');
        letras.style.display = "none";
        mostrar.style.display = "none";
      }
    });
  });
});

$(document).ready(function () {
  $("#sel_mat_pad").change(function () {
    $("#sel_mat_pad option:selected").each(function () {
      sel_mat_pad = $(this).val();
      var letras = document.getElementById("hachedos");
      var mostrar = document.getElementById("mostrar_data");
      letras.style.display = "none";
        mostrar.style.display = "none";
      if ($(this).val() != "0") {
        letras.style.display = "block";
        mostrar.style.display = "flex";
        $.post("datos.php", { sel_mat_pad: sel_mat_pad }, function (data) {
          $("#mostrar_data").html(data);
        });
      } else {
        letras.style.display = "none";
        mostrar.style.display = "none";
      }
    });
  });
});

// Funciones de Observacion en clase
$(document).ready(function () {
  $("#sel_esp_obs").change(function () {
    $("#sel_esp_obs option:selected").each(function () {
      sel_esp_obs = $(this).val();
      var letras = document.getElementById("hachedos");
      var mostrar = document.getElementById("mostrar_data");
      letras.style.display = "none";
      mostrar.style.display = "none";
      if ($(this).val() != "0") {
        $.post("datos.php", { sel_esp_obs: sel_esp_obs }, function (data) {
          $("#sel_per_obs").html(data);
          $("#sel_bac_obs").html('');
          $("#sel_doc_obs").html('');
          $("#sel_mat_obs").html('');
        });
      } else {
        letras.style.display = "none";
        mostrar.style.display = "none";
        $("#sel_per_obs").html('');
        $("#sel_bac_obs").html('');
        $("#sel_doc_obs").html('');
        $("#sel_mat_obs").html('');
      }
    });
  });
});

$(document).ready(function () {
  $("#sel_per_obs").change(function () {
    $("#sel_per_obs option:selected").each(function () {
      sel_per_obs = $(this).val();
      var letras = document.getElementById("hachedos");
      var mostrar = document.getElementById("mostrar_data");
      letras.style.display = "none";
      mostrar.style.display = "none";
      if ($(this).val() != "0") {
        $.post("datos.php", { sel_per_obs: sel_per_obs }, function (data) {
          $("#sel_bac_obs").html(data);
          $("#sel_doc_obs").html('');
          $("#sel_mat_obs").html('');
        });
      } else {
        letras.style.display = "none";
        mostrar.style.display = "none";
        $("#sel_bac_obs").html('');
        $("#sel_doc_obs").html('');
        $("#sel_mat_obs").html('');
      }
    });
  });
});

$(document).ready(function () {
  $("#sel_bac_obs").change(function () {
    $("#sel_bac_obs option:selected").each(function () {
      sel_bac_obs = $(this).val();
      var letras = document.getElementById("hachedos");
      var mostrar = document.getElementById("mostrar_data");
      letras.style.display = "none";
      mostrar.style.display = "none";
      if ($(this).val() != "0") {
        $.post("datos.php", { sel_bac_obs: sel_bac_obs }, function (data) {
          $("#sel_doc_obs").html(data);
          $("#sel_mat_obs").html('');
        });
      } else {
        letras.style.display = "none";
        mostrar.style.display = "none";
        $("#sel_doc_obs").html('');
        $("#sel_mat_obs").html('');
      }
    });
  });
});

$(document).ready(function () {
  $("#sel_doc_obs").change(function () {
    $("#sel_doc_obs option:selected").each(function () {
      sel_bac2_obs = $("#sel_bac_obs").val();
      sel_doc_obs = $(this).val();
      var letras = document.getElementById("hachedos");
      var mostrar = document.getElementById("mostrar_data");
      letras.style.display = "none";
        mostrar.style.display = "none";

      if ($(this).val() != "0") {
        $.post(
          "datos.php",
          { sel_doc_obs: sel_doc_obs, sel_bac2_obs: sel_bac2_obs },
          function (data) {
            $("#sel_mat_obs").html(data);
          }
        );
      } else {
        letras.style.display = "none";
        mostrar.style.display = "none";
        $("#sel_mat_obs").html('');
      }
    });
  });
});

$(document).ready(function () {
  $("#sel_mat_obs").change(function () {
    $("#sel_mat_obs option:selected").each(function () {
      sel_mat_obs = $(this).val();

      var letras = document.getElementById("hachedos");
      var mostrar = document.getElementById("mostrar_data");
      letras.style.display = "none";
        mostrar.style.display = "none";
      if (sel_mat_obs != "0") {
        letras.style.display = "block";
        mostrar.style.display = "flex";
        $.post("datos.php", { sel_mat_obs: sel_mat_obs }, function (data) {
          $("#mostrar_data").html(data);
        });
      } else {
        letras.style.display = "none";
        mostrar.style.display = "none";
      }
    });
  });
});

//Funciones de Directivos

$(document).ready(function () {
  $("#sel_cur_dir").change(function () {
    $("#sel_cur_dir option:selected").each(function () {
      sel_cur_dir = $(this).val();
      $("#sel_doc_dir").html("");
      var letras = document.getElementById("hachedos");
      var mostrar = document.getElementById("mostrar_data");
      letras.style.display = "none";
        mostrar.style.display = "none";
      if (sel_cur_dir == 0) {
        letras.style.display = "none";
        mostrar.style.display = "none";
      }
      $.post("datos.php", { sel_cur_dir: sel_cur_dir }, function (data) {
        $("#sel_doc_dir").html(data);
      });
    });
  });
});

$(document).ready(function () {
  $("#sel_doc_dir").change(function () {
    $("#sel_doc_dir option:selected").each(function () {
      sel_doc_dir = $(this).val();
      sel_cur_dir2 = $("#sel_cur_dir").val();
      var letras = document.getElementById("hachedos");
      var mostrar = document.getElementById("mostrar_data");
      letras.style.display = "none";
        mostrar.style.display = "none";
      if (sel_doc_dir != 0) {
        letras.style.display = "block";
        mostrar.style.display = "flex";

        $.post(
          "datos.php",
          { sel_doc_dir: sel_doc_dir, sel_cur_dir2: sel_cur_dir2 },
          function (data) {
            $("#mostrar_data").html(data);
          }
        );
      } else {
        letras.style.display = "none";
        mostrar.style.display = "none";
      }
    });
  });
});

///////////// FUNCIONES DE COEVALUACION

$(document).ready(function () {
  $("#sel_cur_coev").change(function () {
    $("#sel_cur_coev option:selected").each(function () {
      sel_cur_coev = $(this).val();
      $("#sel_area_coev").html("");
      var letras = document.getElementById("hachedos");
      var mostrar = document.getElementById("mostrar_data");
      letras.style.display = "none";
      mostrar.style.display = "none";
      if (sel_cur_coev == 0) {
        letras.style.display = "none";
        mostrar.style.display = "none";
      }
      $.post("datos.php", { sel_cur_coev: sel_cur_coev }, function (data) {
        $("#sel_area_coev").html(data);
        $("#sel_doc_coev").html('');
      });
    });
  });
});

$(document).ready(function () {
  $("#sel_area_coev").change(function () {
    $("#sel_area_coev option:selected").each(function () {
      sel_area_coev = $(this).val();
      $("#sel_doc_coev").html('');
      var letras = document.getElementById("hachedos");
      var mostrar = document.getElementById("mostrar_data");
      letras.style.display = "none";
      mostrar.style.display = "none";
      if (sel_area_coev == 0) {
        letras.style.display = "none";
        mostrar.style.display = "none";
      }
      $.post("datos.php", { sel_area_coev: sel_area_coev }, function (data) {
        $("#sel_doc_coev").html(data);
      });
    });
  });
});

$(document).ready(function () {
  $("#sel_doc_coev").change(function () {
    $("#sel_doc_coev option:selected").each(function () {
      sel_doc_coev = $(this).val();
      sel_area_coev2 = $("#sel_area_coev").val();
      var letras = document.getElementById("hachedos");
      var mostrar = document.getElementById("mostrar_data");
      letras.style.display = "none";
      mostrar.style.display = "none";
      //console.log(sel_area_coev2, sel_doc_coev);
      if (sel_doc_coev != 0 || sel_area_coev2 != 0) {
        letras.style.display = "block";
        mostrar.style.display = "flex";

        $.post(
          "datos.php",
          { sel_area_coev2: sel_area_coev2, sel_doc_coev: sel_doc_coev },
          function (data) {
            $("#mostrar_data").html(data);
          }
        );
      } else {
        letras.style.display = "none";
        mostrar.style.display = "none";
      }
    });
  });
});


/////////////////////////REPORTE GLOBAL/////////////////////////////////
$(document).ready(function () {
  $("#sel_esp_re").change(function () {
    $("#sel_esp_re option:selected").each(function () {
      sel_esp_re = $(this).val();

      var letras = document.getElementById("hachedos");
      var mostrar = document.getElementById("mostrar_data");
      var imp = document.getElementById("btn-export");
      
      imp.style.display ="none";
      letras.style.display = "none";
      mostrar.style.display = "none";

      if ($(this).val() != "0") {
        $.post("datos.php", { sel_esp_re: sel_esp_re }, function (data) {
          $("#sel_per_re").html(data);
          $("#sel_bac_re").html('');
        });
      } else {
        letras.style.display = "none";
        mostrar.style.display = "none";
        $("#sel_per_re").html('');
        $("#sel_bac_re").html('');
      }
    });
  });
});

$(document).ready(function () {
  $("#sel_per_re").change(function () {
    $("#sel_per_re option:selected").each(function () {
      sel_per_re = $(this).val();

      var letras = document.getElementById("hachedos");
      var mostrar = document.getElementById("mostrar_data");
      var imp = document.getElementById("btn-export");
      imp.style.display ="none";
      letras.style.display = "none";
      mostrar.style.display = "none";
      if ($(this).val() != "0") {
        $.post("datos.php", { sel_per_re: sel_per_re }, function (data) {
          $("#sel_bac_re").html(data);
        });
      } else {
        letras.style.display = "none";
        mostrar.style.display = "none";
        $("#sel_bac_re").html('');
      }
    });
  });
});

function saltarA(id, tiempo) {
  var tiempo = tiempo || 1000;
  $("html, body").animate({ scrollTop: $(id).offset().top }, tiempo);
}

$(document).ready(function () {
  $("#sel_bac_re").change(function () {
    $("#sel_bac_re option:selected").each(function () {
      sel_bac_re = $(this).val();
      sel_per_re2 = $("#sel_per_re").val();
      sel_esp_re2 = $("#sel_esp_re").val();      
      var letras = document.getElementById("hachedos");
      var mostrar = document.getElementById("mostrar_data");
      var imp = document.getElementById("btn-export");
      letras.style.display = "none";
      mostrar.style.display = "none";
      imp.style.display ="none";
      var nono = "<p></p><img src='images/estamos-trabajando.png' style='width:28%;' alt='Estamos trabajando'><p style='font-size: 2em; font-weight: bold; color: #44A0D3;  text-align:center;'>¡Lo sentimos, No tenemos Resultados del elemento seleccionado!</p>";
      if ($(this).val() != "0") {
        letras.style.display = "block";
        mostrar.style.display = "flex";
        imp.style.display="block";
        $.post("datos.php", { sel_bac_re: sel_bac_re, sel_per_re2: sel_per_re2, sel_esp_re2: sel_esp_re2}, function (data) {
          $("#mostrar_data").html(data);
          saltarA('#Resultados')          
          if(data==nono){
            imp.style.display ="none";
          }
        });
      } else {
        letras.style.display = "none";
        mostrar.style.display = "none";
        imp.style.display ="none";
      }
    });
  });
});



////////////////////////////////////////////
function genPDF(name) {
  const { jsPDF } = window.jspdf;
  var scaleBy = 1;
  var cabecera = document.getElementById("informacion");
  $(".detalle").hide();
  cabecera.style.display = "block";
  html2canvas(document.getElementById("pdf_container"), {
    useCORS: true,
    onrendered: (canvas) => {
	  cabecera.style.display = "none";
    $(".detalle").show();

      let doc = new jsPDF("p", "mm", "a4");
	  
      //Obtengo la dimensión en pixeles en base a la documentación
      // https://github.com/MrRio/jsPDF/blob/ddbfc0f0250ca908f8061a72fa057116b7613e78/jspdf.js#L59
      let a4Size = {
        w: convertPointsToUnit(595.28, "px"),
        h: convertPointsToUnit(841.89, "px")
      };

      let canvastoPrint = document.createElement("canvas");
      let ctx = canvastoPrint.getContext("2d");
      canvastoPrint.width = a4Size.w;
      canvastoPrint.height = a4Size.h;
      ctx.scale(scaleBy, scaleBy);

      // Como mi ancho es mas grande y lo redimencionare, tomo cuanto corresponde esos 595 de el total de mi imagen
      let aspectRatioA4 = a4Size.w / a4Size.h;
      let rezised = canvas.width / aspectRatioA4;

      let printed = 0,
        page = 0;
		
      while (printed < canvas.height) {
        //Tomo la imagen en proporcion a el ancho y alto.
        ctx.drawImage(
          canvas,
          0,
          printed,
          canvas.width,
          rezised,
          0,
          0,
          a4Size.w,
          a4Size.h
        );
        var imgtoPdf = canvastoPrint.toDataURL("image/png");
        let width = doc.internal.pageSize.getWidth() - 10;
        let height = doc.internal.pageSize.getHeight();
        if (page == 0) {
          // si es la primera pagina, va directo a doc
          doc.addImage(imgtoPdf, "PNG", 4, 0, width, height);
        } else {
          // Si no ya tengo que agregar nueva hoja.
          let page = doc.addPage();
          page.addImage(imgtoPdf, "PNG", 4, 2, width, height);
        }
        ctx.clearRect(0, 0, canvastoPrint.width, canvastoPrint.height); // Borro el canvas
        printed += rezised; //actualizo lo que ya imprimi
        page++; // actualizo mi pagina
      }
	  
      doc.save( name + ".pdf");
    }
  });

  function convertPointsToUnit(points, unit) {
    // Unit table from https://github.com/MrRio/jsPDF/blob/ddbfc0f0250ca908f8061a72fa057116b7613e78/jspdf.js#L791
    var multiplier;
    switch (unit) {
      case "pt":
        multiplier = 1;
        break;
      case "mm":
        multiplier = 72 / 25.4;
        break;
      case "cm":
        multiplier = 72 / 2.54;
        break;
      case "in":
        multiplier = 72;
        break;
      case "px":
        multiplier = 96 / 72;
        break;
      case "pc":
        multiplier = 12;
        break;
      case "em":
        multiplier = 12;
        break;
      case "ex":
        multiplier = 6;
      default:
        throw "Invalid unit: " + unit;
    }
    return points * multiplier;
  }
}