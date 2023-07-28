if (document.getElementById("view-rating") !== null) {
  title = document.getElementsByClassName("view-title");

  const urlParams = new URLSearchParams(window.location.search);
  const current = urlParams.get("sort");

  form = document.getElementById("sort-form");
  selection = document.getElementById("sort-selectors");

  if (current == "Year") {
    selection.value = "moviesYear";
  }
  if (current == "Title") {
    selection.value = "moviesTitle";
  }
  if (current == "IMDB") {
    selection.value = "moviesIMDB";
  }
  if (current == "DateAdded") {
    selection.value = "moviesID";
  }
  if (current == "Rated_by_me") {
    selection.value = "rated-by-me";
  }
  if (current == "Not_rated_by_me") {
    selection.value = "not-rated-by-me";
  }
  try {
    form.addEventListener("change", (event) => {
      form.submit();
    });
  } catch {
    console.log("something is wrong with the sort selector");
  }

  for (let i = 0; i < title.length; i++) {
    length = title[i].innerText.length;
    if (length > 90) {
      title[i].setAttribute("style", `font-size:${length / 12}pt`);
    }
  }
  rating_number = document.getElementsByClassName("view-final-verdict");
  rating_number_comment = document.getElementsByClassName(
    "view-final-verdict-comment"
  );
  for (let i = 0; i < rating_number.length; i++) {
    if (rating_number[i].innerText == 10) {
      rating_number[i].style = "color: rgb(0, 120, 150);";
      rating_number_comment[i].style = "color: rgb(0, 120, 150);";
      rating_number_comment[i].innerText = "S-TIER";
    }
    if (rating_number[i].innerText < 10 && rating_number[i].innerText > 7) {
      rating_number[i].style = "color: rgb(200, 120, 0);";
      rating_number_comment[i].style = "color: rgb(200, 120, 0);";
      rating_number_comment[i].innerText = "GOOD";
    }
    if (rating_number[i].innerText <= 7 && rating_number[i].innerText > 5) {
      rating_number[i].style = "color: rgb(4, 109, 0);";
      rating_number_comment[i].style = "color: rgb(4, 109, 0);";
      rating_number_comment[i].innerText = "MID";
    }
    if (rating_number[i].innerText <= 5 && rating_number[i].innerText > 1) {
      rating_number[i].style = "color: rgb(90, 0, 0);";
      rating_number_comment[i].style = "color: rgb(90, 0, 0);";
      rating_number_comment[i].innerText = "BAD";
    }
    if (rating_number[i].innerText == 1) {
      rating_number[i].style = "color: rgb(100, 100, 100);";
      rating_number_comment[i].style = "color: rgb(100, 100, 100);";
      rating_number_comment[i].innerText = "DOG-TIER";
    }
  }
}
