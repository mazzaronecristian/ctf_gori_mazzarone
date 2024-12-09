$(document).ready(function () {
  loadOpinions();
});

function loadOpinions() {
  $.ajax({
    url: "http://localhost:8080/opinions.php",
    type: "GET",
    dataType: "json",
    success: function (data) {
      let opinions = $("#allopinions");
      opinions.empty();
      opinions.append(
        " <h1 class='text-center opinionboxtitle'>Here are all the opinions</h1> "
      );
      for (let i = 0; i < data.length; i++) {
        let opinion = data[i];

        let fieldsetElement = $(
          "<fieldset class='opinionbox'><legend>" +
            opinion["username"] +
            "</legend></fieldset>"
        );
        let opinionElement = $("<div class='contaienr mt-4'></div>");
        opinionElement.append(opinion["opinion"]);
        fieldsetElement.append(opinionElement);
        opinions.append(fieldsetElement);
        opinions.append("<br>");
      }
    },
    error: function (error) {
      console.log(error);
      alert(error);
    },
  });
}

function sendOpinion() {
  $.ajax({
    url: "http://localhost:8080/opinions.php",
    type: "POST",
    data: {
      opinion: $("#opinion").val(),
    },
    dataType: "json",
    success: function (data) {
      loadOpinions();
    },
    error: function (error) {
      console.log(error);
    },
  });
}
