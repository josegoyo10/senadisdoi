window.onload = function() {
  Calendar.setup({
    inputField: "inicio_primera_aplicacion",
    ifFormat:   "%Y-%m-%d",
    button:     "calendario_inicio_primera_aplicacion"
  });

  Calendar.setup({
    inputField: "fin_primera_aplicacion",
    ifFormat:   "%Y-%m-%d",
    button:     "calendario_fin_primera_aplicacion"
  });

  Calendar.setup({
    inputField: "inicio_segunda_aplicacion",
    ifFormat:   "%Y-%m-%d",
    button:     "calendario_inicio_segunda_aplicacion"
  });
  Calendar.setup({
    inputField: "fin_segunda_aplicacion",
    ifFormat:   "%Y-%m-%d",
    button:     "calendario_fin_segunda_aplicacion"
  });

}