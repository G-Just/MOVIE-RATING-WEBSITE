function add_rating(id) {
  current = document.getElementById(id).innerHTML;
  regex = /([A-Za-z])\w+/g;
  current = current.match(regex).join(" ");
  localStorage.setItem("selected-poster-form-view", current);
  location.href = "add_rating.php";
}

if (document.getElementById("add-rating") !== null) {
  let search_text = document.getElementById("search-text");

  search_text.addEventListener("input", (event) => {
    searchMovies(search_text.value);
  });

  function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
  }

  API_URL = "http://www.omdbapi.com?apikey=69be409e";

  const searchMovies = async (title) => {
    const search_box = document.getElementById("search-results");
    const response = await fetch(`${API_URL}&s=${title}`);
    const data = await response.json();
    if (data["Response"] === "True") {
      search_box.innerHTML = "";
      for (i = 0; i < data["Search"].length; i++) {
        const movie = document.createElement("div");
        movie.classList.add("search-result");
        movie.setAttribute("id", i);
        movie.setAttribute("onclick", `rate(${i})`);
        if (data["Search"][i]["Poster"] !== "N/A") {
          movie.innerHTML = `<img src=${data["Search"][i]["Poster"]}></img>`;
        } else {
          movie.innerHTML = `<img src='media/movie-projector-smoke.jpg' style='object-fit: cover;'></img>`;
        }
        movie.innerHTML += `<h4>${data["Search"][i]["Title"]}</h4>
                                        <p>${capitalizeFirstLetter(
                                          data["Search"][i]["Type"]
                                        )}<span>${
          data["Search"][i]["Year"]
        }</span></p>`;
        search_box.appendChild(movie);
      }
    } else {
      search_box.innerHTML = "";
    }
  };
  if (localStorage.getItem("selected-poster-form-view") !== null) {
    storedTitle = localStorage.getItem("selected-poster-form-view");
    localStorage.removeItem("selected-poster-form-view");
    search_text.value = storedTitle;
    searchMovies(storedTitle);
  }
}
