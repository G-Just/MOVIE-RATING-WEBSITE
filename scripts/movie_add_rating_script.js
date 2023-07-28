function rate(id) {
  poster = document.getElementById(id);
  localStorage.setItem("selected-poster", poster.innerHTML);
  title = poster.getElementsByTagName("h4")[0].innerText;
  type = poster.getElementsByTagName("p")[0].innerText.split("\n")[0];
  year = poster.getElementsByTagName("span")[0].innerText;
  location.href = `add_rating_rate.php?content=${title}&type=${type}&year=${year}`;
}

function change_movie() {
  location.href = "add_rating.php";
}

function capitalizeFirstLetter(string) {
  return string.charAt(0).toUpperCase() + string.slice(1);
}

function disableScroll() {
  scrollTop = document.documentElement.scrollTop;
  (scrollLeft = document.documentElement.scrollLeft),
    (window.onscroll = function () {
      window.scrollTo(scrollLeft, scrollTop);
    });
}
function enableScroll() {
  window.onscroll = function () {};
}

if (document.getElementById("add-rating-rate") !== null) {
  current_poster = document.getElementById("selected-result");
  current_poster.innerHTML += localStorage.getItem("selected-poster");
  current_poster.setAttribute("onclick", "change_movie()");

  API_URL = "http://www.omdbapi.com?apikey=69be409e";

  const searchMoviesAdvanced = async (title, type, year) => {
    const response = await fetch(
      `${API_URL}&t=${title}&plot=full&type=${type}&y=${year}`
    );
    const data = await response.json();

    document.getElementById("genre").innerText = data["Genre"];
    document.querySelector("[name=genre]").setAttribute("value", data["Genre"]);

    document.getElementById("imdb").innerText =
      data["imdbRating"] + " (" + data["imdbVotes"] + " votes)";
    document
      .querySelector("[name=imdb]")
      .setAttribute("value", data["imdbRating"]);

    document.getElementById("title").innerText =
      data["Title"] + " (" + data["Year"] + ")";
    document.querySelector("[name=title]").setAttribute("value", data["Title"]);
    document.querySelector("[name=year]").setAttribute("value", data["Year"]);

    document.getElementById("type").innerText = capitalizeFirstLetter(
      data["Type"]
    );
    document.querySelector("[name=type]").setAttribute("value", data["Type"]);

    document
      .querySelector("[name=poster]")
      .setAttribute("value", data["Poster"]);

    document.getElementById("plot").innerText = data["Plot"];
    document.querySelector("[name=plot]").setAttribute("value", data["Plot"]);
  };

  title = current_poster.getElementsByTagName("h4")[0].innerText;
  type = current_poster.getElementsByTagName("p")[0].innerText.split("\n")[0];
  year = current_poster.getElementsByTagName("span")[0].innerText;

  searchMoviesAdvanced(title, type, year);

  doc = document.getElementById("selected-result").clientHeight;
  document.getElementById("rate-form-container").style.height = `${doc}px`;

  let i = 0;
  rating_number = document.getElementById("rating");
  rating_input = document.getElementById("rating-input");
  rating_number.addEventListener("mouseover", (e) => {
    disableScroll();
  });
  rating_number.addEventListener("mouseleave", (e) => {
    enableScroll();
  });
  rating_number.addEventListener("wheel", (e) => {
    rating_number.removeAttribute("class");
    if (e.deltaY < 0 && i < 10) {
      i++;
      rating_number.innerText = i;
      rating_input.setAttribute("value", i);
    }
    if (e.deltaY > 0 && i > 1) {
      i--;
      rating_number.innerText = i;
      rating_input.setAttribute("value", i);
    }
    if (i == 10) {
      rating_number.style =
        "background-color: rgb(0, 120, 150);font-size: 2em; font-weight: 700;";
    }
    if (i < 10 && i > 7) {
      rating_number.style =
        "background-color:rgb(200, 120, 0);font-size: 2em; font-weight: 700;";
    }
    if (i <= 7 && i > 5) {
      rating_number.style =
        "background-color: rgb(4, 109, 0);font-size: 2em; font-weight: 700;";
    }
    if (i <= 5 && i > 1) {
      rating_number.style =
        "background-color: rgb(90, 0, 0);font-size: 2em; font-weight: 700;";
    }
    if (i == 1) {
      rating_number.style =
        "background-color: rgb(100, 100, 100);font-size: 2em; font-weight: 700;";
    }
  });
  form = document.getElementById("rate-form");
  error_circumvent = true;
  try {
    document
      .getElementById("remove-rating-button")
      .addEventListener("click", (e) => {
        error_circumvent = false;
      });
  } catch (error) {}
  warned = 0;
  function warn_deletion() {
    button = document.getElementById("remove-rating-button");
    warned += 1;
    button.innerText = "Are you sure?";
  }

  title_fetched = document.getElementById("title");

  form.addEventListener("submit", (event) => {
    error = false;
    if (title_fetched.innerText === "Fetching...") error = true;
    if (error_circumvent === false && warned === 2) event.submit();
    if (
      (rating_input.value === null && warned === 0) ||
      (rating_input.value === "" && warned === 0)
    ) {
      document.getElementById("rating").setAttribute("class", "failed");
      error = true;
    }
    if (warned === 1) {
      error = true;
    }
    if (error === true) {
      event.preventDefault();
    }
  });
}
