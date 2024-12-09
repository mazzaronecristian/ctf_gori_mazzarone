function handleLogin() {
  let username = $("#username").val();
  let password = $("#password").val();

  let divErorri = $("#errors");
  if (username === "" || password === "") {
    divErorri.text("Inserisci username e password");
    divErorri.show();
    return;
  }

  $.ajax({
    url: "http://localhost:8080/login.php",
    type: "POST",
    data: {
      username: username,
      password: password,
    },
    dataType: "json",
    success: function (data) {
      if (data["error"] == null) {
        window.location.href = "opinionpage.php";
      } else {
        divErorri.text(data["error"]);
        divErorri.show();
      }
    },
    error: function (error) {
      divErorri.text("Errore nella chiamata al server");
      divErorri.show();
    },
  });
}
